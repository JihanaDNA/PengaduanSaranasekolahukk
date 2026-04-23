@extends('layouts.siswa')

@section('content')
<style>
    .data-wrapper {
        background: white;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border: 1px solid #f0f0f0;
    }

    .data-wrapper h2 {
        margin-bottom: 25px;
        color: #0A3323;
        font-weight: 700;
    }

    .search-box {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 25px;
        background: #fcfcf7;
        padding: 15px;
        border-radius: 12px;
        border: 1px solid #eee;
    }

    .search-box input,
    .search-box select {
        padding: 10px 15px;
        border-radius: 8px;
        border: 1px solid #DEDAB4;
        outline: none;
    }

    .search-box input {
        flex: 1;
    }

    .btn-filter {
        background: #0A3323;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-reset {
        display: flex;
        align-items: center;
        color: #888;
        text-decoration: none;
        font-size: 14px;
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
        background: #F9F8EE;
        color: #0A3323;
        padding: 15px;
        text-align: left;
        font-size: 13px;
        text-transform: uppercase;
        border-bottom: 2px solid #839958;
    }

    table td {
        padding: 15px;
        border-bottom: 1px solid #f0f0f0;
        font-size: 14px;
        vertical-align: top;
    }

    .lokasi-text {
        font-weight: 600;
        color: #0A3323;
    }

    .keterangan-text {
        color: #555;
        line-height: 1.5;
        max-width: 250px;
        word-wrap: break-word;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-menunggu { background: #FFE5E5; color: #D32F2F; }
    .status-proses   { background: #FFF4E5; color: #ED6C02; }
    .status-selesai  { background: #E8F5E9; color: #2E7D32; }

    .img-thumbnail {
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #eee;
    }

    .empty-text {
        text-align: center;
        padding: 40px;
        color: #999;
    }
</style>

<div class="data-wrapper">
    <h2>Riwayat Aspirasi</h2>

    <form method="GET" action="/siswa/aspirasi" class="search-box">
        <input 
            type="text" 
            name="search" 
            placeholder="Cari..."
            value="{{ request('search') }}"
        >

        <select name="status">
            <option value="">Semua Status</option>
            <option value="Menunggu" {{ request('status')=='Menunggu' ? 'selected' : '' }}>Menunggu</option>
            <option value="Proses" {{ request('status')=='Proses' ? 'selected' : '' }}>Proses</option>
            <option value="Selesai" {{ request('status')=='Selesai' ? 'selected' : '' }}>Selesai</option>
        </select>

        <button type="submit" class="btn-filter">Filter</button>

        <a href="/siswa/aspirasi" class="btn-reset">Reset</a>
    </form>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th>Bukti</th>
                </tr>
            </thead>

            <tbody>
                @forelse($aspirasis as $a)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <strong>{{ $a->kategori->ket_kategori ?? '-' }}</strong>
                    </td>

                    <td>
                        <div class="lokasi-text">{{ $a->lokasi }}</div>
                    </td>

                    <td>
                        <div class="keterangan-text">{{ $a->keterangan }}</div>
                    </td>

                    <td>
                        @if($a->foto)
                            <img src="/photo/uploads/{{ $a->foto }}" width="60" height="60" class="img-thumbnail">
                        @else
                            <span style="color:#ccc;">-</span>
                        @endif
                    </td>

                    <td>
                        <span class="status-badge status-{{ strtolower($a->status) }}">
                            {{ $a->status }}
                        </span>
                    </td>

                    <td style="font-size:13px; color:#666;">
                        {{ $a->catatan_admin ?? '-' }}
                    </td>

                    <td>
                        @if($a->status == 'Selesai' && $a->foto_bukti)
                            <img src="/photo/bukti/{{ $a->foto_bukti }}" width="60" height="60" class="img-thumbnail">
                        @else
                            <span style="color:#ccc;">-</span>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="8" class="empty-text">
                        Belum ada data.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection