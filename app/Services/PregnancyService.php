<?php
namespace App\Services;

use App\Models\Childbirth;
use App\Models\Person;
use App\Models\Pregnancy;
use App\Models\Puerperal;
use Illuminate\Database\Eloquent\Builder;


class PregnancyService
{
    public function getAllPregnancies($filters)
    {
        return Pregnancy::whereHas('person', function(Builder $query) {
            $query->where('is_alive', true)
                ->where('village_id', 1);
        })->filter($filters)
            ->latest()
            ->paginate(20);
    }

    public function getIbuHamil($filters)
    {
        return Pregnancy::whereHas('person', function(Builder $query) {
            $query->where('is_alive', true)
                ->where('village_id', 1);
        })->whereNull('childbirth_date')
            ->filter($filters)
            ->latest()
            ->paginate(20);
    }

    public function getIbuNifas($filters)
    {
        return Pregnancy::whereHas('person', function(Builder $query) {
            $query->where('is_alive', true)
                ->where('village_id', 1);
        })->whereHas('puerperal', function (Builder $query) {
            $query->whereNull('conclusion');
        })->whereNotNull('childbirth_date')
            ->filter($filters)
            ->latest()
            ->paginate(20);
    }

    public function store($request)
    {
        // simpan kehamilan beru diperbolehkan bagi wanita yg
        // 1. belum pernah hamil
        // 2. kehamilan terakhir sudah bersalin dan udh lewat 42 hari nifas
        // tidak diperbolehkan jika kehamilan terakhir belum lahir atau sudah lahir tp belum 42 hari

        $lastPregnancy = Person::find($request->person_id)->latestPregnancy;
        $is_allowed = $this->finishPregnancyAndPuerperal($lastPregnancy);

        if ($is_allowed == true) {
            return Pregnancy::create([
                'person_id' => $request->person_id,
                'hpht' => $request->hpht,
                'weight' => $request->weight,
                'height' => $request->height,
                'bmi' => $this->bmi($request->weight, $request->height),
            ]);
        }
    }

    public function finishPregnancyAndPuerperal($lastPregnancy)
    {
        if (empty($lastPregnancy)) { // pertama kali hamil maka diperbolehkan
            return true;
        } else { // jika terdapat data kehamilan
            // kalau tgl persalinan masih kosong, artinya blm melahirkan, jgn perbolehkan
            if (empty($lastPregnancy->childbirth_date)) {
                return false;
            } else { // jika terdapat tgl persalinan
                // jika sudah melebihi 42 hari maka perbolehkan
                if ($lastPregnancy->childbirth_date->diffInDays(now()) > 42) {
                    return true;
                } elseif ($lastPregnancy->childbirth_date->diffInDays(now()) <= 42) {
                    return false;
                }
            } 
        }
    }

    public function update($request, $pregnancy)
    {
        $attributes = $request->all();

        if ($request->filled('childbirth_date')) {
            $attributes['gestational_age'] = $this->calculateGestationalAge($request->childbirth_date, $pregnancy);
            $attributes['parturition_id'] = $this->setPartusType($request->childbirth_date, $pregnancy);
        }

        // cegah jangan sampai waktu kelahiran terisi sebelumnya, lalu diisi null. Jd jika sudah ada isinya, tp ga ada input dari form, timpan dgn value yg tersedia sebelumnya dari database
        if ($pregnancy->childbirth_date !== null) {
            if ($request->missing('childbirth_date')) {
                $attributes['childbirth_date'] = $pregnancy->childbirth_date;
            }
        }

        $attributes['bmi'] = $this->bmi($request->weight, $request->height);
        $pregnancy->update($attributes);

        // pembuatan model ibu nifas jika ada input waktu persalinan
        $this->createIbuNifas($request, $pregnancy);
    }
    
