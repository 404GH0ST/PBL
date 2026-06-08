<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'payment_type',
        'payment_status',
        'dp_amount',
        'paid_amount',
        'paid_at',
        'notes',
        'completion_proof_path',
        'design_file_path',
        'status',
        'shipped_at',
        'completed_at',
        'customer_confirmed_at',
    ];

    protected $casts = [
        'selected_addons' => 'array',
        'paid_at' => 'datetime',
        'shipped_at' => 'datetime',
        'completed_at' => 'datetime',
        'customer_confirmed_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $order): void {
            $order->syncPaymentState();

            if ($order->isDirty('status')) {
                if ($order->status === 'shipped' && $order->shipped_at === null) {
                    $order->shipped_at = now();
                }

                if ($order->status === 'completed') {
                    $order->completed_at ??= now();
                    $order->customer_confirmed_at ??= now();
                    $order->shipped_at ??= $order->completed_at;
                }
            }
        });
    }

    public function getRemainingPaymentAttribute(): int
    {
        if ($this->payment_status === 'paid') {
            return 0;
        }

        return max((int) $this->total_price - (int) $this->paid_amount, 0);
    }

    public function getPaidAmountAttribute($value): int
    {
        if ($this->payment_status === 'paid') {
            return (int) $this->total_price;
        }

        if ($this->payment_status === 'dp') {
            return max((int) $value, (int) $this->dp_amount);
        }

        return (int) $value;
    }

    public function getSettlementAmountAttribute(): int
    {
        if ($this->payment_status !== 'paid') {
            return 0;
        }

        return max((int) $this->total_price - (int) $this->dp_amount, 0);
    }

    public function getReceivedRevenueAttribute(): int
    {
        return match ($this->payment_status) {
            'paid' => (int) $this->total_price,
            'dp' => (int) $this->paid_amount,
            default => 0,
        };
    }

    public function getPaymentTypeLabelAttribute(): string
    {
        return match ($this->payment_type) {
            'paid' => 'Lunas Langsung',
            default => 'DP / Uang Muka',
        };
    }

    public function getPaymentStatusLabelAttribute(): string
    {
        return match ($this->payment_status) {
            'paid' => 'Lunas',
            'dp' => 'DP / Belum Lunas',
            default => 'Belum Bayar',
        };
    }

    protected function syncPaymentState(): void
    {
        $totalPrice = max((int) $this->total_price, 0);
        $this->payment_type = $this->payment_type === 'paid' ? 'paid' : 'dp';

        if ($this->payment_type === 'paid') {
            $this->dp_amount = $this->dp_amount ?: null;
            $this->paid_amount = $totalPrice;
            $this->payment_status = 'paid';
            $this->paid_at ??= now();

            return;
        }

        $dpAmount = min(max((int) $this->dp_amount, 0), $totalPrice);

        $this->dp_amount = $dpAmount;
        $this->paid_amount = $dpAmount;
        $this->payment_status = 'dp';
        $this->paid_at = null;
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
