<?php
namespace App\Services;

use App\Models\Person;
use App\Models\Posyandu;
use App\Models\PrenatalClass;
use Carbon\Carbon;

class PosyanduService
{
    public function getAllBalita()
    {
        // return Posyandu::with([
        //     'person',
        //     'neonatuses',
        // ])->get();
        
        // ambil semua person yang umurnya < 6 tahun
        return Person::with(['posyandu'])
            ->whereDate('date_of_birth', '>', Carbon::now()->addYears(-5))
            ->get();
    }

    public function store($request, $person)
    {
        return $person->posyandu()->create($request->all());
    }
}
