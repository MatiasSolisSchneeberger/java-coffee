<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'   => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email'    => 'required|email|max:150|unique:usuarios',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'   => 'El nombre es obligatorio.',
            'nombre.string'     => 'El nombre debe ser una cadena de texto.',
            'nombre.max'        => 'El nombre no puede superar los 100 caracteres.',
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.string'   => 'El apellido debe ser una cadena de texto.',
            'apellido.max'      => 'El apellido no puede superar los 100 caracteres.',
            'email.required'    => 'El email es obligatorio.',
            'email.email'       => 'Debes ingresar un formato de correo válido.',
            'email.unique'      => 'Este email ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.string'   => 'La contraseña debe ser una cadena de texto.',
            'password.min'      => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ];
    }
}
