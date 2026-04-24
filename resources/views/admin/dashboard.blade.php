@extends('layouts.admin')

@section('content')

<style>
    /* Global Wrapper */
    .dashboard-wrapper {
        background: #fdfdf5; /* Cream yang lebih soft */
        padding: 30px;
        border-radius: 20px;
        font-family: 'Inter', 'Segoe UI', sans-serif;
    }

    .dashboard-wrapper h2 {
        color: #0A3323;
        font-weight: 700;
        margin-bottom: 25px;
    }

    /* Modern Cards Section */
    .cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .card {
        background: #fff;
        padding: 20px;
        border-radius: 16px;
        text-align: left; /* Rata kiri lebih profesional */
        border: 1px solid rgba(131, 153, 88, 0.1);
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(10, 51, 35, 0.08);
    }

    .card h3 {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #839958;
        margin-bottom: 10px;
    }

    .card p {
        font-size: 28px;
        font-weight: 700;
        color: #0A3323;
        margin: 0;
    }

    /* Filter & Search Bar */
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

    /* Table Design */
    .table-container {
        background: #fff;
        padding: 25px;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    .table-container h3 {
        font-size: 18px;
        color: #0A3323;
        margin-bottom: 20px;
        font-weight: 600;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    th {
        background: #f9fbf2;
        color: #839958;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        padding: 15px;
        border-bottom: 2px solid #f1f1f1;
    }

    td {
        padding: 15px;
        border-bottom: 1px solid #f8f8f8;
        font-size: 14px;
        color: #444;
    }

    tr:hover td { background: #fafdfa; }

    /* Badges Status */
    .badge {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
        display: inline-block;
    }

    .status-menunggu { background: #FFE5E5; color: #D32F2F; }
    .status-proses { background: #FFF4E5; color: #ED6C02; }
    .status-selesai { background: #E8F5E9; color: #2E7D32; }

    .btn-detail {
        background: #F1F3F5;
        color: #0A3323;
        padding: 8px 14px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-detail:hover {
        background: #0A3323;
        color: #fff;
    }
</style>

<div class="dashboard-wrapper">

    <h2>Dashboard Admin</h2>

    <div class="cards">
        <div class="card">
            <h3>Total Siswa</h3>
            <p>{{ number_format($totalSiswa) }}</p>
        </div>
        <div class="card">
            <h3>Kategori</h3>
            <p>{{ number_format($totalKategori) }}</p>
        </div>
        <div class="card">
            <h3>Total Aspirasi</h3>
            <p>{{ number_format($totalAspirasi) }}</p>
        </div>
        <div class="card" style="border-left: 4px solid #D32F2F;">
            <h3>Menunggu</h3>
            <p style="color: #D32F2F;">{{ number_format($aspirasiMenunggu) }}</p>
        </div>
    </div>

    {{-- FILTER + SEARCH --}}
    <form method="GET" action="" class="filter-wrapper">
        <input 
            type="text"
            name="search"
            placeholder="Cari nama, kategori, atau lokasi..."
            value="{{ request('search') }}"
        >

        <select name="status">
            <option value="">Semua Status</option>
            <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
            <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
        </select>

        <button type="submit" class="btn-filter">Cari Data</button>
    </form>

    {{-- TABLE --}}
    <div class="table-container">
        <h3>Laporan Aspirasi Terbaru</h3>

        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Siswa</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Ringkasan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($aspirasiTerbaru as $i => $item)
                    <tr>
                        <td style="color: #999;">{{ $i+1 }}</td>
                        <td><strong>{{ $item->siswa->nama ?? '-' }}</strong></td>
                        <td><span style="color: #839958;">{{ $item->kategori->ket_kategori ?? '-' }}</span></td>
                        <td>{{ $item->lokasi }}</td>
                        <td title="{{ $item->keterangan }}">
                            {{ \Illuminate\Support\Str::limit($item->keterangan, 40) }}
                        </td>
                        <td>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small>
                        </td>
                        <td>
                            <span class="badge 
                                @if($item->status == 'Menunggu') status-menunggu
                                @elseif($item->status == 'Selesai') status-selesai
                                @else status-proses
                                @endif">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <a href="/admin/riwayat-aspirasi" class="btn-detail">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" align="center" style="padding: 40px; color: #999;">
                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="50" style="opacity: 0.3; display: block; margin: 0 auto 10px;">
                            Belum ada data aspirasi yang masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection