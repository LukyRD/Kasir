<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
