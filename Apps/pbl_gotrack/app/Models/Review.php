<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Order;
use App\Models\Product;

class Review extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_rating',
        'service_rating',
        'comment',
        'is_visible'
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
