<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Rental Mobil</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #80a1c2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            padding: 35px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 850px;
            text-align: center;
        }

        h2 {
            color: #1e293b;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .role-section-title {
            font-size: 14px;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Container dua tombol pilihan role */
        .role-grid {
            display: flex;
            gap: 12px;
            margin-bottom: 15px;
        }

        .btn {
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
            margin-bottom: 12px;
            display: block;
            text-align: center;
            text-decoration: none;
            color: white;
            background-color: #4361ee;
            width: 100%;
        }

        .btn:hover {
            background-color: #3651d4;
        }

        .btn-pelanggan {
            background-color: #4361ee;
            color: white;
        }

        .btn-owner {
            background-color: #0f172a;
            color: white;
        }

        .btn-owner:hover {
            background-color: #1e293b;
        }

        .btn-outline {
            background-color: transparent;
            color: #ef4444;
            border: 2px solid #ef4444;
        }

        .btn-outline:hover {
            background-color: #ef4444;
            color: white;
        }

        .btn-warning {
            background-color: #f59e0b;
            padding: 6px 10px;
            font-size: 12px;
            display: inline-block;
            width: auto;
        }

        .btn-danger {
            background-color: #ef4444;
            padding: 6px 10px;
            font-size: 12px;
            display: inline-block;
            width: auto;
        }

        .divider {
            height: 1px;
            background-color: #e2e8f0;
            margin: 18px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            text-align: left;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
            color: #475569;
        }

        th {
            background-color: #f8fafc;
            color: #1e293b;
            font-weight: 600;
        }

        .alert-info {
            background-color: #eff6ff;
            color: #1d4ed8;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Sistem Informasi Rental Mobil</h2>

        <!-- Tambahkan Alert Sukses Ini -->
@if(session('success'))
    <div style="background-color: #d1fae5; color: #065f46; padding: 12px; border-radius: 8px; margin-bottom: 15px; font-weight: 600;">
        {{ session('success') }}
    </div>
@endif

        <!-- Bagian Pilihan Hak Akses / Login -->
        @guest
            <div class="role-section-title">Pilih Hak Akses Masuk</div>
            <div class="role-grid">
                <!-- Klik Pelanggan: Langsung menuju Form Login / Identitas -->
                <a href="{{ url('/login?role=pelanggan') }}" class="btn btn-pelanggan">👤 Login Pelanggan</a>
                
                <!-- Klik Owner: Menuju Form Login Khusus Owner/Admin -->
                <a href="{{ url('/login-owner') }}" class="btn btn-owner">👑 Login Owner</a>
            </div>
        @else
            <!-- Status jika user sudah terautentikasi -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <span style="font-size: 14px; color: #334155;">
                    Selamat datang, <strong>{{ auth()->user()->nama }}</strong> (Role: <u>{{ ucfirst(auth()->user()->role) }}</u>)
                </span>
                <a href="{{ url('/logout') }}" class="btn btn-outline" style="width: auto; margin-bottom: 0; padding: 6px 14px; font-size: 13px;">Keluar</a>
            </div>
        @endguest

        <div class="divider"></div>

        <!-- Tombol Menu Utama -->
        <a href="{{ url('/mitra-perawatan') }}" class="btn">Langganan Mitra Perawatan</a>
        <a href="{{ url('/lokasi') }}" class="btn">Lokasi</a>
        <a href="{{ url('/kontak') }}" class="btn">Kontak</a>
        <a href="{{ url('/jenis-layanan') }}" class="btn">Jenis Layanan</a>

        <!-- HAK AKSES KHUSUS OWNER: Tabel Data Pelanggan -->
        @if(auth()->check() && auth()->user()->role === 'owner')
            <div class="divider"></div>
            <h2 style="font-size: 18px; margin-top: 20px; text-align: left;">Data Akun / Identitas Pelanggan (Khusus Owner)</h2>
            
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data_akun as $index => $row)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->nik }}</td>
                        <td>{{ $row->alamat }}</td>
                        <td>
                            <a href="{{ url('/login?id=' . $row->id) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ url('/hapus/' . $row->id) }}" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center;">Belum ada data pelanggan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        @elseif(auth()->check() && auth()->user()->role === 'pelanggan')
            <div class="alert-info">
                Anda masuk sebagai <strong>Pelanggan</strong>. Silakan pilih menu di atas untuk menggunakan layanan rental mobil.
            </div>
        @endif
    </div>

</body>
</html>