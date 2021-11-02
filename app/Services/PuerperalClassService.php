<?php
namespace App\Services;


class PuerperalClassService
{    
    /*
     * ambil nilai difference antara bersalin dan waktu kunjungan yg diinput
     * cek kesesuaian waktu kunjungan, input date harus sesuai dengan batasan waktu kunjungan, 
     * semisal periode KF1 0-2 hari setelah bersalin, jika lahir pd tgl 1, input date tidak boleh lebih dari H+2 atau tgl 3
     * @param  mixed $request
     * @param  mixed $puerperal
     * @return void
     */
    public function store($request, $puerperal, $periode)
    {
        $attributes = $request->all();

        // if ($request->missing('visited_at')) {
        //     $attributes['visited_at'] = now();
        // }

        $time_difference = $puerperal->pregnancy->childbirth_date->diffInDays($attributes['visited_at']);
        $is_allowed = $this->checkVisitDate($periode, $time_difference);

        if ($is_allowed == true) {
            $attributes['periode'] = $periode;
            $puerperal->puerperalClasses()->create($attributes);
            return true;
        } else {
            return false;
        }
    }

    public function update($request, $puerperal_class)
    {
        $attributes = $request->all();

        $time_difference = $puerperal_class->puerperal->pregnancy->childbirth_date->diffInDays($attributes['visited_at']);

        $is_allowed = $this->checkVisitDate($puerperal_class->periode, $time_difference);

        if ($is_allowed == true) {
            // dd($attributes);
            $puerperal_class->update($attributes);
            // $puerperal->puerperalClasses()->create($attributes);
            return true;
        } else {
            return false;
        }
        
    }

    public function checkVisitDate($periode, $time_difference)
    {
        $is_allowed = false;

        if ($periode == 1) { // KF1 0-2 hari
            if ($time_difference >= 0 && $time_difference <= 2) {
                $is_allowed = true;
            }
        } elseif ($periode == 2) { // KF2 3-7 hari
            if ($time_difference >= 3 && $time_difference <= 7) {
                $is_allowed = true;
            }
        } elseif ($periode == 3) { // 8-28 hari
            if ($time_difference >= 8 && $time_difference <= 28) {
                $is_allowed = true;
            }
        } elseif ($periode == 4) { // 29-42 hari
            if ($time_difference >= 29 && $time_difference <= 42) {
                $is_allowed = true;
            }
        }

        return $is_allowed;
    }

    public function getWaktuAwal($childbirth_date, $periode)
    {
        // buat batasan secara tertulis sebelum via fungsi pada store
        if ($periode == 1) {
            return $childbirth_date->addHours(6);
        } elseif ($periode == 2) {
            return $childbirth_date->addDays(3);
        } elseif ($periode == 3) {
            return $childbirth_date->addDays(8);
        } elseif ($periode == 4) {
            return $childbirth_date->addDays(29);
        }
    }

    public function getWaktuAkhir($childbirth_date, $periode)
    {
        // buat batasan secara tertulis sebelum via fungsi pada store
        if ($periode == 1) {
            return $childbirth_date->addHours(48);
        } elseif ($periode == 2) {
            return $childbirth_date->addDays(7);
        } elseif ($periode == 3) {
            return $childbirth_date->addDays(28);
        } elseif ($periode == 4) {
            return $childbirth_date->addDays(42);
        }
    }
}
