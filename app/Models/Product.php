<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'sku',
        'name',
        'summary',
        'description',
        'price',
        'stock',
        'status',
        'sale_type',
        'sale_amount',
        'sale_active_from',
        'sale_active_to',
    ];

    public static function booted(): void
    {
        self::creating(function (Product $product) {
            $product->slug = Str::slug($product->slug ?? $product->name);
        });

        static::deleting(function (Product $product) {
            $product->clearMediaCollection('thumbnail');
            $product->clearMediaCollection('gallery');
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getGalleryUrls(): array
    {
        return $this->getMedia('gallery')->map(fn($media) => $media->getUrl())->toArray();
    }
}
