<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            background: #F7F4D5; /* Beige */
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            height: 100vh;
            background: #0A3323; /* Dark Green */
            color: #F7F4D5; /* Beige */
            padding: 25px 15px;
            box-sizing: border-box;
            position: fixed; /* Tetap di kiri saat scroll */
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 20px;
            border-bottom: 1px solid #839958;
            padding-bottom: 15px;
        }

        .sidebar a {
            display: block;
            color: #F7F4D5;
            padding: 12px 15px;
            text-decoration: none;
            margin: 5px 0;
            border-radius: 8px;
            transition: 0.3s;
        }

        /* Hover & Menu Aktif (Kotak yang menetap) */
        .sidebar a:hover, 
        .sidebar a.active {
            background: #839958; /* Moss Green */
            color: #0A3323;      /* Dark Green */
            font-weight: bold;
        }

        /* CONTENT AREA */
        .content {
            flex: 1;
            padding: 30px;
            margin-left: 240px; /* Jarak agar tidak tertutup sidebar */
            min-height: 100vh;
        }

        .logout-link {
            margin-top: 30px;
            color: #D3968C !important;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>ADMIN PANEL</h2>
        
        <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            Dashboard
        </a>
        
        <a href="/admin/kategori" class="{{ request()->is('admin/kategori*') ? 'active' : '' }}">
            Kategori
        </a>
        
        <a href="/admin/riwayat-aspirasi" class="{{ request()->is('admin/riwayat-aspirasi*') ? 'active' : '' }}">
            Laporan Aspirasi
        </a>
        
        <a href="/admin/siswa" class="{{ request()->is('admin/siswa*') ? 'active' : '' }}">
            Daftar Siswa
        </a>
        
        <a href="/logout" class="logout-link">Logout</a>
    </div>

    <div class="content">
        @yield('content')
    </div>

</body>
</html>