    /**
     * setPartusType untukk mengkategorikan apakah abortus, prematurus, maturus, post partus
     *
     * @return void
     */
    public function setPartusType($childbirth_date, $pregnancy)
    {
        $gestationalAgeInWeeks = $pregnancy->hpht->diffInWeeks($childbirth_date);
        if ($gestationalAgeInWeeks < 28) {
            return 1; //abortus_id
        } elseif ($gestationalAgeInWeeks >= 28 && $gestationalAgeInWeeks <= 36) {
            return 2; // prematur id
        } elseif ($gestationalAgeInWeeks > 36 && $gestationalAgeInWeeks <= 42) {
            return 3; // maturus id
        } elseif ($gestationalAgeInWeeks > 42) {
            return 4; // post partus id
        }
    }
    
    /**
     * createIbuNifas, ketika waktu persalinan diisi maka otomatis model nifas dibuat
     * namun cek juga udah dibuat atau blm sebelumnya, krn model nifas one to one dgn pregnancy
     *
     * @param  mixed $request
     * @param  mixed $pregnancy
     * @return void
     */
    public function createIbuNifas($request, $pregnancy)
    {
        if ($request->filled('childbirth_date')) {
            if ($pregnancy->puerperal == null) {
                $pregnancy->puerperal()->create();
            }
        }
    }

    public function getDeletedPregnancies()
    {
        return Pregnancy::onlyTrashed()
            ->with(['person' => function($query) {
                $query->withTrashed();
            }])->orderBy('deleted_at', 'desc')->get();
    }
    
    /**
     * destroy
     *
     * @param  mixed $pregnancy
     * @return void
     */
    public function softDelete($pregnancy)
    {
        if ($pregnancy->puerperal !== null) {
            if ($pregnancy->puerperal->puerperalClasses->isNotEmpty()) {
                $pregnancy->puerperal->puerperalClasses()->delete();
            }
            $pregnancy->puerperal()->delete();
        }
        if ($pregnancy->prenatalClasses->isNotEmpty()) {
            $pregnancy->prenatalClasses()->delete();
        }
        if ($pregnancy->childbirths->isNotEmpty()) {
            $pregnancy->childbirths()->delete();
        }
        $pregnancy->delete();
    }

    public function forceDelete($pregnancy)
    {
        $pregnancy = Pregnancy::withTrashed()
            ->with(['puerperal' => function($query) {
                $query->withTrashed();
            }, 'puerperal.puerperalClasses' => function($query) {
                $query->withTrashed();
            }, 'prenatalClasses' => function($query) {
                $query->withTrashed();
            }, 'childbirths' => function($query) {
                $query->withTrashed();
            }, ])->find($pregnancy);
        

        // hapus permanen dgn relasinya
        if ($pregnancy->prenatalClasses->isNotEmpty()) {
            $pregnancy->prenatalClasses()->forceDelete();
        }

        if ($pregnancy->puerperal !== null) {
            if ($pregnancy->puerperal->puerperalClasses->isNotEmpty()) {
                $pregnancy->puerperal->puerperalClasses()->forceDelete();
            }
            // hapus berbagai kondisi ibu dan bayi pasca nifas pd tabel pivot
            $pregnancy->puerperal->babyConditions()->detach();
            $pregnancy->puerperal->complications()->detach();

            $pregnancy->puerperal()->forceDelete();
        }
        if ($pregnancy->childbirths->isNotEmpty()) {
            foreach ($pregnancy->childbirths as $key => $childbirth) {
                $childbirth->babyConditions()->detach(); // tabel kondisi bayi pasca dilahirkan
            }
            $pregnancy->childbirths()->forceDelete();
        }
        $pregnancy->forceDelete();
    }

