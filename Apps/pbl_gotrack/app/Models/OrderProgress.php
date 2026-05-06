<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProgress extends Model
{
    //
    use HasFactory;

    protected $fillable = ['order_id', 'production_stage_id', 'title', 'staff_id', 'notes', 'photo'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi ke tabel tahapan agar nama tahapannya ikut berubah jika di-edit di master data
    public function productionStage()
    {
        return $this->belongsTo(ProductionStage::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
