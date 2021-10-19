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
            'mother_weight' => ['required'],
            'mother_height' => ['required'],
            'childbirth_date' => ['sometimes'],
            'childbirth_attendant' => [$childbirth_rule,],
            'childbirth_method' => [$childbirth_rule,],
            'post_partum_condition' => [$childbirth_rule,],
            'mother_additional_information' => ['sometimes'],
            'childbirth_order' => [$childbirth_rule,],
            'baby_weight' => [$childbirth_rule],
            'baby_lenght' => [$childbirth_rule],
            'baby_head_circumference' => [$childbirth_rule],
            'sex_id' => [$childbirth_rule,],
            'baby_condition_id' => ['sometimes', 'array'],
            'baby_additional_information' => ['sometimes'],
        ];
    }
}
