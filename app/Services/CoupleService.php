<?php
namespace App\Services;

use App\Models\Contraception;
use App\Models\Couple;
use App\Models\KbService;
use App\Models\Pregnancy;
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
        })->with(['kbService', 'contraceptions', 'pregnancies'])->get();
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
            return Contraception::all();
        } elseif ($couple->is_kb == false) {
            return Pregnancy::all();
        }
    }
}
