@extends('layouts.admin')

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
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* 🔥 FILTER BOX */
    .filter-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 25px;
        background: #fcfcf7;
        padding: 15px;
        border-radius: 12px;
        border: 1px solid #eee;
        align-items: center;
    }

    .filter-wrapper input,
    .filter-wrapper select {
        padding: 10px 15px;
        border: 1.5px solid #DEDAB4;
        border-radius: 10px;
        outline: none;
        font-size: 14px;
        transition: 0.3s;
    }

    .filter-wrapper input:focus, 
    .filter-wrapper select:focus {
        border-color: #839958;
        background: #fff;
    }

    .filter-wrapper input { flex: 1; min-width: 250px; }

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

    .table-container {
        overflow-x: auto;
        border-radius: 12px;
        border: 1px solid #eee;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 1100px; 
    }

    th {
        background: #F9F8EE;
        color: #0A3323;
        padding: 15px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
        border-bottom: 2px solid #839958;
        position: sticky;
        top: 0;
    }

    td {
        padding: 15px;
        border-bottom: 1px solid #f0f0f0;
        font-size: 14px;
        vertical-align: middle;
        color: #444;
    }

    tr:hover td {
        background: #fafdfa;
    }

    .img-preview {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #eee;
        transition: 0.3s;
    }

    .img-preview:hover {
        transform: scale(1.2);
        cursor: zoom-in;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
        display: inline-block;
        text-align: center;
        min-width: 80px;
    }

    .menunggu { background: #FFE5E5; color: #D32F2F; }
    .proses { background: #FFF4E5; color: #ED6C02; }
    .selesai { background: #E8F5E9; color: #2E7D32; }

    .btn-detail {
        background: #f1f5f0;
        color: #0A3323;
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-detail:hover {
        background: #0A3323;
        color: white;
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
            <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
            <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
        </select>

        <button type="submit" class="btn-filter">Terapkan Filter</button>
        <a href="/admin/riwayat-aspirasi" style="color: #888; text-decoration: none; font-size: 13px;">Reset</a>
    </form>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Nama Siswa</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th width="200">Keterangan</th>
                    <th>Tanggal</th>
                    <th>Foto</th>
                    <th>Bukti</th>
                    <th>Status</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($aspirasis as $i => $a)
                <tr>
                    <td align="center" style="color: #999;">{{ $i+1 }}</td>
                    <td><strong>{{ $a->siswa->nama ?? '-' }}</strong></td>
                    <td><span style="color: #839958; font-weight: 600;">{{ $a->kategori->ket_kategori ?? '-' }}</span></td>
                    <td>{{ $a->lokasi }}</td>
                    <td title="{{ $a->keterangan }}">
                        {{ \Illuminate\Support\Str::limit($a->keterangan, 40) }}
                    </td>

                    <td>
                        <span style="font-size: 12px; color: #666;">
                            {{ \Carbon\Carbon::parse($a->tanggal_aspirasi)->format('d M Y') }}
                        </span>
                    </td>

                    <td>
                        @if($a->foto)
                            <img src="/photo/uploads/{{ $a->foto }}" class="img-preview">
                        @else
                            <span style="color: #ccc;">-</span>
                        @endif
                    </td>

                    <td>
                        @if($a->status == 'Selesai' && $a->foto_bukti)
                            <img src="/photo/bukti/{{ $a->foto_bukti }}" class="img-preview">
                        @else
                            <span style="color: #ccc;">-</span>
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
                    <td colspan="10" align="center" style="padding: 50px; color: #999;">
                        Tidak ada data aspirasi ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection