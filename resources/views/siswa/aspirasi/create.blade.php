@extends('layouts.siswa')

@section('content')

<style>
    .center-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        padding: 20px;
        box-sizing: border-box;
    }

    .form-wrapper {
        background: #ffffff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        width: 100%;
        max-width: 600px;
        border: 1px solid #f0f0f0;
        box-sizing: border-box;
    }

    .form-wrapper h2 {
        margin-top: 0;
        margin-bottom: 30px;
        color: #0A3323;
        font-size: 26px;
        text-align: center;
        font-weight: 700;
        position: relative;
    }

    .form-wrapper h2::after {
        content: '';
        display: block;
        width: 60px;
        height: 4px;
        background: #839958;
        margin: 12px auto 0;
        border-radius: 10px;
    }

    .form-group {
        margin-bottom: 20px;
        width: 100%;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #333;
        font-size: 14px;
        text-align: left;
    }

    input[type="text"],
    input[type="file"],
    select,
    textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1.5px solid #E0E0E0;
        border-radius: 12px;
        outline: none;
        font-size: 14px;
        font-family: inherit;
        background: #fafafa;
        box-sizing: border-box; 
        transition: all 0.3s ease;
    }

    input:focus, select:focus, textarea:focus {
        border-color: #839958;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(131, 153, 88, 0.1);
    }

    textarea {
        resize: none; 
    }

    button {
        width: 100%;
        padding: 16px;
        background: #0A3323;
        color: #ffffff;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 10px;
        box-sizing: border-box;
    }

    button:hover {
        background: #144d36;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(10, 51, 35, 0.2);
    }

    .alert {
        padding: 15px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 14px;
        box-sizing: border-box;
    }

    .alert-success {
        background: #E8F5E9;
        color: #2E7D32;
        border: 1px solid #C8E6C9;
    }

    .alert-danger {
        background: #FFE5E5;
        color: #D32F2F;
        border: 1px solid #FFCDCD;
    }
</style>

<div class="center-container">
    <div class="form-wrapper">

        <h2>Input Aspirasi</h2>

        @if(session('success'))
            <div class="alert alert-success" id="successAlert">
                <b>Berhasil!</b> {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p style="margin: 0;">• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/siswa/aspirasi/store" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Kategori Aspirasi</label>
                <select name="kategori_id" required>
                    <option value="" disabled selected>-- Pilih Kategori --</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id }}">{{ $k->ket_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Lokasi Kejadian</label>
                <input type="text" name="lokasi" placeholder="Misal: Lapangan, Perpustakaan..." required>
            </div>

            <div class="form-group">
                <label>Keterangan Lengkap</label>
                <textarea name="keterangan" rows="5" placeholder="Jelaskan aspirasi Anda secara detail..." required></textarea>
            </div>

            <div class="form-group">
                <label>Foto Bukti</label>
                <input type="file" name="foto" required>
            </div>

            <button type="submit">Kirim Sekarang</button>
        </form>

    </div>
</div>

<script>
    setTimeout(() => {
        const alert = document.getElementById('successAlert');
        if (alert) {
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = "0";
            setTimeout(() => alert.style.display = 'none', 500);
        }
    }, 3000);
</script>

@endsection