    public function restore($pregnancy)
    {
        $pregnancy = Pregnancy::withTrashed()
            ->with(['puerperal' => function($query) {
                $query->withTrashed();
            }, 'puerperal.puerperalClasses' => function($query) {
                $query->withTrashed();
            }, 'prenatalClasses' => function($query) {
                $query->withTrashed();
            }, 'childbirths' => function($query) {
                $query->withTrashed();
            }, ])->find($pregnancy);
        
        // batalkan jika ibu sudah tidak ada/null, bisa jd ibu sudah dihapus
        if ($pregnancy->person == null) {
            return false;
        } else {

            if ($pregnancy->prenatalClasses->isNotEmpty()) {
                $pregnancy->prenatalClasses()->restore();
            }

            if ($pregnancy->puerperal !== null) {
                if ($pregnancy->puerperal->puerperalClasses->isNotEmpty()) {
                    $pregnancy->puerperal->puerperalClasses()->restore();
                }
                
                $pregnancy->puerperal()->restore();
            }

            if ($pregnancy->childbirths->isNotEmpty()) {
                $pregnancy->childbirths()->restore();
            }
            $pregnancy->restore();
            return true;
        }
    }

    public function calculateGestationalAge($childbirth_date, $pregnancy)
    {
        $minggu = $pregnancy->hpht->diffInWeeks($childbirth_date);
        $hari = $pregnancy->hpht->diffInDays($childbirth_date) - ($minggu * 7);
        return ( $minggu . ' minggu ' . $hari . ' hari');
    }
    
    /**
     * bmi fungsi hitung BMI ibu hamil
     *
     * @return void
     */
    public function bmi($weight, $height)
    {
        # input tinggi adalah cm dan integer, input berat adalah kg dan decimal
        # rumusnya bmi adalah berat dlm kg dibagi hasil kuadrat tinggi dalam meter
        # supaya ga rusak, buat berat dlm gram integer, tinggi tetep dlm cm dan dikali 10000
        $pembilang = $weight;
        $penyebut = pow($height, 2) / 10000;
        return round(($pembilang/$penyebut), 2);
    }

    public function getPregnanciesToExport($request)
    {
        $filters = $request->toArray();

        return Pregnancy::whereHas('person', function(Builder $query) {
            $query->where('is_alive', true)
                ->where('village_id', 1);
        })->filter($filters)
            ->latest()
            ->get();
    }


