<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNeonatusRequest extends FormRequest
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
            // 'periode' => ['required', 'integer'],
            'visited_at' => ['required',],
            'baby_weight' => ['required',],
            'baby_lenght' => ['required',],
            'baby_head_circumference' => ['required',],
            'imd' => ['sometimes',],
            'vitamin_k1' => ['sometimes',],
            'salep_mata' => ['sometimes',],
            'imunisasi_hb' => ['sometimes',],
            'perawatan_tali_pusat' => ['sometimes',],
            'problem' => ['sometimes',],
            'referred_to' => ['sometimes',],
            'health_worker' => ['required', 'string'],
        ];
    }
}
