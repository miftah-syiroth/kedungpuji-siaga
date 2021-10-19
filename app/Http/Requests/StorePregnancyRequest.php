<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePregnancyRequest extends FormRequest
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
            'mother_id' => ['required', 'integer'],
            'hpht' => ['required'],
            'mother_weight' => ['required'],
            'mother_height' => ['required'],
        ];
    }
}
