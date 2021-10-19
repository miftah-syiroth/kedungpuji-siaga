<?php
namespace App\Services;

use App\Models\PrenatalClass;

class PrenatalClassService
{
    public function store($request, $pregnancy)
    {
        $pregnancy->prenatalClasses()->create([
            'mother_weight' => $request->mother_weight,
            'arm_circumference' => $request->arm_circumference,
            'systolic' => $request->systolic,
            'diastolic' => $request->diastolic,
            'uterine_height' => $request->uterine_height,
            'baby_heart_rate' => $request->baby_heart_rate,
            'hemoglobin' => $request->hemoglobin,
            'urine_protein' => $request->urine_protein,
            'blood_sugar' => $request->blood_sugar,
            'month_periode' => $request->month_periode,
        ]);
    }

    public function update($request, $prenatalClass)
    {
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
        ]);
    }
}
