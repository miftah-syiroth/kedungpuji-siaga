<?php
namespace App\Services;

use App\Models\Couple;
use App\Models\KeluargaBerencana;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class KbService
{
    public function getAnualReport()
    {
        return Couple::whereHas('wife', function (Builder $query) {
            $query->whereDate('date_of_birth', '<=', Carbon::now()->addYears(-15) )
                ->whereDate('date_of_birth', '>=', Carbon::now()->addYears(-49) );
        })->with(['kbService', 'keluargaBerencana.kbStatus', 'keluargaBerencana' => function($query){
            $query->where('year_periode', Carbon::now()->year);
        }])->get();
    }

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
