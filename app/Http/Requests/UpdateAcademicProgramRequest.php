<?php

namespace App\Http\Requests;

use App\Http\Resources\ErrorResponseResource;
use App\Http\Resources\ResponseResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class UpdateAcademicProgramRequest extends FormRequest
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
        $academicProgramId = $this->route('academic_program');
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('academic_programs', 'name')->ignore($academicProgramId)],
            'abb' => ['nullable', 'string', 'max:255', Rule::unique('academic_programs', 'abb')->ignore($academicProgramId)],
            'university_id' => 'nullable|integer|exists:universities,id',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        if ($this->is('*api*')) {
            $response = (new ErrorResponseResource(
                message: 'Failed to store academic program',
                errors: ['validation' => $validator->errors()]
            ))->response()->setStatusCode(Response::HTTP_UNAUTHORIZED);

            throw new ValidationException($validator, $response);
        }

        parent::failedValidation($validator);
    }
}
