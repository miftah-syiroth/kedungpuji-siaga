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
    public function store($request, $posyandu)
    {
        $is_allowed = $this->checkVisiteTime($request, $posyandu->person->date_of_birth);

        if ($is_allowed == true) {
            $posyandu->neonatuses()->create($request->all());
            return 'berhasil disimpan';
        } else {
            return 'masukkan waktu kunjungan yg sesuai dengan batasan KN';
        }
        
    }

    public function checkVisiteTime($request, $date_of_birth)
    {
        $diffInHours = $date_of_birth->diffInHours($request->visited_at);
        $diffInDays = $date_of_birth->diffInDays($request->visited_at);

        if ($request->periode == 1) { //0-6jam
            $retVal = ($diffInHours >= 0 && $diffInHours <= 6) ? true : false ;
        } elseif ($request->periode == 2) { //6-48 jam
            $retVal = ($diffInHours > 6 && $diffInHours <= 48) ? true : false ;
        } elseif ($request->periode == 3) { // 3 - 7 hari
            $retVal = ($diffInDays >= 3 && $diffInDays <= 7) ? true : false ;
        } elseif ($request->periode == 4) { // 8 - 28 hari
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
        
        $is_allowed = $this->checkVisiteTime($request, $neonatus->posyandu->person->date_of_birth);

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
            return 'berhasil diubah';
        } else {
            return 'masukkan waktu kunjungan yg sesuai dengan batasan KN';
        } 
    }
}
