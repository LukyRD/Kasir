<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $data = User::get();

        return view('users.index', ['data' => $data, 'url' => '/users']);
    }

    public function store(Request $request)
    {
        //Validasi
        $request->validate(
            [
                'name' => 'required|unique:users,name',
                'email' => 'required|unique:users,email',
            ],
            [
                'name.required' => 'Nama User tidak boleh kosong',
                'name.unique' => 'Nama User sudah terdaftar',
                'email.required' => 'Email tidak boleh kosong',
                'email.unique' => 'Email sudah terdaftar',
            ]
        );

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('12345678');
        $user->level = $request->level ? false : true;
        $user->save();

        toast()->success('User berhasil ditambahkan.');
        return redirect('/users');
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|unique:users,name,' . $id,
                'email' => 'required|unique:users,email,' . $id,
            ],
            [
                'name.required' => 'Nama User tidak boleh kosong',
                'name.unique' => 'Nama User sudah terdaftar',
                'email.required' => 'Email tidak boleh kosong',
                'email.unique' => 'Email sudah terdaftar',
            ]
        );

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level ? false : true;
        $user->update();

        toast()->success('User berhasil diedit.');
        return redirect('/users');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        toast()->success('User Berhasil Dihapus.');
        return redirect('/users');
    }

    public function resetPass(Request $request)
    {
        dd($request->all());
        $request->validate(
            ['id' => 'required']
        );

        $user = User::find($request->id);
        if (!$user) {
            toast()->error('User tidak ditemukan');
            return redirect()->back();
        }
        $user->password = Hash::make('12345678');
        $user->save();

        toast()->success('Password berhasil direset');
        return redirect()->route('users');
    }
}
