<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $category = $this->route('category');

        return [
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'slug' => ['nullable', 'string', 'min:3',
                Rule::unique('categories', 'slug')->ignore($category?->id)
            ],
        ];
    }
}
