@extends('layouts.admin')

@section('content')
<style>
    .data-wrapper {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .header-section h2 {
        margin: 0;
        color: #0A3323;
        font-size: 24px;
    }

    /* Tombol Tambah */
    .btn-tambah {
        background: #105666; /* Midnight Green */
        color: white;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: bold;
        font-size: 14px;
        transition: 0.3s;
    }

    .btn-tambah:hover {
        background: #0A3323;
        transform: translateY(-2px);
    }

    /* Alert Sukses */
    .alert-success {
        background: #d4edda;
        color: #155724;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        border-left: 5px solid #28a745;
    }

    /* Styling Tabel */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    table th {
        background: #F7F4D5;
        color: #0A3323;
        text-align: left;
        padding: 15px;
        border-bottom: 2px solid #839958;
    }

    table td {
        padding: 15px;
        border-bottom: 1px solid #eee;
        color: #333;
    }

    table tr:hover {
        background-color: #f9f9f9;
    }

    /* Tombol Aksi */
    .btn-edit {
        color: #839958; /* Moss Green */
        text-decoration: none;
        font-weight: bold;
        margin-right: 10px;
    }

    .btn-delete {
        color: #D3968C; /* Rosy Brown */
        text-decoration: none;
        font-weight: bold;
    }

    .btn-edit:hover, .btn-delete:hover {
        text-decoration: underline;
    }
</style>

<div class="data-wrapper">
    <div class="header-section">
        <h2>Data Kategori</h2>
        <a href="/admin/kategori/create" class="btn-tambah">+ Tambah Kategori</a>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th width="50">No</th>
                <th>Nama Kategori</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategoris as $i => $k)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $k->ket_kategori }}</td>
                <td>
                    <a href="/admin/kategori/edit/{{ $k->id }}" class="btn-edit">Edit</a>
                    <span style="color: #ccc">|</span>
                    <a href="/admin/kategori/delete/{{ $k->id }}" 
                       class="btn-delete" 
                       onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection