<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
        $userId=Auth()->user()->id;
        return [
            'name'=>'required|string',
            'email'=>'required',
            'email_verified_at'=>'nullable',
            'password'=>'nullable|min:8|string',
            'password2'=>'required|password',
            'rol'=>'required|in:admin,user',
             Rule::unique('users', 'email')->ignore($userId),
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'El :attribute es requerido',
            'string' => 'El :attribute debe contener solamente letras',
            'unique' => 'El :attribute ya está utilizado',
            'password' => 'La :attribute es requerida',
            'in'=>'El :attribute es incorrecto'
        ];
    }
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Nombre',
            'password' => 'Contraseña',
            'password2' => 'Contraseña',
        ];
    }
}
