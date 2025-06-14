<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\ItemsBarangMasuk;
use App\Models\Produk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        return view('barang-masuk.index');
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'supplier' => 'required',
                'no_faktur' => 'required',
                'produk' => 'required',
            ], [
                'supplier.required' => 'Suppler tidak boleh kosong',
                'no_faktur.required' => 'No Faktur tidak boleh kosong',
                'produk.required' => 'Data tidak boleh kosong',
            ]);

        $brMasuk = BarangMasuk::create([
            'no_penerimaan' => BarangMasuk::nomorPenerimaan(),
            'supplier' => $request->supplier,
            'no_faktur' => $request->no_faktur,
            'kasir' => auth()->user()->name,
        ]);

        $produk = $request->produk;
        foreach ($produk as $item) {
            ItemsBarangMasuk::create([
                'nomor_penerimaan' => $brMasuk->no_penerimaan,
                'nama_produk' => $item['nama_produk'],
                'qty' => $item['qty'],
                'harga_beli' => $item['harga_beli'],
                'total' => $item['total'],
            ]);

            Produk::where("id", $item['id_produk'])->increment('stok', $item['qty']);
        }

        toast()->success('Data Berhasil Ditambahkan!');
        return redirect()->route('barang-masuk.index');
    }
}
