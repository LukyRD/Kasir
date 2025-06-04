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
        Schema::create('produk', function (Blueprint $table) {
            $table->unsignedInteger('id_produk');
            $table->foreign('id_produk')->references('id_kategori')->on('kategori')->onUpdate('restrict')->onDelete('restrict');
            $table->string('kode_produk')->unique();
            $table->string('nama_produk')->nullable();
            $table->string('merk');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->integer('stok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
