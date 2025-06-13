<?php

namespace App\Models;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    /** @use HasFactory<\Database\Factories\ProdukFactory> */
    use HasFactory;

    protected $table = 'produk';
    protected $fillable = ['nama_produk', 'id_kategori', 'merk', 'harga_jual', 'harga_beli', 'stok', 'stok_minimal', 'is_active'];

    /**
     * Get the kategori that owns the Produk
     *
     *
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id');
    }
}
