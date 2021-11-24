<?php
namespace App\Services;

use App\Models\Person;

class PersonService
{
    public function getPeople($filters)
    {
        return Person::with([
            'bloodGroup',
            'maritalStatus',
            'sex',
            'family'
        ])->where('is_alive', true)
            ->where('village_id', 1)
            ->filter($filters)
            ->latest()
            ->paginate(20);
    }

    public function getPeopleDeadOrMoved($filters)
    {
        return Person::with([
            'bloodGroup',
            'maritalStatus',
            'sex',
            'family'
        ])->where('is_alive', false)
            ->orwhere('village_id', 2)
            ->filter($filters)
            ->latest()
            ->paginate(20);
    }

    public function getPerson($person)
    {
        return Person::with([
            'sex', //
            'religion', //
            'bloodGroup', //
            'disability', //
            'educational', //
            'mother.motherChildren', 'father.fatherChildren', //
            'maritalStatus', //
            'family.leader', //
            'pregnancies',
        ])->find($person->id);
    }

    public function store($request)
    {
        // isi dari father/mother_id pd request adalah nik, supaya ringkas diberi name father_id
        $atttributes = $request->all();

        if ($request->filled('father_id')) {
            $atttributes['father_id'] = Person::where('nik', $request->father_id)->value('id');
        }

        if ($request->filled('mother_id')) {
            $atttributes['mother_id'] = Person::where('nik', $request->mother_id)->value('id');
        }

        $atttributes['village_id'] = 1;
        $atttributes['is_alive'] = true;

        return Person::create($atttributes);
    }

    public function update($request, $person)
    {
        $attributes = $request->all(); // ubah dalam bentuk array dan simpan ke variable

        if ($request->is_alive == true) {
            $attributes['died_at'] = null;
        }

        if ($request->filled('father_id')) {
            $father = Person::where('nik', $request->father_id)->first();
            $attributes['father_id'] = $father->id;
        }

        if ($request->filled('mother_id')) {
            $mother = Person::where('nik', $request->mother_id)->first();
            $atttributes['mother_id'] = $mother->id;
        }

        $person->update($attributes);
    }

    public function changePersonsFamily($request, $person)
    {
        // kalau dia punya relasi sebagai kepala keluarga sebelumnya, hapus saja keluarga tsb, family_id pada child table harusnya menjadi null. ini karena seseorang ga boleh tercantum pada 2 KK
        if ($person->kepalaKeluarga) {
            $person->kepalaKeluarga->delete();
        }

        // kalau family statusnya selain kepala keluarga, cukup update saja, itu cuma pindah keluarga dan status anggotanya
        if ($request->family_status_id == 1) {
            $this->createFamily($request, $person);
        } elseif($request->family_status_id != 1) {
            // dd($request->family_id);
            $person->update([
                'family_status_id' => $request->family_status_id,
                'family_id' => $request->family_id,
            ]);
        }   
    }

    public function createFamily($request, $person)
    {
        // isi untuk tabel famili dulu
        $family = $person->kepalaKeluarga()->create([
            'keluarga_sejahtera_id' => $request->keluarga_sejahtera_id,
            'nomor_kk' => $request->nomor_kk,
        ]);

        // lalu update di model person
        $person->update([
            'family_id' => $family->id,
        ]);
    }

    public function getDeletedPeople()
    {
        return Person::onlyTrashed()
            ->with(['mother' => function($query) {
                $query->withTrashed();
            }])->orderBy('deleted_at', 'desc')->get();
    }

    public function softDelete($person)
    {
        if ($person->ledFamily !== null) {
            $person->ledFamily->people()->detach(); // hapus semua row di tabel intermediate
            $person->ledFamily()->delete();
        }

        // jika dia seorang istri (punya pasangan suami)
        if ($person->husband !== null) {
            if ($person->husband->keluargaBerencana->isNotEmpty()) {
                $person->husband->keluargaBerencana()->delete();
            }
            $person->husband()->delete();
        }

        // jika dia suami
        if ($person->wifes->isNotEmpty()) {
            
            foreach ($person->wifes as $key => $wife) {
                if ($wife->keluargaBerencana->isNotEmpty()) {
                    $wife->keluargaBerencana()->delete();
                }
            }
            $person->wifes()->delete();
        }

        // jika memiliki kehamilan, hapus semua child relation dibawah kehamilan berupa kelas nifas, nifas, dan kelas ibu hamil
        if ($person->pregnancies->isNotEmpty()) {
            foreach ($person->pregnancies as $key => $pregnancy) {
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
            }
            $person->pregnancies()->delete();
        }

        if ($person->posyandu !== null) {
            if ($person->posyandu->neonatuses->isNotEmpty()) {
                $person->posyandu->neonatuses()->delete();
            }
            if ($person->posyandu->anthropometries->isNotEmpty()) {
                $person->posyandu->anthropometries()->delete();
            }
            $person->posyandu()->delete();
        }

        $person->delete();
    }
    
