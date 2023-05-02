<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'fullname' => ['required', 'string'],
            'email_personal' => ['nullable', 'email', 'unique:user_information'],
            'document_type_id' => ['required', 'exists:document_types'],
            'document' => ['required', 'string', 'max:15', 'numeric'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'numeric', 'unique:user_information'],
            'telephone' => ['nullable', 'string', 'numeric'],
            'birthdate' => ['required', 'date'],
            'birthday_place_id' => ['required', 'exists:cities,id'],

        ];
    }
}
