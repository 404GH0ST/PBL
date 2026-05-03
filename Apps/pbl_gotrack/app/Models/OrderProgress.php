<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProgress extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'order_id', 'staff_id', 'title', 'description'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
