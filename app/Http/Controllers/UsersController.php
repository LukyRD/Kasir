<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        if ($user->foto != null) {
            Storage::disk('public')->delete('foto_user/' . $user->foto);
        }
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

    public function profil()
    {
        return view('users.profil');
    }

    public function editProfil(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'old_password' => 'nullable|string',
            'password' => 'nullable|string',
            'password_confirmation' => 'nullable|string',
        ], [
            'foto.image' => 'Foto harus berupa gambar',
            'foto.mimes' => 'Format foto tidak sesuai',
            'foto.max' => 'Foto maksimal 2mb',
        ]);

        // Proses update foto jika ada
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fileName = microtime() . '.' . $foto->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('foto_user', $foto, $fileName);
            $user->foto = $fileName;
        }

        // Cek jika user ingin mengubah password
        if ($request->filled('old_password') || $request->filled('password') || $request->filled('password_confirmation')) {
            if (!Hash::check($request->old_password, $user->password)) {
                toast()->error('Password lama tidak sesuai');
                return redirect()->route('profil');
            }

            if ($request->password !== $request->password_confirmation) {
                toast()->error('Konfirmasi password tidak sama');
                return redirect()->route('profil');
            }

            $user->password = Hash::make($request->password);
        }

        $user->save();

        toast()->success('Profil berhasil diupdate');
        return redirect()->route('profil');
    }

}
