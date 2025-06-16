<?php

namespace App\Http\Controllers;

use App\Models\ItemsKasir;
use App\Models\Kasir;
use App\Models\Produk;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        return view('kasir.index');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // Validasi kerika tidak ada barang dipilih
        if (empty($request->produk)) {
            toast()->error('Tidak ada produk yang dipilih!');

            return redirect()->back();
        }

        // Validasi inputan
        $request->validate(
            [
                'produk' => 'required',
                'bayar' => 'required|numeric|min:1',
            ],
            [
                'produk.required' => 'Produk harus dipilih!',
                'bayar.required' => 'Bayar terlebih dahulu!',
                'bayar.numeric' => 'Pembayaran harus berupa angka/nomor!',
                'bayar.min' => 'Pembayaran tidak boleh 0!',
            ]
        );

        // Validasi ketika pembayaran kurang
        if ($request->bayar < $request->sub_total) {
            toast()->error('Pembayaran Kurang');

            return redirect()->back();
        };

        $kasir = Kasir::create([
            'no_kwitansi' => Kasir::nomorKwitansi(),
            'kasir' => auth()->user()->name,
            'total' => intVal($request->sub_total),
            'bayar' => intVal($request->bayar),
            'kembalian' => intVal($request->kembalian),
        ]);

        $produk = $request->produk;
        foreach ($produk as $item) {
            ItemsKasir::create([
                'no_kwitansi' => $kasir->no_kwitansi,
                'nama_produk' => $item['nama_produk'],
                'qty' => $item['qty'],
                'harga_jual' => $item['harga_jual'],
                'total' => $item['total'],
            ]);

            Produk::where("id", $item['id_produk'])->decrement('stok', $item['qty']);
        }

        toast()->success('Data Berhasil Ditambahkan!');
        return redirect()->route('kasir.index');
    }
}
