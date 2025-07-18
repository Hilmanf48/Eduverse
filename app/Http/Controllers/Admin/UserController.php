<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Ambil semua user kecuali user yang sedang login saat ini
        $users = User::where('id', '!=', auth()->id())->get();
        return view('admin.users.index', compact('users'));
    }

    public function toggleAdmin(User $user)
    {
        // Logika pengaman: pastikan user tidak mengubah rolenya sendiri
        if (auth()->id() == $user->id) {
            return back()->with('error', 'Anda tidak dapat mengubah role akun Anda sendiri.');
        }

        // Ubah status is_admin (jika true jadi false, jika false jadi true)
        $user->is_admin = !$user->is_admin;
        $user->save();

        return back()->with('success', 'Role user berhasil diubah.');
    }
}
