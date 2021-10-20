<?php
namespace App\Services;

use App\Models\Person;
use App\Models\Posyandu;
use App\Models\PrenatalClass;

class PosyanduService
{
    public function getAllBalita()
    {
        return Posyandu::with([
            'person',
            'neonatuses',
        ])->get();
    }

    public function store($request)
    {
        return Person::find($request->person_id)->posyandu()->create();
    }
}
