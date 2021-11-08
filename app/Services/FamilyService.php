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
    public function getFamily($family_id)
    {
        return Family::with([
            'people' => function($query) {
                $query->orderBy('family_status_id', 'ASC');
            },
            'people.sex',
            'people.bloodGroup',
            'keluargaSejahtera',
        ])->withCount('people')->find($family_id);
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

    
    /**
     * getDeletedFamilies, ambil keluarga yang terhapus
     *
     * @return void
     */
    public function getDeletedFamilies()
    {
        return Family::onlyTrashed()
            ->with(['leader' => function($query) {
                $query->withTrashed();
            }, 'people' => function($query) {
                $query->withTrashed();
            }])->orderBy('deleted_at', 'desc')->get();
    }

    public function destroy($family)
    {
        $family->people()->detach(); // hapus semua row di tabel intermediate
        $family->delete();
    }

    public function forceDelete($family)
    {
        $family = Family::withTrashed()
            ->with(['people' => function($query) {
                $query->withTrashed();
            }])->find($family);

        $family->people()->detach(); // hapus semua row di tabel intermediate
        $family->forceDelete();
    }

    public function restore($family)
    {
        $family = Family::withTrashed()->find($family);
        
        $leader = $family->leader;
        // kalau kepala keluarga sebelumnya null artinya dia sudah terhapus  maka batalkan
        // kalau ga null, cek apakah sudah jd anggota keluarga lain, jika iya batalkan,
        // kepala keluarga ga bisa buat baris keluarga baru karena leader_id harus unique
        if ($family->leader == null || $leader->family->isNotEmpty()) {
            return false;
        } else {
            // karena pada softDel dilakukan detach all, maka tambahkan lagi leader sbg kepala keluarga
            $leader->family()->sync([
                $family->id => ['family_status_id' => 1], // satu adlh status kepala keluarga
            ]);

            $family->restore();
            return true;
        }
    }
}
