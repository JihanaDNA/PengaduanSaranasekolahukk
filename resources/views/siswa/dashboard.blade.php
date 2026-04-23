@extends('layouts.siswa')

@section('content')
<style>
    .dashboard-siswa-wrapper {
        font-family: 'Inter', 'Segoe UI', Roboto, sans-serif;
        background: #FDFCF0;
        padding: 30px;
        border-radius: 20px;
        color: #333;
    }

    .welcome-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .welcome-header h2 {
        color: #0A3323;
        font-size: 28px;
        font-weight: 700;
        margin: 0;
    }

    .welcome-header p {
        color: #6B7C46;
        margin: 5px 0 0 0;
    }

    /* Statistics Cards */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .box-stat {
        background: white;
        padding: 25px;
        border-radius: 16px;
        text-align: center;
        border: 1px solid rgba(131, 153, 88, 0.1);
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        transition: transform 0.3s ease;
    }

    .box-stat:hover {
        transform: translateY(-5px);
    }

    .box-stat h3 {
        margin: 0;
        font-size: 36px;
        color: #0A3323;
        font-weight: 800;
    }

    .box-stat p {
        margin-top: 8px;
        font-size: 13px;
        font-weight: 600;
        color: #839958;
        letter-spacing: 1px;
    }

    /* Search & Action Bar */
    .action-bar {
        display: flex;
        gap: 15px;
        margin-bottom: 25px;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-input {
        flex: 1;
        min-width: 250px;
        padding: 12px 20px;
        border-radius: 10px;
        border: 1px solid #DEDAB4;
        outline: none;
        transition: 0.3s;
    }

    .search-input:focus {
        border-color: #0A3323;
        box-shadow: 0 0 0 3px rgba(10, 51, 35, 0.1);
    }

    .btn-custom {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 24px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        transition: 0.3s;
        border: none;
        cursor: pointer;
    }

    .btn-primary-custom {
        background: #0A3323;
        color: white;
    }

    .btn-primary-custom:hover {
        background: #144d36;
        box-shadow: 0 4px 12px rgba(10, 51, 35, 0.2);
    }

    .info-card {
        background: white;
        padding: 30px;
        border-radius: 16px;
        margin-top: 25px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    }

    .info-card h3 {
        margin-bottom: 20px;
        color: #0A3323;
        font-size: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-bottom: 20px;
    }

    table th {
        background: #F9F8EE;
        color: #0A3323;
        text-align: left;
        padding: 15px;
        font-weight: 600;
        border-bottom: 2px solid #839958;
    }

    table td {
        padding: 15px;
        border-bottom: 1px solid #F0EFE0;
        vertical-align: middle;
        font-size: 14px;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    .status-menunggu { background: #FFE5E5; color: #D32F2F; }
    .status-proses { background: #FFF4E5; color: #ED6C02; }
    .status-selesai { background: #E8F5E9; color: #2E7D32; }

    .img-thumb {
        border-radius: 8px;
        object-fit: cover;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
</style>

<div class="dashboard-siswa-wrapper">

    <div class="welcome-header">
        <div>
            <h2>Dashboard Siswa</h2>
            <p>Selamat datang kembali, <strong>{{ $siswa->nama }}</strong></p>
        </div>
        <a href="/siswa/aspirasi/create" class="btn-custom btn-primary-custom">
            + Buat Aspirasi
        </a>
    </div>

    <div class="stats-container">
        <div class="box-stat">
            <h3>{{ $total }}</h3>
            <p>TOTAL ASPIRASI</p>
        </div>
        <div class="box-stat">
            <h3>{{ $menunggu }}</h3>
            <p>MENUNGGU</p>
        </div>
        <div class="box-stat">
            <h3>{{ $selesai }}</h3>
            <p>DISELESAIKAN</p>
        </div>
    </div>

    <form method="GET" action="/siswa/dashboard" class="action-bar">
        <input type="text" name="search" class="search-input" 
               placeholder="Cari berdasarkan lokasi atau keterangan..." 
               value="{{ request('search') }}">
        <button type="submit" class="btn-custom btn-primary-custom">Cari Data</button>
    </form>

    <div class="info-card">
        <h3>Riwayat Aspirasi Terbaru</h3>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Kategori</th>
                        <th>Lokasi Kejadian</th>
                        <th>Status</th>
                        <th>Bukti Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aspirasis as $i => $a)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $a->kategori->ket_kategori ?? '-' }}</strong></td>
                        <td>{{ $a->lokasi }}</td>
                        <td>
                            @if($a->status == 'Menunggu')
                                <span class="status-badge status-menunggu">Menunggu</span>
                            @elseif($a->status == 'Proses')
                                <span class="status-badge status-proses">Proses</span>
                            @else
                                <span class="status-badge status-selesai">Selesai</span>
                            @endif
                        </td>
                        <td>
                            @if($a->status == 'Selesai' && $a->foto_bukti)
                                <img src="/photo/bukti/{{ $a->foto_bukti }}" width="45" height="45" class="img-thumb">
                            @else
                                <span style="color: #ccc;">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px; color: #999;">
                            Belum ada aspirasi yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="text-align: right; margin-top: 15px;">
            <a href="/siswa/aspirasi" style="color: #839958; font-weight: 600; text-decoration: none;">
                Lihat Semua Riwayat →
            </a>
        </div>
    </div>
</div>
@endsection