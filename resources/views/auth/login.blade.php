<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: linear-gradient(135deg, #3498db, #6dd5fa);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 320px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        select, input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #3498db;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #2980b9;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>

    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('login.process') }}">
        @csrf

        <!-- PILIH LOGIN -->
        <select name="login_type" id="login_type" onchange="toggleForm()">
            <option value="admin">Admin</option>
            <option value="siswa">Siswa</option>
        </select>

        <!-- FORM ADMIN -->
        <div id="adminForm">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
        </div>

        <!-- FORM SISWA -->
        <div id="siswaForm" style="display:none;">
            <input type="text" name="nis" placeholder="NIS">
            <input type="text" name="kelas" placeholder="Kelas">
        </div>

        <button type="submit">Login</button>
    </form>
</div>

<script>
function toggleForm() {
    let type = document.getElementById('login_type').value;

    if (type === 'admin') {
        document.getElementById('adminForm').style.display = 'block';
        document.getElementById('siswaForm').style.display = 'none';
    } else {
        document.getElementById('adminForm').style.display = 'none';
        document.getElementById('siswaForm').style.display = 'block';
    }
}
</script>

</body>
</html>