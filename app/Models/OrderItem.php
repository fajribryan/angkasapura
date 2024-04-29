<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_id',
        'quantity',
        'price',
    ];
    public $timestamps = false;
    // Relasi dengan model Order (many-to-one)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi dengan model Menu (many-to-one)
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
