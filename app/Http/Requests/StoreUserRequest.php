<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole(['admin', 'bidan desa']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (Auth::user()->hasRole('admin')) {
            $roleRule = 'required';
        } elseif (Auth::user()->hasRole('bidan desa')) {
            $roleRule = 'sometimes';
        }

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'nullable', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => [$roleRule, 'string'],
        ];
    }
}
