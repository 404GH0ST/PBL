<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderingStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'title',
        'description',
        'image',
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
            '01', '1' => asset('images/order/pilih-produk.png'),
            '02', '2' => asset('images/order/konsultasi.png'),
            '03', '3' => asset('images/order/pembayaran.png'),
            '04', '4' => asset('images/order/produksi.png'),
            '05', '5' => asset('images/order/pengiriman.png'),
            default => asset('images/order/pilih-produk.png'),
        };
    }
}
