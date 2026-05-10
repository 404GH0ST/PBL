<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_id',
        'customer_name',
        'customer_whatsapp',
        'shipping_address',
        'product_id',
        'custom_product_name',
        'selected_addons',
        'quantity',
        'total_price',
        'payment_status',
        'dp_amount',
        'notes',
        'completion_proof_path',
        'status',
        'shipped_at',
        'completed_at',
        'customer_confirmed_at',
    ];

    protected $casts = [
        'selected_addons' => 'array',
        'shipped_at' => 'datetime',
        'completed_at' => 'datetime',
        'customer_confirmed_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $order): void {
            if (!$order->isDirty('status')) {
                return;
            }

            if ($order->status === 'shipped' && $order->shipped_at === null) {
                $order->shipped_at = now();
            }

            if ($order->status === 'completed') {
                $order->completed_at ??= now();
                $order->customer_confirmed_at ??= now();
                $order->shipped_at ??= $order->completed_at;
            }
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function progress()
    {
        return $this->hasMany(OrderProgress::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
