<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Autoriser tous les utilisateurs
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255'
        ];
    }
}
