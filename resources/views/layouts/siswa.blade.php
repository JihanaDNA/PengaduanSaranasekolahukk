<!DOCTYPE html>
<html>
<head>
    <title>Siswa</title>
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
            background: #16a085;
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
            background: #1abc9c;
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
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>SISWA</h2>

        <a href="/siswa/dashboard">Dashboard</a>
        <a href="/siswa/aspirasi/create">Input Aspirasi</a>
        <a href="/siswa/aspirasi">Riwayat Aspirasi</a>
        <a href="/siswa/profile">Profile</a>
        <a href="/logout">Logout</a>
    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

</body>
</html>