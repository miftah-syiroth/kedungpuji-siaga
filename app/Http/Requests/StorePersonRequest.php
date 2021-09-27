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
        // jika kepala keluarga maka wajib isi nomor KK dan status keluarga sejahtera utk pembuatan model keluarga
        if ($this->family_status_id == 1) {
            $family_model_rule = 'required';
            $family_id_rule = 'sometimes';
        }else {
            $family_model_rule = 'sometimes';
            $family_id_rule = 'required';
        }

        // kalau sex == perempuan dan sudah menikah atau status pilihan anggota keluarga sebagai istri, maka wajib input suami
        if ($this->sex_id == 2 && ($this->marimarital_status_id == 2 || $this->marimarital_status_id == 3 || $this->family_status_id == 3) ) {
            $suami_rule = 'required';
        } else {
            $suami_rule = 'sometimes';
        }

        $is_kb_rule = $this->suami_id ? 'required' : 'sometimes'; //kalau ada input suami

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
            'suami_id' => [$suami_rule], // perhatikan
            'is_cacat' => ['required', 'boolean'], // perhatikan
            'disability_id' => ['exclude_unless:is_cacat,true', 'required', 'integer'],
            'family_status_id' => ['required', 'integer'], // perhatikan
            'nomor_kk' => [$family_model_rule],
            'family_id' => [$family_id_rule], // coba diperhatikan
            'ibu_id' => ['sometimes', 'integer'],
            'ayah_id' => ['sometimes', 'integer'],
            'keluarga_sejahtera_id' => [$family_model_rule],
            'is_kb' => [$is_kb_rule, 'boolean'],
            'kb_service_id' => ['exclude_unless:is_kb,true', 'required', 'integer'],
        ];
    }
}
