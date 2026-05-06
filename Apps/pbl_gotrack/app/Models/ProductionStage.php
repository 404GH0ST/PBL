<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductionStage extends Model
{
    //
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'sequence'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Sihir Auto-Increment Sequence per Kategori
    protected static function booted()
    {
        static::creating(function ($stage) {
            $maxSequence = static::where('category_id', $stage->category_id)->max('sequence');
            $stage->sequence = $maxSequence ? $maxSequence + 1 : 1;
        });
    }
}
