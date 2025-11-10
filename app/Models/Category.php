<?php

namespace App\Models;

use App\Enums\CategoryTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'type',
        'description',
    ];

    protected $casts = [
        'type' => CategoryTypeEnum::class
    ];

    public static function booted(): void
    {
        self::creating(function (Category $category) {
            $category->slug = Str::slug($category->slug ?? $category->name);
        });

        static::deleting(function (Category $category) {
            $category->clearMediaCollection();
        });
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class)->with('children');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeProducts($query)
    {
        return $query->where('type', CategoryTypeEnum::PRODUCT->value);
    }

    public function scopePosts($query)
    {
        return $query->where('type', CategoryTypeEnum::POST->value);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnail')->singleFile();
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('thumbnail', 'thumb');
    }
}
