<?php
namespace App\Services;

use App\Models\BmiForAgeBoy;
use App\Models\BmiForAgeGirl;
use App\Models\HeightForAgeBoy;
use App\Models\HeightForAgeGirl;
use App\Models\WeightForAgeBoy;
use App\Models\WeightForAgeGirl;
use App\Models\WeightForHeightBoy;
use App\Models\WeightForHeightGirl;

class AnthropometryService
{        
    /**
     * ambil data antropometri bulan sebelumnya utk diambil selisih BB, PB, LK
     *
     * @param  mixed $request
     * @param  mixed $posyandu
     * @param  mixed $month
     * @return void
     */
    public function store($request, $posyandu, $month)
    {
        $previousAnthropometry = $posyandu->anthropometries()->where('month_periode', $month-1)->first();

        $posyandu->anthropometries()->create([
            'weight' => $request->weight,
            'height' => $request->height,
            'head_circumference' => $request->head_circumference,
            'bmi' => $this->bmi($request->weight, $request->height),
            'weight_difference' => $this->weightDifference($request, $previousAnthropometry),
            'height_difference' => $this->heightDifference($request, $previousAnthropometry),
            'head_circumference_difference' => $this->headCircumferenceDifference($request, $previousAnthropometry),
            'bmi_for_age_category_id' => $this->bmiForAgeCategory($request, $posyandu->person->sex_id, $month),
            'height_for_age_category_id' => $this->heightForAgeCategory($request, $posyandu->person->sex_id, $month),
            'weight_for_age_category_id' => $this->weightForAgeCategory($request, $posyandu->person->sex_id, $month),
            'weight_for_height_category_id' => $this->weightForHeightCategory($request, $posyandu),
            'visited_at' => $request->visited_at,
            'month_periode' => $month,
            'year_periode' => intval($month/12),
        ]);
    }

    public function update($request, $anthropometry)
    {
        $previousAnthropometry = $anthropometry->where('month_periode', $anthropometry->month_periode - 1)->first();

        $anthropometry->update([
            'weight' => $request->weight,
            'height' => $request->height,
            'head_circumference' => $request->head_circumference,
            'bmi' => $this->bmi($request->weight, $request->height),
            'weight_difference' => $this->weightDifference($request, $previousAnthropometry),
            'height_difference' => $this->heightDifference($request, $previousAnthropometry),
            'head_circumference_difference' => $this->headCircumferenceDifference($request, $previousAnthropometry),
            'bmi_for_age_category_id' => $this->bmiForAgeCategory($request, $anthropometry->posyandu->person->sex_id, $anthropometry->month_periode),
            'height_for_age_category_id' => $this->heightForAgeCategory($request, $anthropometry->posyandu->person->sex_id, $anthropometry->month_periode),
            'weight_for_age_category_id' => $this->weightForAgeCategory($request, $anthropometry->posyandu->person->sex_id, $anthropometry->month_periode),
            'weight_for_height_category_id' => $this->weightForHeightCategory($request, $anthropometry->posyandu),
            'visited_at' => $request->visited_at,
        ]);
    }
        
    public function bmiForAgeCategory($request, $sex, $month)
    {
        $bmi = $this->bmi($request->weight, $request->height);

        // jenis kelamin menentukan baris tabel yg akan diambil
        if ($sex == 1) { // laki2
            $standard = BmiForAgeBoy::where('months', $month)->first();
        } else { // perempuan
            $standard = BmiForAgeGirl::where('months', $month)->first();
        }
        
        // pengecekan kategori
        if ($bmi < $standard->negative_3sd) {
            return 1; // category_id 1 adalah gizi buruk
        } elseif($bmi >= $standard->negative_3sd && $bmi < $standard->negative_2sd) {
            return 2; // category_id 1 adalah gizi kurang
        } elseif($bmi >= $standard->negative_2sd && $bmi < $standard->positive_1sd) {
            return 3; // category_id 1 adalah gizi baik (normal)
        } elseif($bmi >= $standard->positive_1sd && $bmi < $standard->positive_2sd) {
            return 4; // category_id 1 adalah berisiko gizi lebih
        } elseif($bmi >= $standard->positive_2sd && $bmi < $standard->positive_3sd) {
            return 5; // category_id 1 adalah gizi lebih
        } elseif($bmi >= $standard->positive_3sd) {
            return 6; // category_id 1 adalah obesitas
        }
    }

    public function heightForAgeCategory($request, $sex, $month)
    {
        // jenis kelamin menentukan baris tabel yg akan diambil
        if ($sex == 1) { // laki2
            $standard = HeightForAgeBoy::where('months', $month)->first();
        } else { // perempuan
            $standard = HeightForAgeGirl::where('months', $month)->first();
        }

        // pengecekan kategori
        if ($request->height < $standard->negative_3sd) {
            return 1; // category_id 1 adalah sangat pendek
        } elseif($request->height >= $standard->negative_3sd && $request->height < $standard->negative_2sd) {
            return 2; // category_id 1 adalah pendek
        } elseif($request->height >= $standard->negative_2sd && $request->height < $standard->positive_3sd) {
            return 3; // category_id 1 adalah normal
        } elseif($request->height >= $standard->positive_3sd) {
            return 4; // category_id 1 adalah berisiko tinggi
        }
    }

    public function weightForAgeCategory($request, $sex, $month)
    {
        // jenis kelamin menentukan baris tabel yg akan diambil
        if ($sex == 1) { // laki2
            $standard = WeightForAgeBoy::where('months', $month)->first();
        } else { // perempuan
            $standard = WeightForAgeGirl::where('months', $month)->first();
        }

        // pengecekan kategori
        if ($request->weight < $standard->negative_3sd) {
            return 1; // category_id 1 adalah BB sangat kurang
        } elseif($request->weight >= $standard->negative_3sd && $request->weight < $standard->negative_2sd) {
            return 2; // category_id 1 adalah BB kurang
        } elseif($request->weight >= $standard->negative_2sd && $request->weight < $standard->positive_1sd) {
            return 3; // category_id 1 adalah BB normal
        } elseif($request->weight >= $standard->positive_1sd) {
            return 4; // category_id 1 adalah berisiko BB lebih
        }
    }


    /** keterangan tentang tabel weight for height di model */
    public function weightForHeightCategory($request, $posyandu)
    {
        $periode = $posyandu->person->date_of_birth->age < 2 ? 1 : 2; // cek lebih dari 2 th atau belum
        $height = floor($request->height * 2) / 2; // pembulatan ke half integer terdekat

        // jenis kelamin menentukan baris tabel yg akan diambil
        if ($posyandu->person->sex_id == 1) { // laki2
            $standard = WeightForHeightBoy::where('periode', $periode)->where('height', $height)->first();
        } else { // perempuan
            $standard = WeightForHeightGirl::where('periode', $periode)->where('height', $height)->first();
        }
        
        dd($request->all());

        // pengecekan kategori
        if ($request->weight < $standard->negative_3sd) {
            return 1; // category_id 1 adalah gizi buruk
        } elseif($request->weight >= $standard->negative_3sd && $request->weight < $standard->negative_2sd) {
            return 2; // Gizi kurang (wasted)
        } elseif($request->weight >= $standard->negative_2sd && $request->weight < $standard->positive_1sd) {
            return 3; // category_id 1 adalah BB normal
        } elseif($request->weight >= $standard->positive_1sd && $request->weight < $standard->positive_2sd) {
            return 4; // category_id 1 adalah berisiko BB lebih
        } elseif($request->weight >= $standard->positive_2sd && $request->weight < $standard->positive_3sd) {
            return 5; // category_id 1 adalah berisiko BB lebih
        } elseif($request->weight >= $standard->positive_3sd) {
            return 6; // category_id 1 adalah berisiko BB lebih
        }
    }

     /**
     * weightDifference, hitung selisih kenaikan bb dari kunjungan sebelumnya
     * ambil nilai kolom berat dari month_periode yg month-1,
     * jika null data bulan sebelumnya, maka selisih = 0, jika ada isinya maka kurangi saja.
     * @param  mixed $var
     * @return void
     */
    
     public function weightDifference($request, $previousAnthropometry)
    {
        if (empty($previousAnthropometry)) {
            return 0;
        } else {
            return ($request->weight - $previousAnthropometry->weight) * 1000; // kembalikan dlm gram
        }
    }
    
    /**
     * heightDifference
     *
     * @param  mixed $request
     * @param  mixed $previousAnthropometry
     * @return void
     */
    public function heightDifference($request, $previousAnthropometry)
    {
        if (empty($previousAnthropometry)) {
            return 0;
        } else {
            return ($request->height - $previousAnthropometry->height) * 10;
        }
    }

    public function headCircumferenceDifference($request, $previousAnthropometry)
    {
        if (empty($previousAnthropometry)) {
            return 0;
        } else {
            return ($request->head_circumference - $previousAnthropometry->head_circumference) * 10;
        }
    }

    /**
     * bmi fungsi hitung BMI balita
     * input tinggi adalah cm dan integer, input berat adalah kg dan decimal
     * rumusnya bmi adalah berat dlm kg dibagi hasil kuadrat tinggi dalam meter
     * supaya ga rusak, buat berat dlm gram integer, tinggi tetep dlm cm dan dikali 10000
     * @return void
     */
    public function bmi($weight, $height)
    {
        $pembilang = $weight;
        $penyebut = pow($height, 2) / 10000; 
        return round(($pembilang/$penyebut), 2);
    }
    
   
}
