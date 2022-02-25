<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class ImagenRequest extends FormRequest
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
            'avatar'=>'required|mimes:jpg,jpeg,png|max:4096',
            'imageable_type'=>'required|in:user',
            
            'imageable_id'=>[ 'required', function ($attribute, $value, $fail) {
    
               if (!DB::table('users')->where('id','=', $value)->exists())
                    {
                    return $fail("Este $attribute no es valido.");
                    }
                }
           ],
        ];
    }
    
    public function messages()
    {
        return [
            'required' => 'El :attribute es requerido',
            'exists' => 'Este :attribute no existe',
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
            'avatar' => 'Imagen',
        ];
    }
}
