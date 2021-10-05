<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKbRequest extends FormRequest
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
            // 'couple_id' => ['required', 'integer'],
            'month_periode' => ['required', 'integer'],
            'year_periode' => ['required', 'integer'],
            'kb_status_id' => ['required', 'integer'], // berisi status keinginan kelahiran atau alat kontrasepsi
        ];
    }
}
