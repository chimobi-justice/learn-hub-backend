<?php

namespace App\Http\Requests\User;

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
        return [
            'fullname' => 'required',
            'username' => 'required|string|unique:users,username',
            'twitter' => 'required',
            'avatar' => 'required|image|mimes:jpg,png,jpeg,JPG,PNG|max:2048',
            'gitHub' => 'required',
            'website' => 'required',
            'profile_headlines' => 'required',
            'bio' => 'required',
            'state' => 'required',
            'country' => 'required'
        ];
    }
}
