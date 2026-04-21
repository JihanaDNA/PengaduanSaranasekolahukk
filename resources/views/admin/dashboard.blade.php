@extends('layouts.admin')

@section('content')
<style>
.dashboard-wrapper {
    background: #F7F4D5;
    padding: 30px;
    border-radius: 15px;
}

.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 12px;
    margin-bottom: 20px;
}

.card {
    background: #fff;
    padding: 10px 8px;
    border-radius: 8px;
    text-align: center;
    border: 1px solid #DEDAB4;
    transition: 0.2s;
}

.card:hover {
    transform: scale(1.05);
}

.card h3 { 
    font-size: 10px; 
    color: #839958; 
    margin-bottom: 5px;
}

.card p { 
    font-size: 32px;
    font-weight: 800;
    color: #0A3323;
    margin: 0;
}

.table-container {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    border: 1px solid #DEDAB4;
    font-size: 13px;
}

.badge {
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 11px;
}

.status-menunggu { background: #F8D7DA; }
.status-proses { background: #FFF3CD; }
.status-selesai { background: #D4EDDA; }

.btn-detail {
    background: #0A3323;
    color: white;
    padding: 5px 10px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 12px;
}

.btn-detail:hover {
    background: #839958;
}
</style>

<div class="dashboard-wrapper">

    <h2>Dashboard Admin</h2>

    {{-- CARD --}}
    <div class="cards">
        <div class="card">
            <h3>Total Siswa</h3>
            <p>{{ $totalSiswa }}</p>
        </div>

        <div class="card">
            <h3>Total Kategori</h3>
            <p>{{ $totalKategori }}</p>
        </div>

        <div class="card">
            <h3>Total Aspirasi</h3>
            <p>{{ $totalAspirasi }}</p>
        </div>

        <div class="card">
            <h3>Menunggu</h3>
            <p>{{ $aspirasiMenunggu }}</p>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="table-container">
        <h3>Laporan Terbaru</h3>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th> {{-- 🔥 Tambahan --}}
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($aspirasiTerbaru as $i => $item)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $item->siswa->nama ?? '-' }}</td>
                    <td>{{ $item->kategori->ket_kategori ?? '-' }}</td>
                    <td>{{ $item->lokasi }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($item->keterangan, 50) }}</td>

                    {{-- 🔥 TANGGAL --}}
                    <td>
                        {{ \Carbon\Carbon::parse($item->tanggal_aspirasi ?? $item->created_at)->format('d-m-Y') }}
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

                    <td>
                        <a href="/admin/riwayat-aspirasi" class="btn-detail">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" align="center">Belum ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection