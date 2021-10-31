<?php
namespace App\Services;

use App\Models\Couple;
use App\Models\KeluargaBerencana;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class KeluargaBerencanaService
{
    public function store($request, $couple)
    {
        KeluargaBerencana::updateOrCreate(
            [
                'couple_id' => $couple->id,
                'year_periode' => $request->year_periode,
                'month_periode' => $request->month_periode,
            ],
            [
                'kb_status_id' => $request->kb_status_id,
            ],
        );
    }
}
