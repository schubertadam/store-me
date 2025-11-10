<?php

namespace App\Http\Requests\Admin;

use App\Enums\CategoryTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string'],
            'type' => ['required', 'string', Rule::enum(CategoryTypeEnum::class)],
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return auth()->check();
    }
}
