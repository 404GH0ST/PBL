<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'tracking_id',
        'customer_name',
        'customer_whatsapp',
        'product_id',
        'custom_product_name',
        'selected_addons', // Ditambahkan
        'quantity',
        'total_price',
        'payment_status',  // Ditambahkan
        'dp_amount',       // Ditambahkan
        'notes',           // Ditambahkan
        'completion_proof_path',
        'status'
    ];
    protected $casts = [
        'selected_addons' => 'array',
    ];
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
