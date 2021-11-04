<?php
namespace App\Services;

use App\Models\Person;
use App\Models\Posyandu;
use App\Models\PrenatalClass;
use Carbon\Carbon;

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
            ->whereDate('date_of_birth', '>', Carbon::now()->addMonths(-60))
            ->filter($filters)
            ->latest()
            ->paginate(20);
    }

    public function store($request, $person)
    {
        return $person->posyandu()->create($request->all());
    }
}
