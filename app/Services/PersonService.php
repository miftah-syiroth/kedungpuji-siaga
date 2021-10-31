<?php
namespace App\Services;

use App\Models\Person;

class PersonService
{
    public function getPerson($person)
    {
        return Person::with([
            'sex', //
            'religion', //
            'bloodGroup', //
            'disability', //
            'educational', //
            'mother', 'father', //
            'maritalStatus', //
            'family.leader', //
            // 'familyStatus',
            // 'family.leader',
            // 'wifes.wife.maritalStatus',
            // 'husband.husband.maritalStatus',
            // 'husband.kbService',
            // 'kepalaKeluarga.keluargaSejahtera',
            // 'kepalaKeluarga.people' => function ($query) {
            //     $query->orderBy('family_status_id', 'ASC');
            // },
            // 'kepalaKeluarga.people.sex',
            // 'kepalaKeluarga.people.bloodGroup',
            // 'kepalaKeluarga.people.education',
            // 'keluargaBerencana' => function ($query) {
            //     $query->where('year_periode', Carbon::now()->year);
            // },
            // 'keluargaBerencana.kbStatus',
            // 'pregnancies',
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
}
