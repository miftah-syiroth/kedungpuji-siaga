<?php
namespace App\Services;

use App\Models\Couple;
use App\Models\KbService;

class CoupleService
{
    public function getAllKbServices()
    {
        return KbService::all();
    }

    public function store($request)
    {
        Couple::create($request->toArray());
    }
}
