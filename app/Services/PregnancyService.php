<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class PregnancyService
{
    public function store($request, $person)
    {
        // dd($request->toArray());
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
        # rumusnya adalah = weight dlm kg dibagi kuadrat dari height dlm m.. 
        # mengihtung pembagi, karena input height dlm cm, maka dibagi 10ribu
        return ($weight / (pow($height, 2) / 10000));
    }
}
