@extends('layouts.admin')

@section('content')
<style>
    /* Container utama untuk centering secara vertikal & horizontal */
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
        max-width: 700px; /* Lebar kotak yang lega */
    }

    .form-wrapper h2 {
        margin-top: 0;
        margin-bottom: 25px;
        color: #0A3323; /* Dark Green */
        font-size: 26px;
        text-align: center;
        border-bottom: 2px solid #F7F4D5;
        padding-bottom: 15px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
        color: #333;
        font-size: 16px;
    }

    input[type="text"] {
        width: 100%;
        padding: 15px;
        border: 1.5px solid #839958; /* Moss Green */
        border-radius: 10px;
        font-family: inherit;
        font-size: 16px;
        box-sizing: border-box;
        outline: none;
        transition: 0.3s;
        background-color: #fcfcfc;
    }

    input[type="text"]:focus {
        border-color: #105666; /* Midnight Green */
        background-color: #fff;
        box-shadow: 0 0 10px rgba(16, 86, 102, 0.1);
    }

    .button-group {
        display: flex;
        gap: 10px;
    }

    button[type="submit"] {
        flex: 2;
        background: #105666; /* Midnight Green */
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
        background: #0A3323; /* Dark Green */
        transform: translateY(-2px);
    }

    .btn-cancel {
        flex: 1;
        background: #D3968C; /* Rosy Brown */
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
</style>

<div class="center-container">
    <div class="form-wrapper">
        <h2>Edit Kategori</h2>

        <form method="POST" action="/admin/kategori/update/{{ $kategori->id }}">
            @csrf

            <div class="form-group">
                <label for="ket_kategori">Nama / Keterangan Kategori</label>
                <input 
                    type="text" 
                    id="ket_kategori" 
                    name="ket_kategori" 
                    value="{{ $kategori->ket_kategori }}" 
                    placeholder="Masukkan nama kategori" 
                    required
                >
            </div>

            <div class="button-group">
                <a href="/admin/kategori" class="btn-cancel">Batal</a>
                <button type="submit">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection