<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'lastname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'unique:users', 'max:15'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['sometimes', 'required', 'string', 'min:8', 'confirmed'],
            'university_id' => ['sometimes', 'required', 'exists:universities,id'],
            'academic_level_id' => ['sometimes', 'required', 'exists:academic_levels,id'],
            'academic_program_id' => ['sometimes', 'required', 'exists:academic_programs,id'],
            'role_id' => ['sometimes', 'required', 'exists:user_roles,id']
        ];
    }
}
