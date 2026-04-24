@extends('layouts.admin')

@section('content')

<style>
    .filter-wrapper {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
        background: #fff;
        padding: 15px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    }

    .filter-wrapper input,
    .filter-wrapper select {
        padding: 10px 15px;
        border: 1.5px solid #eee;
        border-radius: 10px;
        outline: none;
        transition: 0.3s;
        font-size: 14px;
    }

    .filter-wrapper input:focus,
    .filter-wrapper select:focus {
        border-color: #839958;
    }

    .filter-wrapper input { flex: 2; }
    .filter-wrapper select { flex: 1; }

    .btn-filter {
        background: #0A3323;
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-filter:hover { background: #144d36; }


    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1200px;
    }

    th {
        background: #F9F8EE;
        padding: 12px;
        border-bottom: 2px solid #839958;
    }

    td {
        padding: 12px;
        border-bottom: 1px solid #eee;
    }

    .img-preview {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
    }

    .status-badge {
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: bold;
    }

    .menunggu { background: #FFE5E5; color: #D32F2F; }
    .proses { background: #FFF4E5; color: #ED6C02; }
    .selesai { background: #E8F5E9; color: #2E7D32; }

    .btn-detail {
        background: #0A3323;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
    }
</style>

<div class="data-wrapper">

<h2>Laporan Aspirasi</h2>

<form method="GET" class="filter-wrapper">
    <input 
        type="text"
        name="search"
        placeholder="Cari nama siswa, kategori, atau lokasi..."
        value="{{ request('search') }}"
    >

    <select name="status">
        <option value="">Semua Status</option>
        <option value="Menunggu" {{ request('status')=='Menunggu'?'selected':'' }}>Menunggu</option>
        <option value="Proses" {{ request('status')=='Proses'?'selected':'' }}>Proses</option>
        <option value="Selesai" {{ request('status')=='Selesai'?'selected':'' }}>Selesai</option>
    </select>

    <button class="btn-filter">Filter</button>
</form>

<div class="table-container">
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Keterangan</th>
            <th>Catatan Admin</th> 
            <th>Tanggal</th>
            <th>Foto</th>
            <th>Bukti</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

<tbody>
@forelse($aspirasis as $i => $a)
<tr>
    <td>{{ $i+1 }}</td>
    <td>{{ $a->siswa->nama ?? '-' }}</td>
    <td>{{ $a->kategori->ket_kategori ?? '-' }}</td>
    <td>{{ $a->lokasi }}</td>

    <td title="{{ $a->keterangan }}">
        {{ \Illuminate\Support\Str::limit($a->keterangan, 40) }}
    </td>

    <td title="{{ $a->catatan_admin }}">
        @if($a->catatan_admin)
            {{ \Illuminate\Support\Str::limit($a->catatan_admin, 40) }}
        @else
            <span style="color:#ccc;">-</span>
        @endif
    </td>

    <td>
        {{ \Carbon\Carbon::parse($a->tanggal_aspirasi)->format('d M Y') }}
    </td>

    <td>
        @if($a->foto)
            <img src="/photo/uploads/{{ $a->foto }}" class="img-preview">
        @else
            -
        @endif
    </td>

    <td>
        @if($a->status=='Selesai' && $a->foto_bukti)
            <img src="/photo/bukti/{{ $a->foto_bukti }}" class="img-preview">
        @else
            -
        @endif
    </td>

    <td>
        @php $class = strtolower($a->status); @endphp
        <span class="status-badge {{ $class }}">
            {{ $a->status }}
        </span>
    </td>

    <td>
        <a href="/admin/riwayat-aspirasi/{{ $a->id }}" class="btn-detail">
            Detail
        </a>
    </td>
</tr>

@empty
<tr>
    <td colspan="11" align="center">
        Tidak ada data aspirasi
    </td>
</tr>
@endforelse
</tbody>

</table>
</div>

</div>

@endsection