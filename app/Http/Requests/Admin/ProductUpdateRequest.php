<?php

namespace App\Http\Requests\Admin;

use App\Enums\ProductSaleTypeEnum;
use App\Enums\ProductStatusEnum;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $product = $this->route('product');

        return [
            'category_id' => ['required', 'integer', Rule::exists(Category::class, 'id')],
            'sku' => ['required', Rule::unique('products', 'sku')->ignore($product->id)],
            'name' => ['required', 'string', Rule::unique('products', 'name')->ignore($product->id)],
            'summary' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
            'status' => ['required', Rule::enum(ProductStatusEnum::class)],
            'sale_type' => ['nullable', Rule::enum(ProductSaleTypeEnum::class)],
            'sale_amount' => ['nullable', 'numeric'],
            'sale_active_from' => ['nullable', 'date'],
            'sale_active_to' => ['nullable', 'date'],
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
