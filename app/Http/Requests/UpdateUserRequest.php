<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class UpdateUserRequest extends FormRequest
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
        // if (Auth::user()->hasRole('admin')) {
        //     $roleRule = 'required';
        // } elseif (Auth::user()->hasRole('bidan desa')) {
        //     $roleRule = 'sometimes';
        // }

        $roleRule = Auth::user()->hasRole('admin') ? 'required' : 'sometimes';

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'nullable', 'email', 'max:255'],
            'phone' => ['required', 'string'],
            'password' => ['sometimes', Rules\Password::defaults()],
            'role' => [$roleRule, 'string'],
        ];
    }
    
    /**
     * if password left blank in form, password can't be sent as null karena terdapat rule\password yang melakukan validasi 8 karakter dsb
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->password == null) {
            $this->request->remove('password');
        }
    }
}
