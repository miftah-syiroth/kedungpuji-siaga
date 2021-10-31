<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonRequest extends FormRequest
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
            'nik' => ['required', 'numeric', 'unique:people'],
            'place_of_birth' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'religion_id' => ['required', 'integer'],
            'blood_group_id' => ['required', 'integer'],
            'sex_id' => ['required', 'integer'],
            'educational_id' => ['required', 'integer'],
            'rt' => ['required', 'integer'],
            'rw' => ['required', 'integer'],
            'marital_status_id' => ['required', 'integer'],
            'is_cacat' => ['required', 'boolean'], // perhatikan
            'disability_id' => ['exclude_unless:is_cacat,true', 'required', 'integer'],
            'mother_id' => ['sometimes', 'integer'],
            'father_id' => ['sometimes', 'integer'],
        ];
    }
}
