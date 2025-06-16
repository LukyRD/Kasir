<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items_kasir', function (Blueprint $table) {
            $table->id();
            $table->string('no_kwitansi');
            $table->string('nama_produk');
            $table->integer('qty');
            $table->integer('harga_jual');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items_kasir');
    }
};
