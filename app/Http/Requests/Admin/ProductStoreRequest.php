<?php

namespace App\Http\Requests\Admin;

use App\Enums\ProductStatusEnum;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', Rule::exists(Category::class, 'id')],
            'sku' => ['required', 'unique:products,sku'],
            'name' => ['required', 'string', 'unique:products,name'],
            'summary' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
            'status' => ['required', Rule::enum(ProductStatusEnum::class)],
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['file', 'mimes:jpg,jpeg,png,webp,svg'],
        ];
    }

    public function authorize(): bool
    {
        return auth()->check();
    }
}
