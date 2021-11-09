<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePuerperalRequest extends FormRequest
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
            'mother_condition_id' => ['required'],
            'puerperal_complication_id' => ['sometimes', 'array'],
            'baby_condition_id' => ['required', 'array'],
            'conclusion' => ['required', 'string'],
        ];
    }
}
