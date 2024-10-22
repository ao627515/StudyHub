<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUniversityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('universities', 'name')->ignore($this->university),
            ],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'abb' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('universities', 'abb')->ignore($this->university),
            ],
        ];
    }

    /**
     * Custom messages for validation errors (optional).
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Le nom de l\'université est obligatoire.',
            'name.unique' => 'Une université avec ce nom existe déjà.',
            'logo.image' => 'Le logo doit être une image.',
            'logo.mimes' => 'Le logo doit être un fichier de type jpg, jpeg ou png.',
            'logo.max' => 'La taille du logo ne doit pas dépasser 2 Mo.',
            'abb.unique' => 'Une université avec cette abréviation existe déjà.',
        ];
    }
}