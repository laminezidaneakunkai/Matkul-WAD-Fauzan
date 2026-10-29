<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($akun) ? 'Edit Akun' : 'Tambah Akun' }} - Sistem Informasi Rental Mobil</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #0c7af0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: #f4efef;
            padding: 35px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }

        h2 {
            color: #00050b;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #01070f;
            margin-bottom: 6px;
        }

        .form-group input, 
        .form-group textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-group input:focus, 
        .form-group textarea:focus {
            border-color: #4361ee;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }

        .form-group textarea {
            resize: vertical;
            height: 70px;
        }

        .btn {
            width: 100%;
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
        }

        .btn:hover {
            background-color: #3651d4;
        }

        .btn-secondary {
            background-color: #e2e8f0;
            color: #475569;
        }

        .btn-secondary:hover {
            background-color: #cbd5e1;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>{{ isset($akun) ? 'Edit Akun / Identitas' : 'Tambah Akun / Identitas' }}</h2>

        <!-- Form mengarah ke route /simpan-akun dengan metode POST -->
        <form action="{{ url('/simpan-akun') }}" method="POST">
            @csrf
            
            <!-- Input tersembunyi untuk menyimpan ID jika sedang mode edit -->
            <input type="hidden" name="id_akun" value="{{ isset($akun) ? $akun->id : '' }}">

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="{{ isset($akun) ? $akun->nama : '' }}" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="form-group">
                <label for="nik">NIK (Nomor Induk Kependudukan)</label>
                <input type="text" id="nik" name="nik" value="{{ isset($akun) ? $akun->nik : '' }}" maxlength="16" placeholder="Masukkan 16 digit NIK" required pattern="[0-9]{16}" title="NIK harus berisi 16 digit angka">
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" placeholder="Masukkan alamat lengkap" required>{{ isset($akun) ? $akun->alamat : '' }}</textarea>
            </div>

            <button type="submit" class="btn">{{ isset($akun) ? 'Simpan Perubahan' : 'Masuk / Simpan' }}</button>
            <a href="{{ url('/') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
        </form>
    </div>

</body>
</html>