<?php
namespace App\Services;

use App\Models\Person;
use App\Models\Posyandu;
use App\Models\PrenatalClass;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class PosyanduService
{
    public function getAllBalita($filters)
    {
        if (isset($filters['status_id'])) {
            if ($filters['status_id'] == true) {
                $filters['posyandu'] = true;
            } else {
                $filters['non_posyandu'] = true;
            }
        }

        // ambil semua person yang umurnya < 60 bulan
        return Person::where('is_alive', true)
            ->where('village_id', 1)
            ->whereDate('date_of_birth', '>=', Carbon::now()->addMonths(-60))
            ->filter($filters)
            ->latest()
            ->paginate(20);
    }

    public function getDeletedPosyandu()
    {
        return Posyandu::onlyTrashed()->get();
    }
    
    public function store($request, $person)
    {
        return $person->posyandu()->create($request->all());
    }

    public function destroy($posyandu)
    {
        // hapus neonatus
        if (isset($posyandu->neonatuses)) {
            $posyandu->neonatuses()->delete();
        }
        if (isset($posyandu->anthropometries)) {
            $posyandu->anthropometries()->delete();
        }
        $posyandu->delete();
    }

    public function deletePermanently($posyandu)
    {
        $posyandu = Posyandu::withTrashed()->find($posyandu);
        // hapus permanen
        if (isset($posyandu->neonatuses)) {
            $posyandu->neonatuses()->forceDelete();
        }
        if (isset($posyandu->anthropometries)) {
            $posyandu->anthropometries()->forceDelete();
        }

        $posyandu->forceDelete();
    }

    public function restore($posyandu)
    {
        $posyandu = Posyandu::withTrashed()->find($posyandu);
        // cek apakah personnya sudah ada relasi dgn posyandu lainnya
        $person = $posyandu->person;
        
        if (isset($person->posyandu)) { // jika sudah berelasi dgn posyandu lainnya, batalkan
            return false;
        } else {
            if (isset($posyandu->neonatuses)) {
                $posyandu->neonatuses()->restore();
            }
            if (isset($posyandu->anthropometries)) {
                $posyandu->anthropometries()->restore();
            }
            
            $posyandu->restore();
            return true;
        }
    }
}
