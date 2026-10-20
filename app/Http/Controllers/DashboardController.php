<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Menampilkan Halaman Utama / Dashboard & Data Pelanggan
    public function index()
    {
        $data_akun = DB::table('akun_rental')->get();
        return view('dashboard', compact('data_akun'));
    }

    // Menampilkan Form Login (Tambah atau Edit Data)
    public function login(Request $request)
    {
        $akun = null;
        if ($request->has('id')) {
            $akun = DB::table('akun_rental')->where('id', $request->id)->first();
        }

        return view('login', compact('akun'));
    }

    // Menampilkan Halaman Langganan Mitra Perawatan
    public function mitraPerawatan()
    {
        $telepon_mitra = "089663132784";
        return view('mitra-perawatan', compact('telepon_mitra'));
    }

    // Menampilkan Halaman Lokasi
    public function lokasi()
    {
        $urlMaps = "https://id.search.yahoo.com/search?fr=mcafee&type=E210ID91215G0&p=google+maps";
        return view('lokasi', compact('urlMaps'));
    }

    // Menampilkan Halaman Kontak
    public function kontak()
    {
        $telepon_kontak = "089663132784";
        return view('kontak', compact('telepon_kontak'));
    }

    // Menampilkan Halaman Jenis Layanan
    public function jenisLayanan()
    {
        $daftar_layanan = [
            "Rental Mobil Keluarga",
            "Rental Supercar",
            "Rental Mobil Daily"
        ];
        return view('jenis-layanan', compact('daftar_layanan'));
    }

    // Proses Simpan Data (Insert Baru atau Update)
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'alamat' => 'required|string',
        ]);

        if ($request->filled('id_akun')) {
            DB::table('akun_rental')->where('id', $request->id_akun)->update([
                'nama' => $request->nama,
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'updated_at' => now(),
            ]);
        } else {
            DB::table('akun_rental')->insert([
                'nama' => $request->nama,
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect('/')->with('success', 'Data berhasil disimpan!');
    }

    // Proses Hapus Data Pelanggan
    public function destroy($id)
    {
        DB::table('akun_rental')->where('id', $id)->delete();
        return redirect('/')->with('success', 'Data berhasil dihapus!');
    }
}