<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $data = Supplier::all();
        return view('supplier.index', ['data' => $data, 'url' => '/supplier']);
    }

    public function store(Request $request)
    {

        //Validasi
        $request->validate(
            [
                'nama' => 'required|unique:supplier,nama',
                'alamat' => 'required',
                'telepon' => 'required|numeric',
            ],
            [
                'nama.required' => 'Nama Supplier tidak boleh kosong',
                'nama.unique' => 'Nama Supplier sudah terdaftar',
                'alamat.required' => 'Alamat tidak boleh kosong',
                'telepon.required' => 'Telepon tidak boleh kosong',
                'telepon.numeric' => 'Telepon harus berupa angka',
            ]
        );

        $supplier = new Supplier;
        $supplier->nama = $request->nama;
        $supplier->alamat = $request->alamat;
        $supplier->telepon = $request->telepon;
        $supplier->save();

        toast()->success('Data Berhasil Disimpan.');
        return redirect('/supplier');
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        $supplier->nama = $request->nama;
        $supplier->alamat = $request->alamat;
        $supplier->telepon = $request->telepon;
        $supplier->update();

        toast()->success('Data Berhasil Diubah.');
        return redirect('/supplier');
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();

        toast()->success('Data Berhasil Dihapus.');
        return redirect('/supplier');
    }

    public function getData()
    {
        $search = request()->query('search');

        $query = Supplier::query();
        $supplier = $query->where('nama', 'like', '%' . $search . '%')->get();

        return response()->json($supplier);
    }
}
