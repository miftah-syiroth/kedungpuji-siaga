<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePregnancyRequest extends FormRequest
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
        // jika ada input pada tanggal kelahiran maka buat jd required
        if ($this->childbirth_date) {
            $childbirth_rule = 'required';
        } else { 
            $childbirth_rule = 'sometimes';
        }

        return [
            'hpht' => ['required'],
            'weight' => ['required'],
            'height' => ['required'],
            'childbirth_date' => ['sometimes'],
            'childbirth_attendant' => ['sometimes'],
            'mother_condition_id' => [$childbirth_rule],
            'additional_information' => ['sometimes'],
        ];
    }
}
