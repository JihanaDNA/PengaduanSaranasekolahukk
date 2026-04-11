<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 220px;
            height: 100vh;
            background: #2c3e50;
            color: white;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 10px;
            text-decoration: none;
            margin: 5px 0;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background: #34495e;
        }

        /* CONTENT */
        .content {
            flex: 1;
            padding: 20px;
            background: #ecf0f1;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
    }

    .card {
        padding: 20px;
        border-radius: 10px;
        color: white;
        font-size: 18px;
        text-align: center;
    }

    .card h3 {
        margin: 0;
        font-size: 16px;
    }

    .card p {
        font-size: 28px;
        margin-top: 10px;
    }

    /* WARNA */
    .blue { background: #3498db; }
    .green { background: #2ecc71; }
    .orange { background: #f39c12; }
    .red { background: #e74c3c; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>ADMIN</h2>

        <a href="/admin/dashboard">Dashboard</a>
        <a href="/admin/kategori">Kategori</a>
        <a href="/admin/riwayat-aspirasi">Laporan Aspirasi</a>
        <a href="/admin/siswa">Daftar Siswa</a>
        <a href="/logout">Logout</a>
    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

</body>
</html>