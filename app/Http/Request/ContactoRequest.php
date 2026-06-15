<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validaciones para el formulario de consultas/contacto.
 */
class ContactoRequest extends FormRequest
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
            'nombre'   => 'required|string|max:100',
            'email'    => 'required|email|max:150',
            'motivo'   => 'required|string|max:200',
            'consulta' => 'required|string|min:10|max:1000',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'nombre.required'   => 'El nombre es obligatorio.',
            'email.required'    => 'El email es obligatorio.',
            'email.email'       => 'Formato de email inválido.',
            'consulta.min'      => 'Debe tener al menos 10 caracteres.',
            'motivo.required'   => 'Falta motivo de consulta',
            'consulta.required' => 'Falta consulta',
        ];
    }
}


