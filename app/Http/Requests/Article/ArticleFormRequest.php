<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class ArticleFormRequest extends FormRequest
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
            'thumbnail' => [
                'required',
                'url',
                'regex:/^https:\/\/res\.cloudinary\.com\/[\w\/]+\/image\/upload\/v\d+\/[\w]+\.(png|jpg|jpeg|gif|bmp|webp)$/i',
            ],
            'title' => 'required|string|max:255',
            'content' => 'required',
        ];
    }
}
