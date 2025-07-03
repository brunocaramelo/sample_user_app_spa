<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:5',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email é requerido',
            'email.email' => 'Email deve ser válido',
            'password.required' => 'Senha é requerida',
            'password.min' => 'Senha deve conter 5 caracteres',
        ];
    }

}
