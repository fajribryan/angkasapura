<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory;

    protected $table = 'order_histories';

    protected $fillable = [
        'order_id',
        'items',
        'total_price',
        'completed',
        // Tambahkan kolom lain yang perlu diisi secara massal
    ];

    protected $casts = [
        'items' => 'array' // Kolom 'items' di-cast sebagai array saat diambil/diakses
    ];

    // Relasi dengan model Order (satu order history dimiliki oleh satu order)
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
