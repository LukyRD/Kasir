<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = kategori::all(); //query mengambil semua data dari tabel kategori

        return view('kategori.index', ['data' => $data, 'url' => '/kategori']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validasi
        $request->validate(
            ['nama_kategori' => 'required|unique:kategori,nama_kategori'],
            ['nama_kategori.unique' => 'Nama Kategori sudah ada!']
        );

        $kategori = new Kategori;
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        toast()->success('Data Berhasil Disimpan.');
        return redirect('/kategori')->with('pesan', "Data Berhasi Ditambahkan!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            ['nama_kategori' => 'required|unique:kategori,nama_kategori,' . $id],
            ['nama_kategori.unique' => 'Nama Kategori sudah ada!']
        );

        $kategori = Kategori::find($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->update();

        toast()->success('Data Berhasil Diubah.');
        return redirect('/kategori')->with('pesan', "Data Berhasi Diubah!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();

        toast()->success('Data Berhasil Dihapus.');
        return redirect('/kategori');
    }
}
