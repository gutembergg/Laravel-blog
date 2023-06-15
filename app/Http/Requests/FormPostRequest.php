<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FormPostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:4', Rule::unique('posts')->ignore($this->route()->parameter('post'))],
            'content' => ['required'],
            'slug' => ['regex: /^[a-z0-9\-]+$/'],
            'category' => ['required', 'exists:categories,id'],
            'tags' => ['array', 'exists:tags,id', 'required']
        ];
    }

    protected function prepareForValidation(): void
{
    $this->merge([
        'slug' => $this->input('slug') ?: Str::slug($this->input('title')),
    ]);
}
}