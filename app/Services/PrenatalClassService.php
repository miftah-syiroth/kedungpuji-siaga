<?php
namespace App\Services;

use App\Models\PrenatalClass;

class PrenatalClassService
{
    public function store($request, $pregnancy, $month)
    {
        // cek waktu input visited_at harus sesuai month_periodenya, artinya di antara waktu awal dan waktu akhir pada periode tersebut
        $is_allowed = $this->checkVisitDate($request->visited_at, $month, $pregnancy);

        if ($is_allowed == true) {
            $attributes = $request->all();
            $attributes['month_periode'] = $month;
            $pregnancy->prenatalClasses()->create($attributes);
            return true;
        } else {
            return false;
        }
    }

    public function update($request, $prenatalClass)
    {
        // cek batasan waktu visited_at
        $is_allowed = $this->checkVisitDate($request->visited_at, $prenatalClass->month_periode, $prenatalClass->pregnancy);

        if ($is_allowed == true) {
            $prenatalClass->update([
                'mother_weight' => $request->mother_weight,
                'arm_circumference' => $request->arm_circumference,
                'systolic' => $request->systolic,
                'diastolic' => $request->diastolic,
                'uterine_height' => $request->uterine_height,
                'baby_heart_rate' => $request->baby_heart_rate,
                'hemoglobin' => $request->hemoglobin,
                'urine_protein' => $request->urine_protein,
                'blood_sugar' => $request->blood_sugar,
                'visited_at' => $request->visited_at,
            ]);
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * checkVisitDate, jika tanggal visited_at yg diinputkan sesuai batas waktu awal dan waktu akhir 
     * month_periode tersebut, maka diperbolehkan
     *
     * @param  mixed $request
     * @param  mixed $pregnancy
     * @return void
     */
    public function checkVisitDate($visited_at, $month_periode, $pregnancy)
    {
        // jika visited at sesuai dengan batas dari moth periode terhadap hpht, maka bolehkan
        $waktu_awal = $this->getWaktuAwal($pregnancy->hpht, $month_periode);
        $waktu_akhir = $this->getWaktuAkhir($pregnancy->hpht, $month_periode);

        if ($visited_at >= $waktu_awal && $visited_at < $waktu_akhir) {
            return true;
        } else {
            return false;
        }
    }

    public function getWaktuAwal($hpht, $month)
    {
        return $hpht->addMonths($month-1);
    }

    public function getWaktuAkhir($hpht, $month)
    {
        return $hpht->addMonths($month);
    }
}