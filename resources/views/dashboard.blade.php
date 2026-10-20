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

        .btn-outline {
            background-color: transparent;
            color: #4361ee;
            border: 2px solid #4361ee;
        }

        .btn-outline:hover {
            background-color: #4361ee;
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
    </style>
</head>
<body>

    <div class="container">
        <h2>Sistem Informasi Rental Mobil</h2>

        <!-- Tombol untuk menuju halaman login -->
        <a href="{{ url('/login') }}" class="btn btn-outline">🔑 Login / Masuk</a>

        <div class="divider"></div>

        <!-- Tombol Menu Utama -->
        <a href="{{ url('/mitra-perawatan') }}" class="btn">Langganan Mitra Perawatan</a>
        <a href="{{ url('/lokasi') }}" class="btn">Lokasi</a>
        <a href="{{ url('/kontak') }}" class="btn">Kontak</a>
        <a href="{{ url('/jenis-layanan') }}" class="btn">Jenis Layanan</a>

        <div class="divider"></div>

        <!-- Bagian Tabel Data Pelanggan -->
        <h2 style="font-size: 18px; margin-top: 20px; text-align: left;">Data Akun / Identitas Pelanggan</h2>
        
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
    </div>

</body>
</html>