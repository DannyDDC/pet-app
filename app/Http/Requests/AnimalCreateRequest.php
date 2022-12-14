<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalCreateRequest extends FormRequest
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
            'tipo_animal_id' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'anios' => 'required',
            'meses' => 'required',
            'altura' => 'required',
            'peso' => 'required',
            'color' => 'required',
            'vacunado' => 'required',
            'user_id' => 'required'
        ];
    }
}
