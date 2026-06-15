<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validaciones para el formulario de login.
 */
class LoginRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email'    => 'required|email|max:150',
            'password' => 'required|string|min:8',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required'    => 'El email es obligatorio para ingresar.',
            'email.email'       => 'Debes ingresar un formato de correo válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min'      => 'La contraseña debe tener al menos 8 caracteres.',
        ];
    }
}


