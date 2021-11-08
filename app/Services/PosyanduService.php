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

    public function store($request, $person)
    {
        return $person->posyandu()->create($request->all());
    }

    public function getDeletedPosyandu()
    {
        return Posyandu::onlyTrashed()
            ->with(['person' => function($query) {
                $query->withTrashed();
            },])->get();
    }

    public function softDelete($posyandu)
    {
        // hapus neonatus
        if ($posyandu->neonatuses->isNotEmpty()) {
            $posyandu->neonatuses()->delete();
        }
        if ($posyandu->anthropometries->isNotEmpty()) {
            $posyandu->anthropometries()->delete();
        }
        $posyandu->delete();
    }

    public function forceDelete($posyandu)
    {
        $posyandu = Posyandu::withTrashed()
            ->with(['neonatuses' => function($query) {
                $query->withTrashed();
            }, 'anthropometries' => function($query) {
                $query->withTrashed();
            },])->find($posyandu);

        // hapus permanen
        if ($posyandu->neonatuses->isNotEmpty()) {
            $posyandu->neonatuses()->forceDelete();
        }
        if ($posyandu->anthropometries->isNotEmpty()) {
            $posyandu->anthropometries()->forceDelete();
        }
        $posyandu->forceDelete();
    }

    public function restore($posyandu)
    {
        $posyandu = Posyandu::withTrashed()
            ->with(['neonatuses' => function($query) {
                $query->withTrashed();
            }, 'anthropometries' => function($query) {
                $query->withTrashed();
            },])->find($posyandu);

        // batalkan jika person bernilai null (terhapus) atau sudah punya data posyandu lain. relasi one to one sehingga tdk boleh ada 2 posyandu pada 1 person
        $person = $posyandu->person;
        
        if ($person == null || $person->posyandu !== null) {
            return false;
        } else {
            if ($posyandu->neonatuses->isNotEmpty()) {
                $posyandu->neonatuses()->restore();
            }
            if ($posyandu->anthropometries->isNotEmpty()) {
                $posyandu->anthropometries()->restore();
            }
            $posyandu->restore();
            return true;
        }
    }
}
