<?php

namespace App\Http\Requests;

use App\Models\CourseModule;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Resources\ErrorResponseResource;
use App\Models\AcademicProgramLevel;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Validation\Validator;

class StoreCourseModuleRequest extends FormRequest
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
            'academic_program_level_id' => 'required|exists:academic_program_levels,id'
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator(Validator $validator): void
    {
        // apres la validation
        $validator->after(function ($validator) {
            // verifi si le niveau academic existe
            $academicProgramLevel = AcademicProgramLevel::where('id', $this->academic_program_level_id)->first();
            if (!$academicProgramLevel) {
                $validator->errors()->add('academic_program_level_id', 'Le niveau académique n\'existe pas.');
            }

            // verifie si un module avec le meme et le meme niveau academic n'exists:,column
            $existingModule = CourseModule::where('name', $this->name)
                ->where('academic_program_level_id', $academicProgramLevel->id)
                ->exists();

            if ($existingModule) {
                $validator->errors()->add('name', 'A module with this name already exists in the selected academic program level.');
            }
        });
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
