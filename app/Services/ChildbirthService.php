<?php
namespace App\Services;

use App\Models\Childbirth;
use App\Models\Person;
use App\Models\Pregnancy;
use App\Models\Puerperal;
use Illuminate\Database\Eloquent\Builder;

class ChildbirthService
{    
    public function getNewBirths()
    {
        # ambil semua baris childbirths, yang kondisinya ngga mati
        return Childbirth::with(['pregnancy.person', 'sex'])->doesntHave('person')->whereHas('babyConditions', function($query) {
            $query->whereNotIn('id', [8]);
        })->get();
    }

    public function store($pregnancy)
    {
        $pregnancy->childbirths()->create();
    }

    public function update($request, $childbirth)
    {
        $childbirth->update([
            'childbirth_order' => $request->childbirth_order,
            'weight' => $request->weight,
            'length' => $request->length,
            'head_circumference' => $request->head_circumference,
            'sex_id' => $request->sex_id,
            'childbirth_method' => $request->childbirth_method,
            'additional_information' => $request->additional_information,
        ]);

        if ($request->filled('baby_condition_id')) {
            $childbirth->babyConditions()->sync($request->baby_condition_id);
        }
    }

    public function storePersonNewBirth($request, $childbirth)
    {
        $attributes = $request->all();
        
        $attributes['sex_id'] = $childbirth->sex_id;
        $attributes['date_of_birth'] = $childbirth->pregnancy->childbirth_date;
        $attributes['educational_id'] = 1; // tidak/belum sekolah
        $attributes['marital_status_id'] = 1; //belum kawin
        $attributes['mother_id'] = $childbirth->pregnancy->person_id;
        $attributes['village_id'] = 1;
        $attributes['is_alive'] = true;

        // cek kalau ga ada input ayah, ambil ayah dari suami ibu
        if ($request->missing('father_id')) {
            if (isset( $childbirth->pregnancy->person->husband)) {
                $attributes['father_id'] = $childbirth->pregnancy->person->husband->husband_id;
            }
        }

        $person = Person::create($attributes);
        $childbirth->person()->associate($person)->save();

        return $person;
    }

    public function getDeletedChildbirths()
    {
        return Childbirth::onlyTrashed()
            ->with(['pregnancy' => function($query) {
                $query->withTrashed();
            }, 'pregnancy.person' => function($query) {
                $query->withTrashed();
            },])->orderBy('deleted_at', 'desc')->get();
    }

    public function forceDelete($childbirth)
    {
        $childbirth = Childbirth::withTrashed()->find($childbirth);
        # detach semua baby condition
        $childbirth->babyConditions()->detach();
        $childbirth->forceDelete();
    }

    public function restore($childbirth)
    {
        // batalkan jika pregnancy udh hilang
        $childbirth = Childbirth::withTrashed()->find($childbirth);

        if ($childbirth->pregnancy == null) {
            return false;
        } else {
            $childbirth->restore();
        }
    }


