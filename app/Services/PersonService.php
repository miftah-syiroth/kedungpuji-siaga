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
        $atttributes = $request->all();
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

        if ($request->has('mother_id')) {
            $attributes['mother_id'] = $request->mother_id;
        }

        if ($request->has('father_id')) {
            $attributes['father_id'] = $request->father_id;
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
        return Person::onlyTrashed()->get();
    }

    public function softDelete($person)
    {
        // jika dia kepala keluarga, hapus semua anggota pada pivot table, lalu hapus keluarganya
        if (isset($person->ledFamily)) {
            $person->ledFamily->people()->detach();
            $person->ledFamily()->delete();
        }

        // jika anggot sebuah keluarga, keluarkan dia dari keanggotaan
        if ($person->family()->exists()) {
            $family = $person->family()->first();
            $family->people()->detach($person->id);
        }

        // jika dia seorang istri (punya pasangan suami)
        if (isset($person->husband)) {
            if (isset($person->husband->keluargaBerencana)) {
                $person->husband->keluargaBerencana()->delete();
            }
            $person->husband()->delete();
        }

        if (isset($person->wifes)) {
            if (isset($person->wifes->keluargaBerencana)) {
                $person->wifes->keluargaBerencana()->delete();
            }
            
            $person->wifes()->delete();
        }

        // jika memiliki kehamilan, hapus semua child relation dibawah kehamilan berupa kelas nifas, nifas, dan kelas ibu hamil
        if (isset($person->pregnancies)) {

            if (isset($person->pregnancies->puerperal)) {

                if (isset($person->pregnancies->puerperal->puerperalClasses)) {
                    $person->pregnancies->puerperal->puerperalClasses()->delete();
                }

                $person->pregnancies->puerperal()->delete();
            }
            if (isset( $person->pregnancies->prenatalClasses)) {
                $person->pregnancies->prenatalClasses()->delete();
            }

            $person->pregnancies()->delete();
        }

        if (isset($person->posyandu)) {
            if (isset($person->posyandu->neonatuses)) {
                $person->posyandu->neonatuses()->delete();
            }
            if (isset($person->posyandu->anthropometries)) {
                $person->posyandu->anthropometries()->delete();
            }
            $person->posyandu()->delete();
        }

        $person->delete();
    }

    public function forceDelete($person)
    {
        $person = Person::withTrashed()->find($person);

        // jika dia kepala keluarga, hapus semua anggota pada pivot table, lalu hapus keluarganya
        if (isset($person->ledFamily)) {
            $person->ledFamily()->forceDelete();
        }

        // jika dia seorang istri (punya pasangan suami)
        if (isset($person->husband)) {
            if (isset($person->husband->keluargaBerencana)) {
                $person->husband->keluargaBerencana()->forceDelete();
            }
            $person->husband()->forceDelete();
        }

        if (isset($person->wifes)) {
            if (isset($person->wifes->keluargaBerencana)) {
                $person->wifes->keluargaBerencana()->forceDelete();
            }
            
            $person->wifes()->forceDelete();
        }

        // jika memiliki kehamilan, hapus semua child relation dibawah kehamilan berupa kelas nifas, nifas, dan kelas ibu hamil
        if (isset($person->pregnancies)) {

            if (isset($person->pregnancies->puerperal)) {

                if (isset($person->pregnancies->puerperal->puerperalClasses)) {
                    $person->pregnancies->puerperal->puerperalClasses()->forceDelete();
                }

                $person->pregnancies->puerperal()->forceDelete();
            }
            if (isset( $person->pregnancies->prenatalClasses)) {
                $person->pregnancies->prenatalClasses()->forceDelete();
            }

            $person->pregnancies()->forceDelete();
        }

        if (isset($person->posyandu)) {
            if (isset($person->posyandu->neonatuses)) {
                $person->posyandu->neonatuses()->forceDelete();
            }
            if (isset($person->posyandu->anthropometries)) {
                $person->posyandu->anthropometries()->forceDelete();
            }
            $person->posyandu()->forceDelete();
        }

        $person->forceDelete();
    }

    public function restore($person)
    {
        $person = Person::withTrashed()->find($person);

        // jika dia kepala keluarga, cek dulu 
        if (isset($person->ledFamily)) {
            $person->ledFamily()->restore();
        }

        // jika dia seorang istri (punya pasangan suami)
        if (isset($person->husband)) {
            if (isset($person->husband->keluargaBerencana)) {
                $person->husband->keluargaBerencana()->restore();
            }
            $person->husband()->restore();
        }

        // jika memiliki kehamilan, hapus semua child relation dibawah kehamilan berupa kelas nifas, nifas, dan kelas ibu hamil
        if (isset($person->pregnancies)) {

            if (isset($person->pregnancies->puerperal)) {

                if (isset($person->pregnancies->puerperal->puerperalClasses)) {
                    $person->pregnancies->puerperal->puerperalClasses()->restore();
                }

                $person->pregnancies->puerperal()->restore();
            }
            if (isset( $person->pregnancies->prenatalClasses)) {
                $person->pregnancies->prenatalClasses()->restore();
            }

            $person->pregnancies()->restore();
        }

        $person->restore();
    }
}
