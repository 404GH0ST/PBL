<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'icon'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function addons()
    {
        return $this->hasMany(ProductAddon::class);
    }

    public function productionStages()
    {
        return $this->hasMany(ProductionStage::class);
    }
}