    public function pregnancyAnnualReport($month, $year)
    {
        
        return [
            'ibu_hamil' =>  Pregnancy::whereYear('hpht', $year)
                ->whereMonth('hpht', $month)
                ->count(),
            'ibu_bersalin' => [
                'hidup' => Pregnancy::whereYear('hpht', $year)
                            ->whereMonth('hpht', $month)
                            ->whereIn('mother_condition_id', [1, 2])->count(),
                'mati' => Pregnancy::whereYear('hpht', $year)
                            ->whereMonth('hpht', $month)
                            ->where('mother_condition_id', 3)->count(),
            ],
            'abortus' => Pregnancy::whereYear('hpht', $year)
                        ->whereMonth('hpht', $month)
                        ->where('parturition_id', 1)->count(),
            'bayi_lahir_hidup' => [
                'l' => Childbirth::where('sex_id', 1)
                        ->whereHas('babyConditions', function(Builder $query) {
                            $query->whereNotIn('id', [8]);
                        })->whereHas('pregnancy', function(Builder $query) use ($year, $month) {
                            $query->whereYear('hpht', $year)
                                ->whereMonth('hpht', $month);
                        })->count(),
                'p' => Childbirth::where('sex_id', 2)
                        ->whereHas('babyConditions', function(Builder $query) {
                            $query->whereNotIn('id', [8]);
                        })->whereHas('pregnancy', function(Builder $query) use ($year, $month) {
                            $query->whereYear('hpht', $year)
                                ->whereMonth('hpht', $month);
                        })->count(),
            ],
            'bayi_lahir_mati' => [
                'l' => Childbirth::where('sex_id', 1)
                        ->whereHas('babyConditions', function(Builder $query) {
                            $query->where('id', 8);
                        })->whereHas('pregnancy', function(Builder $query) use ($year, $month) {
                            $query->whereYear('hpht', $year)
                                ->whereMonth('hpht', $month);
                        })->count(),
                'p' => Childbirth::where('sex_id', 2)
                        ->whereHas('babyConditions', function(Builder $query) {
                            $query->where('id', 8);
                        })->whereHas('pregnancy', function(Builder $query) use ($year, $month) {
                            $query->whereYear('hpht', $year)
                                ->whereMonth('hpht', $month);
                        })->count(),
            ],
            'level_1' => Childbirth::whereHas('pregnancy', function (Builder $query) use ($year, $month) {
                            $query->whereYear('hpht', $year)
                                ->whereMonth('hpht', $month);
                        })->where('weight', '<', 2000)->count(),
            'level_2' => Childbirth::whereHas('pregnancy', function (Builder $query) use ($year, $month) {
                            $query->whereYear('hpht', $year)
                                ->whereMonth('hpht', $month);
                        })->where(function($query) {
                            $query->where('weight', '>=', 2000)
                                ->where('weight', '<', 2400);
                        })->count(),
            'level_3' => Childbirth::whereHas('pregnancy', function (Builder $query) use ($year, $month) {
                            $query->whereYear('hpht', $year)
                                ->whereMonth('hpht', $month);
                        })->where(function($query) {
                            $query->where('weight', '>=', 2400)
                                ->where('weight', '<', 3700);
                        })->count(),
            'level_4' => Childbirth::whereHas('pregnancy', function (Builder $query) use ($year, $month) {
                            $query->whereYear('hpht', $year)
                                ->whereMonth('hpht', $month);
                        })->where('weight', '>=', 3700)->count(),
            'bayi_nifas_hidup' => [
                'l' => Childbirth::where('sex_id', 1)
                        ->whereHas('pregnancy', function (Builder $query) use ($year, $month) {
                            $query->whereYear('hpht', $year)
                                ->whereMonth('hpht', $month)
                                ->whereHas('puerperal', function (Builder $query) {
                                    $query->whereHas('babyConditions', function (Builder $query) {
                                        $query->whereNotIn('id', [8]);
                                    });
                                });
                        })->count(),
                'p' => Childbirth::where('sex_id', 2)
                        ->whereHas('pregnancy', function (Builder $query) use ($year, $month) {
                            $query->whereYear('hpht', $year)
                                ->whereMonth('hpht', $month)
                                ->whereHas('puerperal', function (Builder $query) {
                                    $query->whereHas('babyConditions', function (Builder $query) {
                                        $query->whereNotIn('id', [8]);
                                    });
                                });
                        })->count(),
            ],
            'bayi_nifas_mati' => [
                'l' => Childbirth::where('sex_id', 1)
                        ->whereHas('pregnancy', function (Builder $query) use ($year, $month) {
                            $query->whereYear('hpht', $year)
                                ->whereMonth('hpht', $month)
                                ->whereHas('puerperal', function (Builder $query) {
                                    $query->whereHas('babyConditions', function (Builder $query) {
                                        $query->where('id', 8);
                                    });
                                });
                        })->count(),
                'p' => Childbirth::where('sex_id', 2)
                        ->whereHas('pregnancy', function (Builder $query) use ($year, $month) {
                            $query->whereYear('hpht', $year)
                                ->whereMonth('hpht', $month)
                                ->whereHas('puerperal', function (Builder $query) {
                                    $query->whereHas('babyConditions', function (Builder $query) {
                                        $query->where('id', 8);
                                    });
                                });
                        })->count(),
            ],
            'ibu_nifas_hidup' => Puerperal::whereHas('pregnancy', function (Builder $query) use ($year, $month) {
                                    $query->whereYear('hpht', $year)
                                            ->whereMonth('hpht', $month);
                                })->whereNotIn('mother_condition_id', [8])->count(),
            'ibu_nifas_mati' => Puerperal::whereHas('pregnancy', function (Builder $query) use ($year, $month) {
                                    $query->whereYear('hpht', $year)
                                            ->whereMonth('hpht', $month);
                                })->where('mother_condition_id', 8)->count(),
        ];
    }
}
