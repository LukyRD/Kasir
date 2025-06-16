<?php

namespace App\Http\Controllers;

use App\Models\ItemsKasir;
use App\Models\Kasir;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

    public function laporan()
    {
        $data = Kasir::orderBy('created_at', 'desc')->get()->map(function ($item) {
            $item->tanggal_penerimaan = Carbon::parse($item->created_at)->locale('id')->translatedFormat('l, d F Y');
            return $item;
        });
        return view('laporan.laporan-penjualan', ['data' => $data]);
    }

    public function detailLaporan(String $no_kwitansi)
    {
        $data = Kasir::with('items')->where('no_kwitansi', $no_kwitansi)->first();
        $data->tanggal_penerimaan = Carbon::parse($data->created_at)->locale('id')->translatedFormat('l, d F Y');
        $data->subTotal = $data->items->sum('total');

        return view('laporan.detail-laporan-penjualan', ['data' => $data]);
    }
}
