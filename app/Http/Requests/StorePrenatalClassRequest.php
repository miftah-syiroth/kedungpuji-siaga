<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrenatalClassRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mother_weight' => ['required'],
            'arm_circumference' => ['required'],
            'systolic' => ['required', 'integer'],
            'diastolic' => ['required', 'integer'],
            'uterine_height' => ['required'],
            'baby_heart_rate' => ['required'],
            'hemoglobin' => ['required'],
            'urine_protein' => ['required'],
            'blood_sugar' => ['required'],
            'month_periode' => ['required'],
        ];
    }
}
