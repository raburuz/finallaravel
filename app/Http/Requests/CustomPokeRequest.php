<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomPokeRequest extends FormRequest
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
              'nickname'=>['required','regex:/^[a-zA-Z\s]+$/u'],
              'pokemon_id'=>'required|exists:pokemon,id',
              'pokedex_id'=>'required|exists:pokedex,id',
              'ability_id'=>'required|exists:ability,id',
              'height'=>'required|numeric|min:1|max:50',
              'weight'=>'required|numeric|min:1|max:3000',
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
            'regex' => 'El :attribute no puede contener numeros ni simbolos',
            'numeric' => 'El :atribute debe de ser un numero',
            'max'=>'El :attribute esta por arriba del limite',
            'min'=>'El :attribute esta por debajo del limite',
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
            'nickname' => 'Nombre',
            'pokemon_id' => 'Pokemon',
            'ability_id' => 'Habilidad',
            'pokedex_id'=> 'Pokedex',
            'height' => 'Altura',
            'weight'=> 'Peso',
        ];
    }
}
