<?php

namespace App\Models;

use App\Models\ItemsKasir;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kasir extends Model
{
    protected $table = "kasir";
    protected $guarded = ['id'];

    public static function nomorKwitansi()
    {
        $max = self::max('id');
        $prefix = "INV-";
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
        return $this->hasMany(ItemsKasir::class, 'no_kwitansi', 'no_kwitansi');
    }
}
