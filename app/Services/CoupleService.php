<?php
namespace App\Services;

use App\Models\Couple;
use App\Models\KbService;
use App\Models\KbStatus;
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
        // $year = Carbon::now()->year;
        return Couple::whereHas('wife', function (Builder $query) {
            $query->whereDate('date_of_birth', '<', Carbon::now()->addYears(-15) )
                ->whereDate('date_of_birth', '>', Carbon::now()->addYears(-49) );
        })->with(['kbService', 'keluargaBerencana.kbStatus', 'keluargaBerencana' => function($query) {
            $query->where('year_periode', Carbon::now()->year)
                ->whereIn('month_periode', [Carbon::now()->month - 1, Carbon::now()->month]);
        }])->get();
    }

    public function store($request)
    {
        Couple::create($request->toArray());
    }
    
    /**
     * getKbStatuses status kb ini akan ditampilkan pada input laporan kb per pasangan berdasarkan dia peserta atau bukan. jika peserta maka tampilkan alat kontrasepsi yang digunakan, jika bukan maka tampilakan status kehamilan
     *
     * @param  mixed $couple
     * @return void
     */
    public function getKbStatuses($couple)
    {
        if ($couple->is_kb == true) {
            return KbStatus::whereIn('id', [1,2,3,4,5,6,7])->get();
        } elseif ($couple->is_kb == false) {
            return KbStatus::whereIn('id', [8,9,10,11])->get();
        }
    }

    public function getKbAnualReport($couple, $year)
    {
        return $couple->keluargaBerencana()->with('kbStatus')->where('year_periode', $year)->get();
    }
}
