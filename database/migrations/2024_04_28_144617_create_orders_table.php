<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('items'); // Kolom untuk menyimpan detail item dalam format JSON
            $table->decimal('total_price', 10, 2); // Kolom untuk menyimpan total harga pesanan
            $table->timestamps();
            
            // Tambahkan kolom lain sesuai kebutuhan
            // Contoh: $table->string('status')->default('pending');
        });
    }

    /**
     * Batalkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
