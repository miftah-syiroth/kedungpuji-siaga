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

class PersonService
{
    public function getAllPeople()
    {
        return Person::with(['sex', 'bloodGroup', 'maritalStatus', 'family', 'familyStatus'])->get();
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

    public function store($request)
    {
        // dd($request->marital_status_id);
        // buat secara normal utk semua atribut meskipun null
        $person = Person::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'religion_id' => $request->religion_id,
            'blood_group_id' => $request->blood_group_id,
            'sex_id' => $request->sex_id,
            'educational_id' => $request->educational_id,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'marital_status_id' => $request->marital_status_id,
            'is_cacat' => $request->is_cacat,
            'disability_id' => $request->disability_id, // perhatikan jika is_cacat true, maka ada input
            'family_status_id' => $request->family_status_id,
            'family_id' => $request->family_id,
            'ibu_id' => $request->ibu_id,
            'ayah_id' => $request->ayah_id,
        ]);

        // buat keluarga jika input family status ==1 atau ada nomor kk, sbnrnya cukup satu aja, krn ketika family status bukan 1, ga akan muncul input nomor kk
        if ($request->family_status_id == 1 || $request->nomor_kk) {
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
        
        // buat pasangan jika marital status adalah 2 atau 3
        if ($request->marital_status_id == 2 || $request->marital_status_id == 3) {
            if ($request->sex_id == 1) { // jika kelamin pria, maka buat row baru
                $person->wifes()->create([
                    'istri_id' => $request->couple_id,
                    'is_kb' => $request->is_kb,
                    'kb_service_id' => $request->kb_service_id,
                ]);
            }elseif ($request->sex_id == 2) { // jika kelamin wanita, maka update atau buat
                $result = Couple::updateOrCreate(
                    ['suami_id' => $request->couple_id,],
                    [
                        'istri_id' => $person->id,
                        'is_kb' => $request->is_kb,
                        'kb_service_id' => $request->kb_service_id,
                    ],
                );
            }
        }
    }
}
