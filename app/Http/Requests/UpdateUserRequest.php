<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Autorise tous les utilisateurs à faire cette demande
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->getModelId();

        return [
            'lastname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'phone' => [
                'required',
                'string',
                'max:15',
                Rule::unique('users')->ignore($userId),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($userId),
            ],
            'password' => ['sometimes', 'nullable', 'string', 'min:8', 'confirmed'],
            'university_id' => ['sometimes', 'required', 'exists:universities,id'],
            'academic_level_id' => ['sometimes', 'required', 'exists:academic_levels,id'],
            'academic_program_id' => ['sometimes', 'required', 'exists:academic_programs,id'],
            'role_id' => ['sometimes', 'required', 'exists:user_roles,id'],
        ];
    }

    private function getModelId()
    {
        // Vérifie si l'URI contient 'user'
        if (Str::contains($this->getUri(), 'user')) {
            return $this->route('user');
        }
        // Vérifie si l'URI contient 'administrator'
        elseif (Str::contains($this->getUri(), 'administrator')) {
            return $this->route('administrator');
        }
        // Vérifie si l'URI contient 'moderator'
        elseif (Str::contains($this->getUri(), 'moderator')) {
            return $this->route('moderator');
        }
        // Vérifie si l'URI contient 'uploader'
        elseif (Str::contains($this->getUri(), 'uploader')) {
            return $this->route('uploader');
        }

        // Retourne null si aucun modèle n'est trouvé
        return null;
    }
}
