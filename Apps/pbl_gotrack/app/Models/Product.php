<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'image_path',
        'is_active'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function addons()
    {
        return $this->hasMany(ProductAddon::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image_path) {
            if (\Illuminate\Support\Str::startsWith($this->image_path, ['http://', 'https://', '/storage/', '/images/'])) {
                return \Illuminate\Support\Str::startsWith($this->image_path, '/')
                    ? asset(ltrim($this->image_path, '/'))
                    : $this->image_path;
            }

            return \Illuminate\Support\Facades\Storage::disk('public')->url($this->image_path);
        }

        return match ($this->category?->slug) {
            'jersey' => asset('images/catalog/kaos-black.png'),
            'banner-spanduk' => asset('images/catalog/tripod-banner.png'),
            'stempel' => asset('images/catalog/kartu-nama.png'),
            default => asset('images/product/konveksi-apparel.png'),
        };
    }
}
