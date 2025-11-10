<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryService
{
    protected function generateUniqueSlug(string $name, ?Category $category = null): string
    {
        $slug = Str::slug($name);

        if (!is_null($category) && $slug == $category->slug) {
            return $slug;
        }

        $originalSlug = $slug;
        $count = 1;

        while (Category::query()->where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }

    public function create(array $data): Category
    {
        $data['slug'] = $this->generateUniqueSlug($data['name']);

        return Category::query()->create($data);
    }

    public function update(Category $category, array $data): Category
    {
        $data['slug'] = $this->generateUniqueSlug($data['name'], $category);

        $category->update($data);

        return $category;
    }

    public function delete(Category $category): void
    {
        $category->clearMediaCollection();
        $category->delete();
    }
}
