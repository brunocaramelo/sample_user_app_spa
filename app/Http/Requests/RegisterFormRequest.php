<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password',
            'name' => 'required',
            'lastname' => 'required',
            'cep' => 'required',
            'street' => 'required',
            'city' => 'required',
            'street_number' => 'required',
            'state' => 'required',
            'neighborhood' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email é requerido',
            'email.email' => 'Email deve ser válido',
            'email.unique' => 'Email já cadastrado',
            'password.required' => 'Senha é requerida',
            'password.min' => 'Senha deve conter 5 caracteres',
            'confirm_password.required' => 'Confirme a Senha é requerida',
            'confirm_password.same:password' => 'Senha e Confirme a senha devem ser iguais',
            'name.required' => 'Nome é requerido',
            'lastname.required' => 'Sobrenome é requerido',
            'cep.required' => 'CEP é requerido',
            'street.required' => 'Logradouro é requerido',
            'city.required' => 'Cidade é requerido',
            'street_number.required' => 'Rua é requerido',
            'state.required' => 'Estado é requerido',
            'neighborhood.required' => 'Bairro é requerido',
        ];
    }

}
