<?php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class PregnancyService
{
    public function store($request, $person)
    {
        $person->pregnancies()->create([
            'hpht' => $request->hpht,
            'mother_weight' => $request->mother_weight,
            'mother_height' => $request->mother_height,
            'mother_bmi' => $this->bmi($request->mother_weight, $request->mother_height),
        ]);
    }
    
    /**
     * bmi fungsi hitung BMI ibu hamil
     *
     * @return void
     */
    public function bmi($weight, $height)
    {
        # input tinggi adalah cm dan integer, input berat adalah kg dan decimal
        # rumusnya bmi adalah berat dlm kg dibagi hasil kuadrat tinggi dalam meter
        # supaya ga rusak, buat berat dlm gram integer, tinggi tetep dlm cm dan dikali 10000
        $pembilang = $weight;
        $penyebut = pow($height, 2) / 10000;
        return round(($pembilang/$penyebut), 2);
        // return  $pembilang/$penyebut;
    }

    public function getKbAfterChildbirth($pregnancy)
    {
        // ambil tahun dan bulan dari childbirth_date
        // lewat pregnancy ambil ortu/person, lalu ambil KeluargaBerencana dengan tahun dan bulan kelahiran, first
        $childbirth_year = $pregnancy->childbirth_date->year;
        $childbirth_month = $pregnancy->childbirth_date->month;

        // dd($pregnancy->mother->keluargaBerencana->where('year_periode', $childbirth_year)
        // ->where('month_periode', $childbirth_month)
        // ->first()->kbStatus);
        return $pregnancy->mother->keluargaBerencana
            ->where('year_periode', $childbirth_year)
            ->where('month_periode', $childbirth_month)
            ->first()->kbStatus;
    }
}
