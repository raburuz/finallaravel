<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SkillStoreRequest extends FormRequest
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
       // dd($request);
   
        return [
            'name.*'=>['required', 'distinct','regex:/^[a-zA-Z\s]+$/u'],
             Rule::unique($request->skill, 'name'),
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
            'distinct'=> 'No puedes hacer esa salvajada !'
           
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
