<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoupleRequest extends FormRequest
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
            // 'suami_id' => ['sometimes'],
            // 'istri_id' => ['sometimes'],
            'is_kb' => ['required', 'boolean'],
            'kb_service_id' => ['exclude_unless:is_kb,true', 'required', 'integer'],
        ];
    }
}
