<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; // Menentukan nama tabel yang terhubung dengan model Order

    protected $fillable = [
        'name', // Nama pesanan
        'total_price', // Total harga pesanan
    ];

    public $timestamps = false;
}
