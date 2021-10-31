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
        $is_allowed = $this->finishPregnancyAndPuerperal($lastPregnancy);

        if ($is_allowed == true) {
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
        // kehamilan adalah trimester ke tiga yaitu 28 - 42 minggu sejak hpht
        // $is_allowed = $this->checkChildbirthDate($request->childbirth_date, $pregnancy);
        $is_allowed = true;

        if ($is_allowed == true) {
            $pregnancy->update([
                'hpht' => $request->hpht,
                'mother_weight' => $request->mother_weight,
                'mother_height' => $request->mother_height,
                'childbirth_date' => $request->childbirth_date,
                'gestational_age' => $this->calculateGestationalAge($request->childbirth_date, $pregnancy),
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

            return true;
        } else {
            return false;
        }
    }
    
    /**
     * checkChildbirthDate harus pada trimester ke tiga yaitu 28 hingga 42 minggu sejak hpht
     *
     * @return void
     */
    public function checkChildbirthDate($childbirth_date, $pregnancy)
    {
        $awal_waktu = $pregnancy->hpht->addWeeks(28); 
        $akhir_waktu = $pregnancy->hpht->addWeeks(42); 

        if ($childbirth_date >= $awal_waktu && $childbirth_date <= $akhir_waktu) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * createIbuNifas, ketika waktu persalinan diisi maka otomatis model nifas dibuat
     * namun cek juga udah dibuat atau blm sebelumnya, krn model nifas one to one dgn pregnancy
     *
     * @param  mixed $request
     * @param  mixed $pregnancy
     * @return void
     */
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
    }
}
