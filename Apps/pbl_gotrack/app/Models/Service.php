<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::saving(function ($service) {
            if (empty($service->number) || $service->number === '00') {
                $maxNumber = (int) static::max('number');
                $next = max(1, $maxNumber + 1);
                $service->number = str_pad($next, 2, '0', STR_PAD_LEFT);
            }
        });
    }

    protected $fillable = [
        'number',
        'title',
        'subtitle',
        'description',
        'image',
        'active_background',
        'feature_product',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            if (\Illuminate\Support\Str::startsWith($this->image, ['http://', 'https://', '/storage/', '/images/'])) {
                return \Illuminate\Support\Str::startsWith($this->image, '/')
                    ? asset(ltrim($this->image, '/'))
                    : $this->image;
            }

            return \Illuminate\Support\Facades\Storage::disk('public')->url($this->image);
        }

        return match ($this->number) {
            '01', '1' => asset('images/product/konveksi-apparel.png'),
            '02', '2' => asset('images/product/media-promosi.png'),
            '03', '3' => asset('images/product/cetak-dtf.png'),
            '04', '4' => asset('images/product/kebutuhan-bisnis.png'),
            default => asset('images/product/konveksi-apparel.png'),
        };
    }
}
