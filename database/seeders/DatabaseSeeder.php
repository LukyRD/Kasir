<?php

namespace Database\Seeders;

use App\Models\Kategori;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => "Akmal W.",
            'email' => "admin@admin.com",
            'password' => Hash::make('admin'),
        ]);
        User::factory()->create([
            'name' => "Luky R.",
            'email' => "kasir@kasir.com",
            'password' => Hash::make('kasir'),
            'level' => 1,
        ]);

        Kategori::factory()->create(['nama_kategori' => 'Vitamin']);
        Kategori::factory()->create(['nama_kategori' => 'Obat Pusing']);
        Kategori::factory()->create(['nama_kategori' => 'Any']);

        Produk::factory()->create([
            'nama_produk' => 'Biocombin',
            'id_kategori' => '1',
            'merk' => 'Biocombin',
            'harga_jual' => 100000,
            'harga_beli' => 90000,
            'stok' => 100,
            'stok_minimal' => 10,
            'is_active' => 0,
        ]);
        Produk::factory()->create([
            'nama_produk' => 'Neuralgin',
            'id_kategori' => '2',
            'merk' => 'Neuralgin',
            'harga_jual' => 25000,
            'harga_beli' => 18000,
            'stok' => 200,
            'stok_minimal' => 50,
            'is_active' => 0,
        ]);
        Produk::factory()->create([
            'nama_produk' => 'Any',
            'id_kategori' => '3',
            'merk' => 'Any',
            'harga_jual' => 2,
            'harga_beli' => 1,
            'stok' => 1000,
            'stok_minimal' => 1,
            'is_active' => 1,
        ]);
    }
}