    public function childbirthAnnualReport($month, $year)
    {
        return [
            'ibu_bersalin' => [
                'hidup' => Pregnancy::whereYear('childbirth_date', $year)
                            ->whereMonth('childbirth_date', $month)
                            ->whereIn('mother_condition_id', [1, 2])->count(),
                'mati' => Pregnancy::whereYear('childbirth_date', $year)
                            ->whereMonth('childbirth_date', $month)
                            ->where('mother_condition_id', 3)->count(),
            ],
            'abortus' => Pregnancy::whereYear('childbirth_date', $year)
                        ->whereMonth('childbirth_date', $month)
                        ->where('parturition_id', 1)->count(),
            'bayi_lahir_hidup' => [
                'l' => Childbirth::where('sex_id', 1)
                        ->whereHas('babyConditions', function(Builder $query) {
                            $query->whereNotIn('id', [8]);
                        })->whereHas('pregnancy', function(Builder $query) use ($year, $month) {
                            $query->whereYear('childbirth_date', $year)
                                ->whereMonth('childbirth_date', $month);
                        })->count(),
                'p' => Childbirth::where('sex_id', 2)
                        ->whereHas('babyConditions', function(Builder $query) {
                            $query->whereNotIn('id', [8]);
                        })->whereHas('pregnancy', function(Builder $query) use ($year, $month) {
                            $query->whereYear('childbirth_date', $year)
                                ->whereMonth('childbirth_date', $month);
                        })->count(),
            ],
            'bayi_lahir_mati' => [
                'l' => Childbirth::where('sex_id', 1)
                        ->whereHas('babyConditions', function(Builder $query) {
                            $query->where('id', 8);
                        })->whereHas('pregnancy', function(Builder $query) use ($year, $month) {
                            $query->whereYear('childbirth_date', $year)
                                ->whereMonth('childbirth_date', $month);
                        })->count(),
                'p' => Childbirth::where('sex_id', 2)
                        ->whereHas('babyConditions', function(Builder $query) {
                            $query->where('id', 8);
                        })->whereHas('pregnancy', function(Builder $query) use ($year, $month) {
                            $query->whereYear('childbirth_date', $year)
                                ->whereMonth('childbirth_date', $month);
                        })->count(),
            ],
            'level_1' => Childbirth::whereHas('pregnancy', function (Builder $query) use ($year, $month) {
                            $query->whereYear('childbirth_date', $year)
                                ->whereMonth('childbirth_date', $month);
                        })->where('weight', '<', 2000)->count(),
            'level_2' => Childbirth::whereHas('pregnancy', function (Builder $query) use ($year, $month) {
                            $query->whereYear('childbirth_date', $year)
                                ->whereMonth('childbirth_date', $month);
                        })->where(function($query) {
                            $query->where('weight', '>=', 2000)
                                ->where('weight', '<', 2400);
                        })->count(),
            'level_3' => Childbirth::whereHas('pregnancy', function (Builder $query) use ($year, $month) {
                            $query->whereYear('childbirth_date', $year)
                                ->whereMonth('childbirth_date', $month);
                        })->where(function($query) {
                            $query->where('weight', '>=', 2400)
                                ->where('weight', '<', 3700);
                        })->count(),
            'level_4' => Childbirth::whereHas('pregnancy', function (Builder $query) use ($year, $month) {
                            $query->whereYear('childbirth_date', $year)
                                ->whereMonth('childbirth_date', $month);
                        })->where('weight', '>=', 3700)->count(),
            'bayi_nifas_hidup' => [
                'l' => Childbirth::where('sex_id', 1)
                        ->whereHas('pregnancy', function (Builder $query) use ($year, $month) {
                            $query->whereYear('childbirth_date', $year)
                                ->whereMonth('childbirth_date', $month)
                                ->whereHas('puerperal', function (Builder $query) {
                                    $query->whereHas('babyConditions', function (Builder $query) {
                                        $query->whereNotIn('id', [8]);
                                    });
                                });
                        })->count(),
                'p' => Childbirth::where('sex_id', 2)
                        ->whereHas('pregnancy', function (Builder $query) use ($year, $month) {
                            $query->whereYear('childbirth_date', $year)
                                ->whereMonth('childbirth_date', $month)
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
                            $query->whereYear('childbirth_date', $year)
                                ->whereMonth('childbirth_date', $month)
                                ->whereHas('puerperal', function (Builder $query) {
                                    $query->whereHas('babyConditions', function (Builder $query) {
                                        $query->where('id', 8);
                                    });
                                });
                        })->count(),
                'p' => Childbirth::where('sex_id', 2)
                        ->whereHas('pregnancy', function (Builder $query) use ($year, $month) {
                            $query->whereYear('childbirth_date', $year)
                                ->whereMonth('childbirth_date', $month)
                                ->whereHas('puerperal', function (Builder $query) {
                                    $query->whereHas('babyConditions', function (Builder $query) {
                                        $query->where('id', 8);
                                    });
                                });
                        })->count(),
            ],
            'ibu_nifas_hidup' => Puerperal::whereHas('pregnancy', function (Builder $query) use ($year, $month) {
                                    $query->whereYear('childbirth_date', $year)
                                            ->whereMonth('childbirth_date', $month);
                                })->whereNotIn('mother_condition_id', [8])->count(),
            'ibu_nifas_mati' => Puerperal::whereHas('pregnancy', function (Builder $query) use ($year, $month) {
                                    $query->whereYear('childbirth_date', $year)
                                            ->whereMonth('childbirth_date', $month);
                                })->where('mother_condition_id', 8)->count(),
        ];
    }
    
}
