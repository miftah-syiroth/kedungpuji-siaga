<?php
namespace App\Services;

use App\Models\Family;
use App\Models\Person;

class FamilyService
{
    public function getAllFamilies($filters)
    {
        return Family::with([
            'leader' => function ($query) {
                $query->where('is_alive', true)
                    ->where('village_id', 1);
            },
            'keluargaSejahtera',
        ])->filter($filters)
            ->latest()
            ->paginate(20);
    }
    
    /**
     * SUCCESS
     *
     * @param  mixed $family
     * @return void
     */
    public function getFamily($family)
    {
        return Family::with([
            'people' => function($query) {
                $query->orderBy('family_status_id', 'ASC');
            },
            'people.sex',
            'people.bloodGroup',
            'people.education',
            'people.disability',
            'people.maritalStatus',
            'keluargaSejahtera',
        ])->withCount('people')->find($family->id);
    }
    
    /**
     * SUCCESS
     *
     * @param  mixed $request
     * @return void
     */
    public function store($request)
    {
        $family = Family::create($request->all());

        $person = Person::find($request->person_id);
        // buat keluarganya dahulu dgn relasi kepala keluarga
        // $family = $person->kepalaKeluarga()->create([
        //     'nomor_kk' => $request->nomor_kk,
        //     'keluarga_sejahtera_id' => $request->keluarga_sejahtera_id
        // ]);

        // sync dari person ke family yg telah dibuat serta status kekeluargaannya
        $person->family()->sync([
            $family->id => ['family_status_id' => 1], // satu adlh status kepala keluarga
        ]);

        // kembalikan family supaya bisa redirect ke show family
        return $family;
    }

    public function update($request, $family)
    {
        $attributes = $request->all();

        if ($request->has('person_id')) {
            $person = Person::find($request->person_id); // calon kepala keluarga

            // detach row kepala keluarga saat ini pada tabel intermediata untuk digantikan dgn calon yg baru
            $family->people()->detach($family->person_id);

            // sync dari calon yg baru ke family serta status kekeluargaannya
            $person->family()->sync([
                $family->id => ['family_status_id' => 1], // satu adlh status kepala keluarga
            ]);

            $attributes['person_id'] = $person->id;
        }
        $family->update($attributes);
    }

    public function addFamilyMember($request, $family)
    {
        Person::find($request->person_id)->family()->sync([
            $family->id => ['family_status_id' => $request->family_status_id], 
        ]);
    }

    public function removeFamilyMember($family, $person)
    {
        $family->people()->detach($person->id);
    }

    public function destroy($family)
    {
        $family->people()->detach(); // hapus semua row di tabel intermediate
        $family->delete();
    }
}
