<?php
namespace App\Services;

use App\Models\BloodGroup;
use App\Models\Couple;
use App\Models\Disability;
use App\Models\Educational;
use App\Models\FamilyStatus;
use App\Models\KbService;
use App\Models\KeluargaSejahtera;
use App\Models\MaritalStatus;
use App\Models\Person;
use App\Models\Religion;
use App\Models\Sex;
use Carbon\Carbon;

class PersonService
{
    public function getAllPeople()
    {
        return Person::with([
            'sex', 
            'family' => function ($query) {
                $query->first();
            },
            'maritalStatus',
            'bloodGroup',
        ])->get();
    }

    public function getPerson($person)
    {
        return Person::with([
            'sex', //
            'religion', //
            'bloodGroup', //
            'disability', //
            'education', //
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
    
    /**
     * getFamilyStatuses menampilkan semua status keanggotaan keluarga untuk looping pada form create person
     *
     * @return void
     */
    public function getFamilyStatuses()
    {
        return FamilyStatus::all();
    }

    public function getSexes()
    {
        return Sex::all();
    }

    public function getReligions()
    {
        return Religion::all();
    }

    public function getBloodGroups()
    {
        return BloodGroup::all();
    }

    public function getEducationals()
    {
        return Educational::all();
    }

    public function getDisabilities()
    {
        return Disability::all();
    }

    public function getMaritalStatuses()
    {
        return MaritalStatus::all();
    }

    public function getKeluargaSejahtera()
    {
        return KeluargaSejahtera::all();
    }

    public function getKbServices()
    {
        return KbService::all();
    }

    public function storePerson($request)
    {
        $attributes = $request->all();
        // buat secara normal utk semua atribut meskipun null
        return Person::create($attributes);
    }

    public function update($request, $person)
    {
        $attributes = $request->all(); // ubah dalam bentuk array dan simpan ke variable

        if ($request->has('ibu_id')) {
            $attributes['ibu_id'] = $request->ibu_id;
        }

        if ($request->has('ayah_id')) {
            $attributes['ayah_id'] = $request->ayah_id;
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
