<?php

namespace App\Http\Request;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'    => 'required|email|max:150',
            'password' => 'required|string|min:8', // Agregamos la validación de la contraseña
        ];
    }

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
