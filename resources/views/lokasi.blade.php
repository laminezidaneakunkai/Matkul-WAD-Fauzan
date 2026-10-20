<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi - Sistem Informasi Rental Mobil</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .card {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            width: 90%;
            max-width: 500px;
        }
        h2 {
            color: #1e293b;
            font-size: 20px;
            margin-bottom: 12px;
        }
        p {
            color: #475569;
            margin-bottom: 15px;
            line-height: 1.5;
        }
        .map-link {
            color: #4361ee;
            word-break: break-all;
            text-decoration: none;
        }
        .map-link:hover {
            text-decoration: underline;
        }
        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            background-color: #64748b;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            transition: background-color 0.2s;
        }
        .btn-back:hover {
            background-color: #475569;
        }
    </style>
</head>
<body>

    <div class="card">
        <h2>Lokasi</h2>
        <p>Silahkan Gunakan Google Maps yang sudah disediakan :</p>
        <p><a href="{{ $urlMaps }}" target="_blank" class="map-link">{{ $urlMaps }}</a></p>
        <a href="{{ url('/') }}" class="btn-back">&larr; Kembali ke Menu Utama</a>
    </div>

</body>
</html>