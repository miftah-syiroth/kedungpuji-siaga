<?php
namespace App\Services;

use App\Models\PrenatalClass;

class PrenatalClassService
{
    public function store($request, $pregnancy)
    {
        // dd($pregnancy->id);
        $pregnancy->prenatalClasses()->updateOrCreate(
            [
                // 'pregnancy_id' => $pregnancy->id,
                'checkup_periode' => $request->checkup_periode
            ],
            [
                'mother_weight' => $request->mother_weight,
                'arm_circumference' => $request->arm_circumference,
                'systolic' => $request->systolic,
                'diastolic' => $request->diastolic,
                'uterine_height' => $request->uterine_height,
                'baby_heart_rate' => $request->baby_heart_rate,
                'hemoglobin' => $request->hemoglobin,
                'urine_protein' => $request->urine_protein,
                'blood_sugar' => $request->blood_sugar,
            ]
        );

        // PrenatalClass::create([
        //     'pregnancy_id' => $pregnancy->id,
        //     'checkup_periode' => $request->checkup_periode,
        //     'mother_weight' => $request->mother_weight,
        //     'arm_circumference' => $request->arm_circumference,
        //     'systolic' => $request->systolic,
        //     'diastolic' => $request->diastolic,
        //     'uterine_height' => $request->uterine_height,
        //     'baby_heart_rate' => $request->baby_heart_rate,
        //     'hemoglobin' => $request->hemoglobin,
        //     'urine_protein' => $request->urine_protein,
        //     'blood_sugar' => $request->blood_sugar,
        // ]);
    }
}
