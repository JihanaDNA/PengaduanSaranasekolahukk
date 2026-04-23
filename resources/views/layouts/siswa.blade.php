<!DOCTYPE html>
<html>
<head>
    <title>Siswa Panel</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            background: #F7F4D5;
        }

        .sidebar {
            width: 240px;
            height: 100vh;
            background: #0A3323;
            color: #ffffff; 
            padding: 25px 15px;
            box-sizing: border-box;
            position: fixed;
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

        .sidebar a:hover, .sidebar a.active {
            background: #839958;
            color: #0A3323;
            font-weight: bold;
        }

        .content {
            flex: 1;
            padding: 30px;
            margin-left: 240px; 
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
        <h2>SISWA PANEL</h2>

        <a href="/siswa/dashboard" class="{{ request()->is('siswa/dashboard') ? 'active' : '' }}">
            Dashboard
        </a>
        
        <a href="/siswa/aspirasi/create" class="{{ request()->is('siswa/aspirasi/create*') ? 'active' : '' }}">
            Input Aspirasi
        </a>
        
        <a href="/siswa/aspirasi" class="{{ request()->is('siswa/aspirasi') ? 'active' : '' }}">
            Riwayat Aspirasi
        </a>
        
        <a href="/siswa/profile" class="{{ request()->is('siswa/profile*') ? 'active' : '' }}">
            Profile
        </a>
        
        <a href="/logout" class="logout-link">Logout</a>
    </div>

    <div class="content">
        @yield('content')
    </div>

</body>
</html>