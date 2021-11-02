<?php
namespace App\Services;


class PuerperalService
{    
    public function update($request, $puerperal)
    {
        $puerperal->update([
            'conclusion' => $request->conclusion,
        ]);

        $puerperal->motherConditions()->sync($request->mother_condition_id);
        $puerperal->complications()->sync($request->puerperal_complication_id);
        $puerperal->babyConditions()->sync($request->baby_condition_id);
    }

    public function getPeriode()
    {
        return (
            [
                ['nomor' => 1, 'min' => '0', 'max' => '6 jam'], // 0-6 jam
                ['nomor' => 2, 'min' => '6', 'max' => '48 jam'], //6-48 jam
                ['nomor' => 3, 'min' => '3', 'max' => '7 hari'], //3-7 hari
                ['nomor' => 4, 'min' => '8', 'max' => '48 hari'], //8-28 hari
            ]
        );
    }
}
