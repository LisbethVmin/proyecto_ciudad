<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'correo_electronico' => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique('usuario', 'correo_electronico')->ignore($this->user()->id_usuario, 'id_usuario'),
            ],
        ];
    }
}
