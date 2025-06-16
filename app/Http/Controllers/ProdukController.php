<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $data = Produk::all();
        $kategori = Kategori::all();
        return view('produk.index', ['data' => $data, 'kategori' => $kategori, 'url' => '/produk']);
    }

    public function store(Request $request)
    {
        //Validasi
        $request->validate(
            [
                'nama_produk' => 'required|unique:produk,nama_produk',
                'id_kategori' => 'required|exists:kategori,id',
                'merk' => 'required',
                'harga_jual' => 'required|numeric|min:0',
                'harga_beli' => 'required|numeric|min:0',
                'stok' => 'required|numeric|min:0',
                'stok_minimal' => 'required|numeric|min:0',
            ],
            [
                'nama_produk.required' => 'Nama Produk tidak boleh kosong',
                'nama_produk.unique' => 'Nama Produk sudah terdaftar',
                'id_kategori.required' => 'Kategori tidak boleh kosong',
                'id_kategori.exists' => 'Kategori tidak tersedia',
                'merk.required' => 'Merk tidak boleh kosong',
                'harga_jual.required' => 'Harga Jual tidak boleh kosong',
                'harga_jual.numeric' => 'Harga Jual harus berupa angka',
                'harga_jual.min' => 'Harga jual tidak boleh dibawah 0',
                'harga_beli.required' => 'Harga Beli tidak boleh kosong',
                'harga_beli.numeric' => 'Harga Beli harus berupa angka',
                'harga_beli.min' => 'Harga Beli tidak boleh dibawah 0',
                'stok.required' => 'Stok tidak boleh kosong',
                'stok.numeric' => 'Stok harus berupa angka',
                'stok.min' => 'Stok tidak boleh dibawah 0',
                'stok_minimal.required' => 'Stok Minimal tidak boleh kosong',
                'stok_minimal.numeric' => 'Stok Minimal harus berupa angka',
                'stok_minimal.min' => 'Stok Minimal tidak boleh dibawah 0',
            ]
        );

        $produk = new Produk;
        $produk->nama_produk = $request->nama_produk;
        $produk->id_kategori = $request->id_kategori;
        $produk->merk = $request->merk;
        $produk->harga_jual = $request->harga_jual;
        $produk->harga_beli = $request->harga_beli;
        $produk->stok = $request->stok;
        $produk->stok_minimal = $request->stok_minimal;
        $produk->is_active = $request->is_active ? true : false;
        $produk->save();

        toast()->success('Data Berhasil Disimpan.');
        return redirect('/produk');
    }

    public function update(Request $request, $id)
    {
        //Validasi
        $request->validate(
            [
                'nama_produk' => 'required|unique:produk,nama_produk,' . $id,
                'id_kategori' => 'required|exists:kategori,id',
                'merk' => 'required',
                'harga_jual' => 'required|numeric|min:0',
                'harga_beli' => 'required|numeric|min:0',
                'stok' => 'required|numeric|min:0',
                'stok_minimal' => 'required|numeric|min:0',
            ],
            [
                'nama_produk.required' => 'Nama Produk tidak boleh kosong',
                'nama_produk.unique' => 'Nama Produk sudah terdaftar',
                'id_kategori.required' => 'Kategori tidak boleh kosong',
                'id_kategori.exists' => 'Kategori tidak tersedia',
                'merk.required' => 'Merk tidak boleh kosong',
                'harga_jual.required' => 'Harga Jual tidak boleh kosong',
                'harga_jual.numeric' => 'Harga Jual harus berupa angka',
                'harga_jual.min' => 'Harga jual tidak boleh dibawah 0',
                'harga_beli.required' => 'Harga Beli tidak boleh kosong',
                'harga_beli.numeric' => 'Harga Beli harus berupa angka',
                'harga_beli.min' => 'Harga Beli tidak boleh dibawah 0',
                'stok.required' => 'Stok tidak boleh kosong',
                'stok.numeric' => 'Stok harus berupa angka',
                'stok.min' => 'Stok tidak boleh dibawah 0',
                'stok_minimal.required' => 'Stok Minimal tidak boleh kosong',
                'stok_minimal.numeric' => 'Stok Minimal harus berupa angka',
                'stok_minimal.min' => 'Stok Minimal tidak boleh dibawah 0',
            ]
        );

        $produk = Produk::find($id);
        $produk->nama_produk = $request->nama_produk;
        $produk->id_kategori = $request->id_kategori;
        $produk->merk = $request->merk;
        $produk->harga_jual = $request->harga_jual;
        $produk->harga_beli = $request->harga_beli;
        $produk->stok = $request->stok;
        $produk->stok_minimal = $request->stok_minimal;
        $produk->is_active = $request->is_active ? true : false;
        $produk->update();

        toast()->success('Data Berhasil Diubah.');
        return redirect('/produk');
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        toast()->success('Data Berhasil Dihapus.');
        return redirect('/produk');
    }

    public function getData()
    {
        $search = request()->query('search');

        $query = Produk::query();
        $produk = $query
            ->where('nama_produk', 'like', '%' . $search . '%')
            ->where('is_active', 1)
            ->get();

        return response()->json($produk);
    }

    public function cekStok()
    {
        $id = request()->query('id');
        $stok = Produk::find($id)->stok;

        return response()->json($stok);
    }

    public function cekHargaBeli()
    {
        $id = request()->query('id');
        $hargaBeli = Produk::find($id)->harga_beli;

        return response()->json($hargaBeli);
    }

    public function cekHargaJual()
    {
        $id = request()->query('id');
        $hargaJual = Produk::find($id)->harga_jual;

        return response()->json($hargaJual);
    }
}
