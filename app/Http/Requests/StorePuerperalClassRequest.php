<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePuerperalClassRequest extends FormRequest
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
            'periode' => ['required', 'integer'],
            'visited_at' => ['required', 'date'],
            'problem' => ['required', 'string'],
            'faskes' => ['required', 'string'],
            'action' => ['required', 'string'],
        ];
    }
}
