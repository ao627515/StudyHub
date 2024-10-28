<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Resources\ErrorResponseResource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class UpdateAcademicLevelRequest extends FormRequest
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
        $id = $this->route('academic_levels');
        return [
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('academic_levels', 'name')->ignore($id)
            ],
            'abb' => [
                'required',
                'string',
                'max:20',
                Rule::unique('academic_levels', 'abb')->ignore($id)
            ],
            'description' => 'nullable|string|max:255'
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
            ))->response()->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);

            throw new ValidationException($validator, $response);
        }

        parent::failedValidation($validator);
    }
}