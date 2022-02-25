<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SkillRequest extends FormRequest
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
    public function rules(Request $request)
    {
   
        return [
            'name'=>['required','regex:/^[A-Za-zñÑ\s]+$/g'],
             Rule::unique($request->skill, 'name')->ignore($request->skin_id),
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
            'regex' => 'Este :attribute solamente puede conteneder caracteres alfabeticos',
            'unique' => 'El :attribute ya está utilizado',
           
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
           ];
    }
}
