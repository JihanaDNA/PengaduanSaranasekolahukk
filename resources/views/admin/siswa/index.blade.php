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
        border-bottom: 2px solid #F7F4D5;
        padding-bottom: 15px;
    }

    .header-section h2 {
        margin: 0;
        color: #0A3323;
        font-size: 24px;
    }

    .btn-tambah {
        background: #105666;
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

    .alert-success {
        background: #d4edda;
        color: #155724;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        border-left: 5px solid #839958;
        font-weight: bold;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        border: 1px solid #839958;
    }

    table th {
        background: #F7F4D5;
        color: #0A3323;
        text-align: left;
        padding: 15px;
        border: 1px solid #839958;
        font-size: 15px;
    }

    table td {
        padding: 12px 15px;
        border: 1px solid #839958;
        color: #333;
        font-size: 14px;
    }

    table tr:nth-child(even) {
        background-color: #fcfcfc;
    }

    table tr:hover {
        background-color: #f5f5f5;
    }

    .badge-kelas {
        background: #839958;
        color: white;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
    }
</style>

<div class="data-wrapper">
    <div class="header-section">
        <h2>Daftar Siswa</h2>
        <a href="/admin/siswa/create" class="btn-tambah">+ Tambah Siswa</a>
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
                <th width="150">NIS</th>
                <th>Nama Lengkap</th>
                <th width="150">Kelas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($siswas as $i => $s)
            <tr>
                <td align="center">{{ $i + 1 }}</td>
                <td style="font-family: monospace; font-size: 15px; color: #105666;"><strong>{{ $s->nis }}</strong></td>
                <td>{{ $s->nama }}</td>
                <td>
                    <span class="badge-kelas">{{ $s->kelas }}</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" align="center" style="padding: 30px; color: #999; font-style: italic;">
                    Belum ada data siswa terdaftar.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection