<?php
namespace App\Services;

use App\Models\Family;
use App\Models\KeluargaSejahtera;
use App\Models\Person;

class FamilyService
{
    public function getAllKeluargaSejahtera()
    {
        return KeluargaSejahtera::all();
    }

    public function getAllKepalaKeluarga()
    {
        // ambil semua orang dengan status kepala keluarga yg belum mempunyai keluarga
        return Person::where('family_status_id', 1)->select('id', 'name')->get();
    }

    public function getAllFamilies()
    {
        return Family::with(['leadBy'])->get();
    }

    public function store($request)
    {
        return Person::find($request->person_id)->kepalaKeluarga()->create([
            'nomor_kk' => $request->nomor_kk,
            'keluarga_sejahtera_id' => $request->keluarga_sejahtera_id
        ]);
    }
}
