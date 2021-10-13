<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePersonFamilyRequest extends FormRequest
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
            $new_family_rule = 'required';
            $family_id_rule = 'sometimes';
        }else {
            $new_family_rule = 'sometimes';
            $family_id_rule = 'required';
        }

        return [
            'family_status_id' => ['required', 'integer'],
            'family_id' => [$family_id_rule, 'integer'],
            'nomor_kk' => [$new_family_rule],
            'keluarga_sejahtera_id' => [$new_family_rule],
        ];
    }
}
