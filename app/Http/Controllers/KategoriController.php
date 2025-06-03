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
        $data = kategori::get(); //query mengambil semua data dari tabel kategori

        return view('kategori.index', ['title' => 'Kategori', 'data' => $data, 'url' => '/kategori']);
    }

    public function data()
    {
        $kategori = Kategori::get();

        return datatables()
            ->of($kategori)
            ->addIndexColumn()
            ->addColumn('aksi', '<button class="btn btn-xs btn-info"><i class="fa fa-pen-to-square"></i></button><button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></i></button>')
            ->rawColumns(['aksi'])
            ->make(true);
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

        $kategori = new Kategori;
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

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
        $kategori = Kategori::find($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->update();

        return redirect('/kategori')->with('pesan', "Data Berhasi Diubah!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();

        return redirect('/kategori')->with('pesan', 'Data Berhasil Dihapus!');
    }
}
