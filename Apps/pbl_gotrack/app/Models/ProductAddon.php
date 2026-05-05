<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAddon extends Model
{
    //
    protected $fillable = ['category_id', 'type', 'name', 'price'];

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
