<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Pengaduan Sarana Sekolah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box; /* Memastikan padding tidak merusak lebar kotak */
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            display: flex;
            height: 100vh;
            background-color: #F7F4D5;
        }

        /* LEFT SIDE */
        .left {
            flex: 1.2;
            background: linear-gradient(135deg, #0A3323, #105666);
            color: #F7F4D5;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 80px;
        }

        .left h1 {
            font-size: 40px;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .left p {
            font-size: 18px;
            color: #D3968C;
            max-width: 450px;
        }

        /* RIGHT SIDE */
        .right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-box {
            background: white;
            padding: 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .login-box h2 {
            margin-top: 0;
            margin-bottom: 25px;
            color: #0A3323;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 15px;
        }

        select, input {
            width: 100%;
            padding: 14px;
            margin-bottom: 15px;
            border-radius: 10px;
            border: 1.5px solid #eee;
            outline: none;
            font-family: inherit;
            transition: 0.3s;
            font-size: 14px;
        }

        select:focus, input:focus {
            border-color: #105666;
            background-color: #f9fdfb;
        }

        button {
            width: 100%;
            padding: 14px;
            background: #0A3323;
            border: none;
            color: white;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            transition: 0.3s;
            margin-top: 5px;
        }

        button:hover {
            background: #105666;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 86, 102, 0.3);
        }

        .error {
            background: #ffebee;
            color: #c62828;
            padding: 10px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            text-align: center;
        }

        .footer {
            margin-top: 25px;
            font-size: 12px;
            text-align: center;
            color: #839958;
            opacity: 0.8;
        }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .left { padding: 40px; }
            .left h1 { font-size: 30px; }
        }

        @media (max-width: 768px) {
            .left { display: none; }
            .right { background: linear-gradient(135deg, #0A3323, #105666); }
        }
    </style>
</head>
<body>

<div class="left">
    <h1>Bersama Rawat <br> Fasilitas Sekolah</h1>
    <p>Wadah aspirasi digital untuk memantau, melaporkan, dan memperbaiki sarana belajar kita demi kenyamanan bersama.</p>
</div>

<div class="right">
    <div class="login-box">
        <h2>Selamat Datang</h2>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <label style="font-size: 13px; color: #666; margin-bottom: 5px; display: block;">Login Sebagai:</label>
            <select name="login_type" id="login_type" onchange="toggleForm()">
                <option value="admin">Admin</option>
                <option value="siswa">Siswa</option>
            </select>

            <div id="formFields">
                <div id="adminInputs">
                    <input type="text" name="username" placeholder="Username">
                    <input type="password" name="password" placeholder="Password">
                </div>

                <div id="siswaInputs" style="display:none;">
                    <input type="text" name="nis" placeholder="Nomor Induk Siswa (NIS)">
                    <input type="text" name="kelas" placeholder="Kelas (Contoh: XII RPL 1)">
                </div>
            </div>

            <button type="submit">Login</button>

            <div class="footer">
                Pengaduan Sarana Sekolah
            </div>
        </form>
    </div>
</div>

<script>
function toggleForm() {
    const type = document.getElementById('login_type').value;
    const adminInputs = document.getElementById('adminInputs');
    const siswaInputs = document.getElementById('siswaInputs');

    if (type === 'admin') {
        adminInputs.style.display = 'block';
        siswaInputs.style.display = 'none';
        siswaInputs.querySelectorAll('input').forEach(i => i.value = '');
    } else {
        adminInputs.style.display = 'none';
        siswaInputs.style.display = 'block';
        adminInputs.querySelectorAll('input').forEach(i => i.value = '');
    }
}
</script>

</body>
</html>