    /**
     * forceDelete akan menghapus data individu dan semua relasi terkait secara permanen
     *
     * @param  mixed $person
     * @return void
     */
    public function forceDelete($person)
    {
        $person = Person::withTrashed()
            ->with(['ledFamily' => function($query) {
                $query->withTrashed();
            }, 'family' => function($query) {
                $query->withTrashed();
            }, 'husband'  => function($query) {
                $query->withTrashed();
            }, 'husband.keluargaBerencana' => function($query) {
                $query->withTrashed();
            }, 'wifes' => function($query) {
                $query->withTrashed();
            }, 'wifes.keluargaBerencana' => function($query) {
                $query->withTrashed();
            }, 'pregnancies' => function($query) {
                $query->withTrashed();
            }, 'pregnancies.prenatalClasses' => function($query) {
                $query->withTrashed();
            }, 'pregnancies.childbirths' => function($query) {
                $query->withTrashed();
            }, 'pregnancies.puerperal' => function($query) {
                $query->withTrashed();
            }, 'pregnancies.puerperal.puerperalClasses' => function($query) {
                $query->withTrashed();
            }, 'posyandu' => function($query) {
                $query->withTrashed();
            }, 'posyandu.neonatuses' => function($query) {
                $query->withTrashed();
            }, 'posyandu.anthropometries' => function($query) {
                $query->withTrashed();
            }])->find($person);

        // foreach ($person->pregnancies as $key => $pregnancy) {
        //     dd($pregnancy->puerperal->babyConditions);
        // }
        // jika anggota sebuah keluarga, keluarkan dia dari keanggotaan
        if ($person->family->isNotEmpty()) {
            $family = $person->family->first();
            $family->people()->detach($person->id);
        }

        // jika dia kepala keluarga, hapus semua anggota pada pivot table, lalu hapus keluarganya
        if ($person->ledFamily !== null) {
            $person->ledFamily->people()->detach(); // hapus semua row di tabel intermediate
            $person->ledFamily()->forceDelete();
        }

        // jika dia seorang istri (punya pasangan suami)
        if ($person->husband !== null) {
            if ($person->husband->keluargaBerencana->isNotEmpty()) {
                $person->husband->keluargaBerencana()->forceDelete();
            }
            $person->husband()->forceDelete();
        }

        if ($person->wifes->isNotEmpty()) {
            foreach ($person->wifes as $key => $wife) {
                if ($wife->keluargaBerencana->isNotEmpty()) {
                    $wife->keluargaBerencana()->forceDelete();
                }
            }
            $person->wifes()->forceDelete();
        }

        // jika memiliki kehamilan, hapus semua child relation dibawah kehamilan berupa kelas nifas, nifas, dan kelas ibu hamil
        if ($person->pregnancies->isNotEmpty()) {

            foreach ($person->pregnancies as $key => $pregnancy) {
                if ($pregnancy->puerperal !== null) {

                    if ($pregnancy->puerperal->puerperalClasses->isNotEmpty()) {
                        $pregnancy->puerperal->puerperalClasses()->forceDelete();
                    }
                    // hapus berbagai kondisi ibu dan bayi pasca nifas pd tabel pivot
                    $pregnancy->puerperal->babyConditions()->detach();
                    $pregnancy->puerperal->complications()->detach();

                    $pregnancy->puerperal()->forceDelete();
                }

                if ($pregnancy->prenatalClasses->isNotEmpty()) {
                    $pregnancy->prenatalClasses()->forceDelete();
                }

                if ($pregnancy->childbirths->isNotEmpty()) {
                    foreach ($pregnancy->childbirths as $key => $childbirth) {
                        $childbirth->babyConditions()->detach(); // tabel kondisi bayi pasca dilahirkan
                    }
                    $pregnancy->childbirths()->forceDelete();
                }

                $pregnancy->babyConditions()->detach();
            }
            $person->pregnancies()->forceDelete();
        }

        if ($person->posyandu !== null) {
            if ($person->posyandu->neonatuses->isNotEmpty()) {
                $person->posyandu->neonatuses()->forceDelete();
            }
            if ($person->posyandu->anthropometries->isNotEmpty()) {
                $person->posyandu->anthropometries()->forceDelete();
            }
            $person->posyandu()->forceDelete();
        }

        $person->forceDelete();
    }
    
    /**
     * restore hanya akan merestore data penduduk saja, relasi dibawahnya tidak ikut serta restore. restore satu persatu
     *
     * @param  mixed $person
     * @return void
     */
    public function restore($person)
    {
        $person = Person::withTrashed()->find($person);
        // $person = Person::withTrashed()
        //     ->with([
        //         'ledFamily' => function($query) {
        //             $query->withTrashed();
        //         }, 'husband.keluargaBerencana' => function($query) {
        //             $query->withTrashed();
        //         }, 'wifes.keluargaBerencana' => function($query) {
        //             $query->withTrashed();
        //         }, 'pregnancies.puerperal.puerperalClasses' => function($query) {
        //             $query->withTrashed();
        //         }, 'pregnancies.prenatalClasses' => function($query) {
        //             $query->withTrashed();
        //         },
        //     ])->find($person);

        #RELASI DENGAN KELUARGA
        // jika dia kepala keluarga, cek dulu 
        // if (isset($person->ledFamily)) {
        //     $person->ledFamily()->restore();
        // }

        # RELASI ISTRI DENGAN PASANGANNYA (SUAMI)
        // jika dia seorang istri (punya pasangan suami)
        // if (isset($person->husband)) {
        //     if (isset($person->husband->keluargaBerencana)) {
        //         $person->husband()->keluargaBerencana()->restore();
        //     }
        //     $person->husband()->restore();
        // }

        # RELASI SUAMI DENGAN PASANGANNYA (ISTRI-ISTRI)
        // jika memiliki kehamilan, hapus semua child relation dibawah kehamilan berupa kelas nifas, nifas, dan kelas ibu hamil
        // if (isset($person->pregnancies)) {

        //     if (isset($person->pregnancies->puerperal)) {

        //         if (isset($person->pregnancies->puerperal->puerperalClasses)) {
        //             $person->pregnancies->puerperal->puerperalClasses()->restore();
        //         }

        //         $person->pregnancies->puerperal()->restore();
        //     }
        //     if (isset( $person->pregnancies->prenatalClasses)) {
        //         $person->pregnancies->prenatalClasses()->restore();
        //     }

        //     $person->pregnancies()->restore();
        // }

        $person->restore();
    }
}
