<?php
namespace App\Services;

use App\Models\Person;
use App\Models\Pregnancy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class PregnancyService
{
    public function getAllPregnancies()
    {
        return Pregnancy::with([
            'mother',
        ])->get();
    }

    public function store($request)
    {
        // simpan kehamilan beru diperbolehkan bagi wanita yg
        // 1. belum pernah hamil
        // 2. kehamilan terakhir sudah bersalin dan udh lewat 42 hari nifas
        // tidak diperbolehkan jika kehamilan terakhir belum lahir atau sudah lahir tp belum 42 hari

        $lastPregnancy = Person::find($request->mother_id)->latestPregnancy;
        $is_finished = $this->finishPregnancyAndPuerperal($lastPregnancy);

        if ($is_finished == true) {
            return Pregnancy::create([
                'mother_id' => $request->mother_id,
                'hpht' => $request->hpht,
                'mother_weight' => $request->mother_weight,
                'mother_height' => $request->mother_height,
                'mother_bmi' => $this->bmi($request->mother_weight, $request->mother_height),
            ]);
        }
    }

    public function finishPregnancyAndPuerperal($lastPregnancy)
    {
        if (empty($lastPregnancy)) { // pertama kali hamil maka diperbolehkan
            return true;
        } else { // jika terdapat data kehamilan
            // kalau tgl persalinan masih kosong, artinya blm melahirkan, jgn perbolehkan
            if (empty($lastPregnancy->childbirth_date)) {
                return false;
            } else { // jika terdapat tgl persalinan
                // jika sudah melebihi 42 hari maka perbolehkan
                if ($lastPregnancy->childbirth_date->diffInDays(now()) > 42) {
                    return true;
                } elseif ($lastPregnancy->childbirth_date->diffInDays(now()) <= 42) {
                    return false;
                }
            } 
        }
    }

    public function update($request, $pregnancy)
    {
        // hitung umur kehamilan berdasarkan hpht dan tanggal kelahiran, dlm minggu dan hari
        $gestational_age =  $this->calculateGestationalAge($request->childbirth_date, $pregnancy);
        
        $pregnancy->update([
            'hpht' => $request->hpht,
            'mother_weight' => $request->mother_weight,
            'mother_height' => $request->mother_height,
            'childbirth_date' => $request->childbirth_date,
            'gestational_age' => $gestational_age,
            'childbirth_attendant' => $request->childbirth_attendant,
            'childbirth_method' => $request->childbirth_method,
            'post_partum_condition' => $request->post_partum_condition,
            'mother_additional_information' => $request->mother_additional_information,
            'childbirth_order' => $request->childbirth_order,
            'baby_weight' => $request->baby_weight,
            'baby_lenght' => $request->baby_lenght,
            'baby_head_circumference' => $request->baby_head_circumference,
            'sex_id' => $request->sex_id,
            'baby_additional_information' => $request->baby_additional_information,
        ]);

        if ($request->has('baby_condition_id')) {
            $pregnancy->babyConditions()->sync($request->baby_condition_id);
        }

        // pembuatan model ibu nifas jika ada input waktu persalinan
        $this->createIbuNifas($request, $pregnancy);
        
    }

    public function createIbuNifas($request, $pregnancy)
    {
        if ($request->has('childbirth_date')) {
            if ($pregnancy->puerperal == null) {
                $pregnancy->puerperal()->create();
            }
        }
    }

    public function calculateGestationalAge($childbirth_date, $pregnancy)
    {
        $minggu = $pregnancy->hpht->diffInWeeks($childbirth_date);
        $hari = $pregnancy->hpht->diffInDays($childbirth_date) - ($minggu * 7);
        return ( $minggu . ' minggu ' . $hari . ' hari');
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

    // public function getKbAfterChildbirth($pregnancy)
    // {
        // ambil tahun dan bulan dari childbirth_date
        // lewat pregnancy ambil ortu/person, lalu ambil KeluargaBerencana dengan tahun dan bulan kelahiran, first
        // $childbirth_year = $pregnancy->childbirth_date->year;
        // $childbirth_month = $pregnancy->childbirth_date->month;

        // dd($pregnancy->mother->keluargaBerencana->where('year_periode', $childbirth_year)
        // ->where('month_periode', $childbirth_month)
        // ->first()->kbStatus);
        // return $pregnancy->mother->keluargaBerencana
        //     ->where('year_periode', $childbirth_year)
        //     ->where('month_periode', $childbirth_month)
        //     ->first()->kbStatus;
    // }
}
