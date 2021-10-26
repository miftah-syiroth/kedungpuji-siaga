<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChildbirthRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'nik' => ['required', 'string', 'unique:people'],
            'place_of_birth' => ['required', 'string'],
            'religion_id' => ['required', 'integer'],
            'blood_group_id' => ['required', 'integer'],
            'rt' => ['required', 'integer'],
            'rw' => ['required', 'integer'],
            'is_cacat' => ['required', 'boolean'], // perhatikan
            'disability_id' => ['exclude_unless:is_cacat,true', 'required', 'integer'],
            'ayah_id' => ['sometimes', 'integer'],
        ];
    }
}
