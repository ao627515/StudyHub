<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Resources\ErrorResponseResource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class StoreResourceRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|file|max:1048576',
            'course_module_id' => 'required|exists:course_modules,id',
            'resource_id' => 'nullable|exists:resources,id',
            'category_id' => 'required|exists:category_resources,id',
            'file' => 'required|file|max:1048576',
            'schoolYear' => ['required', 'regex:/^\d{4}-\d{4}$/']

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
