<?php
namespace App\Services;

use App\Models\Contraception;
use App\Models\Couple;
use App\Models\KeluargaBerencana;
use App\Models\Pregnancy;
use Illuminate\Database\Eloquent\Builder;

class KeluargaBerencanaService
{
    // public function getCouples(Type $var = null)
    // {
    //     # code...
    // }

    // public function getKbData($couple, $year)
    // {
    //     return $couple->keluargaBerencana()
    //         ->with(['contraception', 'desirePregnancy'])
    //         ->where('year_periode', $year)
    //         ->get();
    // }

    public function store($request)
    {
        $couple = Couple::find($request->couple_id);

        // cek ini kontrasepsi atau pregnancy berdasarkan dia kb atau engga
        $is_kb = $couple->is_kb;

        if ( $is_kb == true ) { // jika true maka save sebagai kontrasepsi

            // cek apakah ini update row atau create row. jika null, maka buat baru, jika isi maka update
            $contraception = $couple->contraceptionRow($request->year_periode, $request->month_periode);
            // dd($contraception);
            if ($contraception == null) {
                $couple->contraceptions()->attach($request->coupleable_id, [
                    'year_periode' => $request->year_periode, 
                    'month_periode' => $request->month_periode,
                ]);
            } else { // update
                $a = $contraception->coupleRow($request->year_periode, $request->month_periode);
                $a = 
            }
        } elseif ( $is_kb == true ) {
            // Pregnancy::find($request->coupleable_id)->couples()->updateOrCreate([
            //     [
            //         'couple_id' => $request->couple_id,
            //         'year_periode' => $request->year_periode, 
            //         'month_periode' => $request->month_periode,
            //     ],
            // ]);

            Couple::find($request->couple_id)->pregnancies()->updateOrCreate(
                [
                    'year_periode' => $request->year_periode, 
                    'month_periode' => $request->month_periode,
                ],
                ['coupleable_id' => $request->coupleable_id]
            );
        }
    }
}
