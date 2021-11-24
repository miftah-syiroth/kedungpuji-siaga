<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChildbirthRequest extends FormRequest
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
            'childbirth_order' => ['required', 'integer'],
            'weight' => ['required'],
            'length' => ['required'],
            'head_circumference' => ['required'],
            'sex_id' => ['required', 'integer'],
            'childbirth_method' => ['required'],
            'baby_condition_id' => ['sometimes', 'array'],
            'additional_information' => ['sometimes'],
        ];
    }
}
