<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorFormRequest extends FormRequest
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
            'nombre' => 'required|max:100',
            'description' => 'required'
        ];
    }
    
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del autor es obligatorio.',
            'nombre.max' => 'El nombre del autor es demasiado largo.',

            'description.required' => 'La descripción del autor es obligatoria.'
        ];
    }
}
