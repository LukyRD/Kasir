<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BarangMasuk extends Model
{
    protected $table = "barang_masuk";
    protected $guarded = ['id'];

    public static function nomorPenerimaan()
    {
        $max = self::max('id');
        $prefix = "BM-";
        $date = date('dmy');
        $nomor = $prefix . $date . str_pad($max + 1, 4, '0', STR_PAD_LEFT);

        return $nomor;
    }

    /**
     * Get all of the items for the BarangMasuk
     *
     *
     */
    public function items(): HasMany
    {
        return $this->hasMany(ItemsBarangMasuk::class, 'no_penerimaan', 'no_penerimaan');
    }
}
