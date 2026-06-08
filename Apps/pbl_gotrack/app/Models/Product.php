<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        'is_active',
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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image_path) {
            if (Str::startsWith($this->image_path, ['http://', 'https://', '/storage/', '/images/'])) {
                return Str::startsWith($this->image_path, '/')
                    ? asset(ltrim($this->image_path, '/'))
                    : $this->image_path;
            }

            return Storage::disk('public')->url($this->image_path);
        }

        return match ($this->category?->slug) {
            'jersey' => asset('images/catalog/kaos-black.png'),
            'banner-spanduk' => asset('images/catalog/tripod-banner.png'),
            'stempel' => asset('images/catalog/kartu-nama.png'),
            default => asset('images/product/konveksi-apparel.png'),
        };
    }
}
