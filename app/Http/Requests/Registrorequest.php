<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Registrorequest extends FormRequest
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
           
            'Codigo_SIS_U'=> 'required',
            'Nombre_U'=> 'required',
            'Contrasenia_U'=> 'required',
            'Correo_U'=> 'required',
            'Apellido_Paterno_U'=> 'required',
            'Apellido_Materno_U'=> 'required',
            'Rol_U'=> 'required'
        ];
    }
}
