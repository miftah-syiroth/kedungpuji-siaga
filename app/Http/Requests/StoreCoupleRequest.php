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
        // jika dia kb, maka input kb_service menjadi required
        if ($this->is_kb == 1) {
            $validasi = 'required';
        } elseif ($this->is_kb == 0) { // menjadi sometimes
            $validasi = 'sometimes';
        }

        return [
            'istri_id' => ['required', 'string', 'unique:couples'],
            'suami_id' => ['required', 'string'],
            'kb_service_id' => [$validasi],
            'is_kb' => ['required'],
        ];
    }
}
