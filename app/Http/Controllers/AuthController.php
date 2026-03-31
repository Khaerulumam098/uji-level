<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    // Halaman pemilihan role
    public function roleSelect()
    {
        return view('role-select');
    }

    // Halaman login — role diterima dari query string: /login?role=guru
    public function showLogin(Request $request)
    {
        $validRoles = ['admin', 'guru', 'siswa', 'orangtua'];
        $role = $request->query('role');

        if (!in_array($role, $validRoles)) {
            return redirect()->route('role.select');
        }

        return view('login', compact('role'));
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'role'     => 'required|in:admin,guru,siswa,orangtua',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');
        $role = $request->input('role');

        // Cari user
        $user = User::where('username', $username)->first();

        if (!$user || !\Illuminate\Support\Facades\Hash::check($password, $user->password)) {
            return back()->withErrors(['Username atau password salah.']);
        }

        // Cek role sesuai
        if ($user->role !== $role) {
            return back()->withErrors(['Role tidak sesuai.']);
        }

        // SIMPLE: Store user ke session direct, then redirect
        session([
            'user_id' => $user->id,
            'username' => $user->username,
            'role' => $user->role,
            'kelas' => $user->kelas,
            'name' => $user->name,
        ]);

        // Map role ke route name (orangtua → orang-tua)
        $routePrefix = $user->role === 'orangtua' ? 'orang-tua' : $user->role;
        return redirect()->route($routePrefix . '.home');
    }

    // Logout
    public function logout(Request $request)
    {
        session()->forget(['user_id', 'username', 'role', 'kelas', 'name']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('role.select');
    }
}
