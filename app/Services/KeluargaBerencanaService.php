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

    public function getCouples($filters)
    {
        return Couple::whereHas('wife', function (Builder $query) {
            $query->where('is_alive', true)
                ->where('village_id', 1)
                ->whereDate('date_of_birth', '<=', Carbon::now()->addYears(-15) )
                ->whereDate('date_of_birth', '>=', Carbon::now()->addYears(-49) );
            })->with(['kbService', 'keluargaBerencana.kbStatus', ])
            ->filter($filters)
            ->latest()
            ->paginate(20);
    }
}
