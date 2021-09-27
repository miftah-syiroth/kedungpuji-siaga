<?php
namespace App\Services;

use App\Models\Family;
use App\Models\KeluargaSejahtera;
use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;

class FamilyService
{
    public function getAllKeluargaSejahtera()
    {
        return KeluargaSejahtera::all();
    }

    public function getAllFamilies()
    {
        return Family::with(['leader'])->get();
    }

    public function store($request)
    {
        // buat keluarganya dahulu dgn relasi kepala keluarga
        $family = Person::find($request->person_id)->kepalaKeluarga()->create([
            'nomor_kk' => $request->nomor_kk,
            'keluarga_sejahtera_id' => $request->keluarga_sejahtera_id
        ]);

        // update user sebagai anggota keluarga
        Person::find($request->person_id)->family()->associate($family)->save();
    }
}
