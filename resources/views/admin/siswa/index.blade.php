@extends('layouts.admin')

@section('content')

<style>
    .data-wrapper {
        background: white;
        padding: 35px;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.03);
        border: 1px solid #f0f0f0;
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
        font-size: 26px;
        font-weight: 700;
        position: relative;
    }

    .btn-tambah {
        background: #0A3323;
        color: white;
        text-decoration: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(10, 51, 35, 0.15);
    }

    .btn-tambah:hover {
        background: #144d36;
        transform: translateY(-2px);
    }

    /* Alert Style */
    .alert-success {
        background: #E8F5E9;
        color: #2E7D32;
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        border: 1px solid #C8E6C9;
        font-weight: 500;
    }

    .search-box {
        margin-bottom: 25px;
    }

    .search-box input {
        width: 100%;
        padding: 14px 20px;
        border: 1.5px solid #E0E0E0;
        border-radius: 12px;
        outline: none;
        transition: 0.3s;
        background: #fafafa;
        font-size: 14px;
    }

    .search-box input:focus {
        border-color: #839958;
        background: white;
        box-shadow: 0 0 0 4px rgba(131, 153, 88, 0.1);
    }

    .table-container {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    table th {
        background: #F9FBF2;
        color: #839958;
        padding: 18px;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 700;
        border-bottom: 2px solid #F1F1F1;
        text-align: left;
    }

    table td {
        padding: 15px 18px;
        border-bottom: 1px solid #F5F5F5;
        font-size: 14px;
        color: #444;
        vertical-align: middle;
    }

    table tr:hover td {
        background: #fafdfa;
    }

    .nis-text {
        font-family: 'Courier New', Courier, monospace;
        font-weight: 700;
        color: #0A3323;
        letter-spacing: 0.5px;
    }

    .badge-kelas {
        background: #F1F3F5;
        color: #495057;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        border: 1px solid #dee2e6;
    }

    .btn-action {
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 6px;
        transition: 0.2s;
    }

    .edit { color: #839958; background: #f1f5f0; margin-right: 5px; }
    .edit:hover { background: #839958; color: white; }

    .delete { color: #D32F2F; background: #fff0f0; }
    .delete:hover { background: #D32F2F; color: white; }
</style>

<div class="data-wrapper">

    <div class="header-section">
        <h2>Daftar Siswa</h2>
        <a href="/admin/siswa/create" class="btn-tambah">+ Tambah Siswa</a>
    </div>

    @if(session('success'))
        <div class="alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    <form method="GET" class="search-box">
        <input 
            type="text"
            name="search"
            placeholder="Cari NIS, Nama Lengkap, atau Kelas..."
            value="{{ request('search') }}"
        >
    </form>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th width="60" style="text-align: center;">No</th>
                    <th width="180">NIS</th>
                    <th>Nama Lengkap</th>
                    <th width="150">Kelas</th>
                    <th width="150" style="text-align: center;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($siswas as $i => $s)
                <tr>
                    <td align="center" style="color: #999;">{{ $i + 1 }}</td>
                    <td><span class="nis-text">{{ $s->nis }}</span></td>
                    <td><strong>{{ $s->nama }}</strong></td>
                    <td>
                        <span class="badge-kelas">{{ $s->kelas }}</span>
                    </td>
                    <td align="center">
                        <a href="/admin/siswa/edit/{{ $s->id }}" class="btn-action edit">Edit</a>
                        <a href="/admin/siswa/delete/{{ $s->id }}" 
                           class="btn-action delete" 
                           onclick="return confirm('Hapus data siswa ini?')">Hapus</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" align="center" style="padding: 50px; color: #999;">
                        Data siswa tidak ditemukan dalam sistem.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection