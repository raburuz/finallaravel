<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PokemonStoreRequest extends FormRequest
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
        return [
             'name'=>['required','regex:/^[a-zA-Z\s]+$/u','unique:pokemon,name'],
             'type_id'=>'required|exists:type,id',
             'specie_id'=>'required|exists:specie,id',
             'avatar'=>'required|mimes:jpg,jpeg,png|max:4096',
             'imageable_type'=>'required|in:pokemon',
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
            'exists' => 'Este :attribute no existe',
            'unique' => 'El :attribute ya está utilizado',
            'mimes' => 'El :atribute debe de ser una imagen',
            'max'=>'El :attribute debe de pesar un máximo de 4MB',
            'in'=>'El :attribute debe de der tipo usuario',
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
            'avatar' => 'Imagen',
            'type_id' => 'Tipo',
            'specie_id'=> 'Categoria',
        ];
    }
}
