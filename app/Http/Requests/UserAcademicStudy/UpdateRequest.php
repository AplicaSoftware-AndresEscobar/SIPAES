<?php

namespace App\Http\Requests\UserAcademicStudy;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'educational_institute_id' => ['required', 'exists:educational_institutes,id'],
            'academic_study_level_id' => ['required', 'exists:academic_study_levels,id'],
            'degree' => ['required', 'string'],
            'year' => ['required', 'numeric', 'digits:4', 'date_format:Y', 'min:1900', 'max:' . now()->format('Y')],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->wantsJson()) {
            throw new HttpResponseException(response()->json([
                'errors' => $validator->errors(),
            ], 422));
        }

        parent::failedValidation($validator);
    }
}
