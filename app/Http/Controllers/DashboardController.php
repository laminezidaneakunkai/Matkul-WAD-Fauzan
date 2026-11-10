<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // 1. Halaman Utama / Dashboard
    public function index()
    {
        $data_akun = DB::table('akun_rental')->get();
        return view('dashboard', compact('data_akun'));
    }

    // 2. Halaman Login Pelanggan
    public function login()
    {
        return view('login');
    }

    // 3. Halaman Login Owner
    public function loginOwner()
    {
        return view('login_owner');
    }

    // 4. Halaman Statis Navigasi
    public function mitraPerawatan()
    {
        return view('mitra_perawatan');
    }

    public function lokasi()
    {
        return view('lokasi');
    }

    public function kontak()
    {
        return view('kontak');
    }

    public function jenisLayanan()
    {
        return view('jenis_layanan');
    }

    // 5. Simpan Data Pelanggan Baru (Tabel: akun_rental)
    public function store(Request $request)
    {
        DB::table('akun_rental')->insert([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/')->with('success', 'Data berhasil disimpan!');
    }

    // 6. Hapus Data Pelanggan (Khusus Owner)
    public function destroy($id)
    {
        DB::table('akun_rental')->where('id', $id)->delete();
        return redirect('/')->with('success', 'Data berhasil dihapus!');
    }

    // 7. Proses Autentikasi Login (Pelanggan & Owner)
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'owner') {
                return redirect()->intended('/')->with('success', 'Selamat datang Owner!');
            }
            return redirect()->intended('/')->with('success', 'Berhasil login!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // 8. Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil keluar.');
    }
}