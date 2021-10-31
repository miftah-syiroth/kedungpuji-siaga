<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoupleRequest extends FormRequest
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
            'wife_id' => ['required', 'string'],
            'husband_id' => ['required', 'string'],
            'is_kb' => ['required', 'boolean'],
            'kb_service_id' => ['exclude_unless:is_kb,true', 'required', 'integer'],
        ];
    }
}
