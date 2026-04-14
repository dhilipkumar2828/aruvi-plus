<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'hsn',
        'category_id',
        'category',
        'collection',
        'visibility',
        'price',
        'compare_price',
        'stock',
        'low_stock',
        'inventory_status',
        'tax_class',
        'is_featured',
        'is_new_arrival',
        'allow_backorders',
        'is_active',
        'badge_text',
        'rating',
        'reviews_count',
        'short_description',
        'description',
        'ayurvedic_specs',
        'usage_instructions',
        'ingredients',
        'primary_image',
        'gallery_images',
        'weight',
        'dimensions',
        'material',
        'origin',
        'tags',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'is_featured' => 'boolean',
        'is_new_arrival' => 'boolean',
        'allow_backorders' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'rating' => 'decimal:1',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->where('visibility', 'active');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeNewArrivals(Builder $query): Builder
    {
        return $query->where('is_new_arrival', true);
    }

    public function category_rel()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class)->where('is_approved', true);
    }
}
