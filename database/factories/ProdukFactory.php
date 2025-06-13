<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_produk' => fake()->word(),
            'merk' => fake()->word(),
            'id_kategori' => Kategori::factory(),
            'harga_beli' => fake()->randomNumber(5, true),
            'harga_jual' => fake()->randomNumber(5, true),
            'stok' => fake()->randomNumber(3, false),
        ];
    }
}
