<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// use Illuminate\Database\Factories\HasFactory;

class Kategori extends Model
{
    // use HasFactory;

    //tabel
    protected $table = 'kategori';

    //primary key
    protected $primaryKey = 'id_kategori';

    //data yang boleh diisi
    protected $fillable = ["nama_produk"];

    //data yang tidak boleh diisi
    // protected $guarded = [];
}
