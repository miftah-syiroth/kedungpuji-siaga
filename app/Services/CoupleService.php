<?php
namespace App\Services;

use App\Models\Couple;
use App\Models\KbService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class CoupleService
{
    public function getAllKbServices()
    {
        return KbService::all();
    }
        
    /**
     * ambil semua pasangan yang umur istrinya di atas 15 tahun dan dibawah 49 tahun
     *
     * @return void
     */
    public function getAllCouples()
    {
        return Couple::whereHas('wife', function (Builder $query) {
            $query->whereDate('date_of_birth', '<', Carbon::now()->addYears(-15) )
                ->whereDate('date_of_birth', '>', Carbon::now()->addYears(-49) );
        })->with(['husband', 'kbService'])->get();
    }

    public function store($request)
    {
        Couple::create($request->toArray());
    }
}
