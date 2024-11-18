<?php

namespace App\Http\Requests\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProfileFormRequest extends FormRequest
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
        $userId = Auth::id();

        return [
            'fullname' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($userId)
            ],
            'socials' => 'nullable|array',
            'socials.*.platform' => 'required|string|in:Twitter,GitHub,LinkedIn,Facebook,Instagram,Website,Youtube',
            'socials.*.link' => 'required|url',
            'profile_headlines' => 'required|string|max:255',
            'bio' => 'required|string|max:1000',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255'
        ];
    }
}
