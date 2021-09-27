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
        $family_rule = $this->family_status_id == 1 ? 'required' : 'sometimes'; // jika kepala keluarga 
        $disability_rule = $this->is_cacat == true ? 'required' : 'sometimes'; //kalau cacat
        $is_kb_rule = $this->marital_status_id == 2 || $this->marital_status_id == 3 ? 'required' : 'sometimes'; //kalau pny pasangan
        $kb_service_rule = $this->is_kb == true ? 'required' : 'sometimes'; // kalau iya kb

        return [
            'name' => ['required', 'string'],
            'nik' => ['required', 'string', 'unique:people'],
            'place_of_birth' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'religion_id' => ['required', 'integer'],
            'blood_group_id' => ['required', 'integer'],
            'sex_id' => ['required', 'integer'],
            'educational_id' => ['required', 'integer'],
            'rt' => ['required', 'integer'],
            'rw' => ['required', 'integer'],
            'marital_status_id' => ['required', 'integer'],
            'couple_id' => ['integer'], // perhatikan
            'is_cacat' => ['required', 'integer'], // perhatikan
            'disability_id' => [$disability_rule, 'integer'],
            'family_status_id' => ['required', 'integer'], // perhatikan
            'nomor_kk' => [$family_rule], // nomor kk harus required ketika status adalah kepala keluarga
            'family_id' => ['sometimes', 'integer'], // coba diperhatikan
            'ibu_id' => ['sometimes', 'integer'],
            'ayah_id' => ['sometimes', 'integer'],
            'keluarga_sejahtera_id' => [$family_rule],
            'is_kb' => [$is_kb_rule],
            'kb_service_id' => [$kb_service_rule],
        ];
    }
}
