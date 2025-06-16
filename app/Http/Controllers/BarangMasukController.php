<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\ItemsBarangMasuk;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

        $supplier = Supplier::find($request->supplier);

        $brMasuk = BarangMasuk::create([
            'no_penerimaan' => BarangMasuk::nomorPenerimaan(),
            'supplier' => $supplier->nama,
            'no_faktur' => $request->no_faktur,
            'kasir' => auth()->user()->name,
        ]);

        $produk = $request->produk;
        foreach ($produk as $item) {
            ItemsBarangMasuk::create([
                'no_penerimaan' => $brMasuk->no_penerimaan,
                'nama_produk' => $item['nama_produk'],
                'qty' => $item['qty'],
                'harga_beli' => $item['harga_beli'],
                'total' => $item['total'],
            ]);

            Produk::where("id", $item['id_produk'])->increment('stok', $item['qty']);
            $produk = Produk::find($item['id_produk']);
            $produk->harga_beli = $item['harga_beli'];
            $produk->update();
        }

        toast()->success('Data Berhasil Ditambahkan!');
        return redirect()->route('barang-masuk.index');
    }

    public function laporan()
    {
        $data = BarangMasuk::orderBy('created_at', 'desc')->get()->map(function ($item) {
            $item->tanggal_penerimaan = Carbon::parse($item->created_at)->locale('id')->translatedFormat('l, d F Y');
            return $item;
        });
        return view('laporan.laporan-pembelian', ['data' => $data]);
    }

    public function detailLaporan(String $no_penerimaan)
    {
        $data = BarangMasuk::with('items')->where('no_penerimaan', $no_penerimaan)->first();
        $data->tanggal_penerimaan = Carbon::parse($data->created_at)->locale('id')->translatedFormat('l, d F Y');
        $data->subTotal = $data->items->sum('total');

        return view('laporan.detail-laporan-pembelian', ['data' => $data]);
    }
}
