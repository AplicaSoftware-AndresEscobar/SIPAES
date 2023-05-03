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
            'username' => ['required', 'unique:users,username,' . current_user()->id],
            'email' => ['required', 'unique:users,email,' . current_user()->id],
            'fullname' => ['required', 'string'],
            'email_personal' => ['nullable', 'email', 'unique:user_information,email_personal,' . current_user()->id . ',user_id'],
            'document_type_id' => ['required', 'exists:document_types,id'],
            'document' => ['required', 'string', 'numeric', 'unique:user_information,document,' . current_user()->id . ',user_id'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'numeric', 'unique:user_information,phone,' . current_user()->id . ',user_id'],
            'telephone' => ['nullable', 'string', 'numeric'],
            'birthdate' => ['required', 'date'],
            'birthday_place_id' => ['required', 'exists:cities,id'],

        ];
    }
}
