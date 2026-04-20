@extends('layouts.admin')

@section('content')
<style>
    .dashboard-wrapper {
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        background: #F7F4D5;
        padding: 35px;
        border-radius: 15px;
    }

    .dashboard-header h2 { margin: 0; font-size: 26px; font-weight: 700; color: #0A3323; }
    .dashboard-header p { color: #839958; margin-bottom: 30px; font-size: 15px; margin-top: 5px; }

    .cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 40px;
    }

    .card {
        background: #ffffff; 
        padding: 25px 15px;
        border-radius: 12px;
        text-align: center;
        border: 1px solid #DEDAB4;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }

    .card h3 { margin: 0; font-size: 12px; text-transform: uppercase; color: #839958; font-weight: 600; }
    .card p { font-size: 36px; margin: 12px 0 0; font-weight: 700; color: #0A3323; }

    .table-container {
        background: #ffffff;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #DEDAB4;
        overflow-x: auto;
    }

    table { width: 100%; border-collapse: collapse; }
    th { background-color: #F7F4D5; color: #0A3323; text-align: left; padding: 15px; border: 1px solid #DEDAB4; font-size: 14px; }
    td { padding: 15px; border: 1px solid #DEDAB4; vertical-align: middle; color: #333; font-size: 14px; }

    .link-detail { color: #0A3323; text-decoration: none; font-weight: bold; }
    .link-detail:hover { color: #839958; text-decoration: underline; }

    .badge {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: bold;
        font-size: 12px;
        display: inline-block;
    }
    .status-menunggu { background-color: #F8D7DA; color: #721C24; }
    .status-selesai { background-color: #D4EDDA; color: #155724; }
    .status-proses { background-color: #FFF3CD; color: #856404; }

    @media (max-width: 1024px) { .cards { grid-template-columns: repeat(2, 1fr); } }
</style>

<div class="dashboard-wrapper">
    <div class="dashboard-header">
        <h2>Dashboard Admin</h2>
        <p>Selamat datang di sistem pengaduan siswa 👋</p>
    </div>

    <div class="cards">
        <div class="card"><h3>Total Siswa</h3><p>{{ $totalSiswa }}</p></div>
        <div class="card"><h3>Total Kategori</h3><p>{{ $totalKategori }}</p></div>
        <div class="card"><h3>Total Aspirasi</h3><p>{{ $totalAspirasi }}</p></div>
        <div class="card"><h3>Menunggu</h3><p>{{ $aspirasiMenunggu }}</p></div>
    </div>

    <div class="table-container">
        <h3 style="color: #0A3323; margin-bottom: 15px;">Laporan Terbaru</h3>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($aspirasiTerbaru as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->siswa->nama ?? 'Siswa' }}</td>
                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->lokasi }}</td>
                    <td>{{ Str::limit($item->laporan, 60) }}</td>
                    <td>
                        <span class="badge {{ $item->status == 'Menunggu' ? 'status-menunggu' : ($item->status == 'Selesai' ? 'status-selesai' : 'status-proses') }}">
                            {{ $item->status }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection