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

    public function buildCategoryTreeOptions($categories, $level = 0, &$options = []): array
    {
        // A behúzás előtagja, pl. "— — "
        $prefix = str_repeat('— ', $level);

        foreach ($categories as $category) {
            // Hozzáadjuk az aktuális kategóriát a behúzással
            $options[$category->id] = $prefix . $category->name;

            // Ha van gyerek (children) kapcsolat, rekurzívan bejárjuk
            if ($category->children->isNotEmpty()) {
                $this->buildCategoryTreeOptions($category->children, $level + 1, $options);
            }
        }
        return $options;
    }
}
