@extends('layouts.admin')

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
        max-width: 700px;
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

    input[type="text"] {
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

    input[type="text"]:focus {
        border-color: #105666;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(16, 86, 102, 0.1);
    }

    input[readonly] {
        background-color: #f5f5f5;
        border-color: #ddd;
        cursor: not-allowed;
    }

    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 14px;
        border-left: 5px solid #dc3545;
    }

    .alert-danger p {
        margin: 5px 0;
    }

    .button-group {
        display: flex;
        gap: 12px;
        margin-top: 30px;
    }

    button[type="submit"] {
        flex: 2;
        background: #105666;
        color: white;
        border: none;
        padding: 15px;
        border-radius: 10px;
        font-weight: bold;
        cursor: pointer;
        font-size: 16px;
        transition: 0.3s;
    }

    button[type="submit"]:hover {
        background: #0A3323;
        transform: translateY(-2px);
    }

    .btn-cancel {
        flex: 1;
        background: #D3968C;
        color: white;
        text-decoration: none;
        text-align: center;
        padding: 15px;
        border-radius: 10px;
        font-weight: bold;
        font-size: 16px;
        transition: 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-cancel:hover {
        background: #b57a70;
        transform: translateY(-2px);
    }

    .info-text {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
        font-style: italic;
    }
</style>

<div class="center-container">
    <div class="form-wrapper">
        <h2>Edit Data Siswa</h2>

        @if ($errors->any())
            <div class="alert-danger">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/admin/siswa/update/{{ $siswa->id }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nomor Induk Siswa (NIS)</label>
                <input type="text" name="nis" value="{{ old('nis', $siswa->nis) }}" readonly>
                <div class="info-text">NIS tidak dapat diubah</div>
            </div>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama', $siswa->nama) }}" required>
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <input type="text" name="kelas" value="{{ old('kelas', $siswa->kelas) }}" required>
            </div>

            <div class="button-group">
                <a href="/admin/siswa" class="btn-cancel">Batal</a>
                <button type="submit">Update Data</button>
            </div>
        </form>
    </div>
</div>
@endsection