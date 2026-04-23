@extends('layouts.siswa')

@section('content')
<style>
    .center-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh; 
    }

    .form-wrapper {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        width: 100%;
        max-width: 750px;
    }

    .form-wrapper h2 {
        margin-top: 0;
        margin-bottom: 25px;
        color: #0A3323;
        font-size: 26px;
        text-align: center;
        border-bottom: 2px solid #F7F4D5;
        padding-bottom: 15px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #333;
        font-size: 15px;
    }

    input[type="text"], 
    select, 
    textarea,
    input[type="file"] {
        width: 100%;
        padding: 14px 15px;
        border: 1.5px solid #839958;
        border-radius: 10px;
        font-family: inherit;
        font-size: 15px;
        box-sizing: border-box;
        outline: none;
        transition: 0.3s;
        background-color: #fcfcfc;
    }

    input[type="text"]:focus, 
    select:focus, 
    textarea:focus {
        border-color: #105666;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(16, 86, 102, 0.1);
    }

    textarea {
        resize: vertical;
    }

    /* Error Alert */
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 14px;
        border-left: 5px solid #dc3545;
    }

    /* Tombol */
    button[type="submit"] {
        background: #105666;
        color: white;
        border: none;
        padding: 16px;
        border-radius: 10px;
        font-weight: bold;
        cursor: pointer;
        font-size: 16px;
        transition: 0.3s;
        width: 100%;
        margin-top: 10px;
    }

    button[type="submit"]:hover {
        background: #0A3323;
        transform: translateY(-2px);
    }

    .info-text {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
    }
</style>

<div class="center-container">
    <div class="form-wrapper">
        <h2>Input Aspirasi Siswa</h2>

        @if ($errors->any())
            <div class="alert-danger">
                @foreach ($errors->all() as $error)
                    <p style="margin: 5px 0;">• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/siswa/aspirasi/store" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Pilih Kategori</label>
                <select name="kategori_id" required>
                    <option value="">-- Pilih Kategori Aspirasi --</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id }}">{{ $k->ket_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="lokasi" placeholder="Misal: Kantin, Ruang Kelas XII RPL, Lab Komputer" required>
            </div>

            <div class="form-group">
                <label>Detail Keterangan</label>
                <textarea name="keterangan" rows="4" placeholder="Ceritakan secara detail aspirasi atau keluhanmu..." required></textarea>
            </div>

            <div class="form-group">
                <label>Upload Foto Pendukung</label>
                <input type="file" name="foto" accept="image/*" required>
                <p class="info-text">*Format: jpg, png, jpeg. Maksimal 2MB.</p>
            </div>

            <button type="submit">Kirim Aspirasi Sekarang</button>
        </form>
    </div>
</div>
@endsection