<?php

namespace App\Http\Requests\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

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
                'unique:users,username' . $userId
            ],
            'twitter' => 'required|string|max:255',
            'gitHub' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'profile_headlines' => 'required|string|max:255',
            'bio' => 'required|string|max:1000',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255'
        ];
    }
}
