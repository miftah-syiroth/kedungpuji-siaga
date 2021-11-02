<?php
namespace App\Services;

class NeonatusService
{        
    /**
     * cek input waktu kunjungan, waktu harus sesuai batasan periode.
     *
     * @param  mixed $request
     * @param  mixed $posyandu
     * @return void
     */
    public function store($request, $posyandu, $periode)
    {
        $is_allowed = $this->checkVisiteTime($request->visited_at, $posyandu->person->date_of_birth, $periode);

        if ($is_allowed == true) {
            $attributes = $request->all();
            $attributes['periode'] = $periode;
            
            $posyandu->neonatuses()->create($attributes);
            return true;
        } else {
            // return 'masukkan waktu kunjungan yg sesuai dengan batasan KN';
            return false;
        }
        
    }

    public function checkVisiteTime($visited_at, $date_of_birth, $periode)
    {
        $retVal = false;

        $diffInHours = $date_of_birth->diffInHours($visited_at); // perbedaan waktu dlm jam
        $diffInDays = $date_of_birth->diffInDays($visited_at); // perbedaan waktu dlm hari

        if ($periode == 1) { //0-6jam
            $retVal = ($diffInHours >= 0 && $diffInHours <= 6) ? true : false ;
        } elseif ($periode == 2) { //6-48 jam
            $retVal = ($diffInHours > 6 && $diffInHours <= 48) ? true : false ;
        } elseif ($periode == 3) { // 3 - 7 hari
            $retVal = ($diffInDays >= 3 && $diffInDays <= 7) ? true : false ;
        } elseif ($periode == 4) { // 8 - 28 hari
            $retVal = ($diffInDays >= 8 && $diffInDays <= 28) ? true : false ;
        }

        return $retVal;
    }
    
    /**
     * cek juga apakah waktu kunjungannya udah bener inputnya
     *
     * @param  mixed $request
     * @param  mixed $neonatus
     * @return void
     */
    public function update($request, $neonatus)
    {
        
        $is_allowed = $this->checkVisiteTime($request->visited_at, $neonatus->posyandu->person->date_of_birth, $neonatus->periode);

        if ($is_allowed == true) {
            $neonatus->update([
                'visited_at' => $request->visited_at,
                'baby_weight' => $request->baby_weight,
                'baby_lenght' => $request->baby_lenght,
                'baby_head_circumference' => $request->baby_head_circumference,
                'imd' => $request->imd,
                'vitamin_k1' => $request->vitamin_k1,
                'salep_mata' => $request->salep_mata,
                'imunisasi_hb' => $request->imunisasi_hb,
                'perawatan_tali_pusat' => $request->perawatan_tali_pusat,
                'problem' => $request->problem,
                'referred_to' => $request->referred_to,
                'health_worker' => $request->health_worker,
            ]);
            return true;
        } else {
            return false;
        } 
    }

    public function getWaktuAwal($date_of_birth, $periode)
    {
        // buat batasan secara tertulis sebelum via fungsi pada store
        if ($periode == 1) {
            return $date_of_birth->addHours(0);
        } elseif ($periode == 2) {
            return $date_of_birth->addHours(6);
        } elseif ($periode == 3) {
            return $date_of_birth->addDays(3);
        } elseif ($periode == 4) {
            return $date_of_birth->addDays(8);
        }
    }

    public function getWaktuAkhir($date_of_birth, $periode)
    {
        // buat batasan secara tertulis sebelum via fungsi pada store
        if ($periode == 1) {
            return $date_of_birth->addHours(6);
        } elseif ($periode == 2) {
            return $date_of_birth->addHours(48);
        } elseif ($periode == 3) {
            return $date_of_birth->addDays(7);
        } elseif ($periode == 4) {
            return $date_of_birth->addDays(28);
        }
    }
}
