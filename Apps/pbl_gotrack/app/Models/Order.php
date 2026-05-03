<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'tracking_id', 'customer_name', 'customer_whatsapp', 
        'product_id', 'custom_product_name', 'quantity', 
        'total_price', 'completion_proof_path', 'status'
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
