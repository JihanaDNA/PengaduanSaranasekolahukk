@extends('layouts.siswa')

@section('content')
<style>
    .dashboard-siswa-wrapper {
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        background: #F7F4D5;
        padding: 35px;
        border-radius: 15px;
    }

    /* Section Welcome */
    .welcome-header {
        margin-bottom: 30px;
    }
    
    .welcome-header h2 {
        color: #0A3323;
        margin: 0;
        font-weight: 700;
        font-size: 26px;
    }

    .welcome-header p {
        color: #839958;
        margin-top: 5px;
        font-size: 15px;
    }

    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .box-stat {
        background: #ffffff; 
        padding: 25px;
        border-radius: 12px;
        text-align: center;
        border: 1px solid #DEDAB4;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }

    .box-stat h3 {
        margin: 0;
        font-size: 36px;
        font-weight: 700;
        color: #0A3323;
    }

    .box-stat p {
        margin: 10px 0 0;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #839958;
    }

    .info-card {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border-left: 8px solid #839958;
    }

    .btn-action {
        display: inline-block;
        background: #0A3323;
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        margin-top: 15px;
    }

    .bg-dark-green, .bg-moss-green, .bg-rosy-brown { background: #ffffff; }

    @media (max-width: 500px) {
        .dashboard-siswa-wrapper { padding: 20px; }
    }
</style>

<div class="dashboard-siswa-wrapper">
    {{-- Ambil data langsung --}}
    @php
        $id_siswa = session('siswa_id');
        $total = \App\Models\Aspirasi::where('siswa_id', $id_siswa)->count();
        $menunggu = \App\Models\Aspirasi::where('siswa_id', $id_siswa)->where('status', 'Menunggu')->count();
        $selesai = \App\Models\Aspirasi::where('siswa_id', $id_siswa)->where('status', 'Selesai')->count();
    @endphp

    <div class="welcome-header">
        <h2>Dashboard Siswa</h2>
        <p>Halo, <b>{{ $siswa->nama }}</b>. Berikut ringkasan laporanmu.</p>
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
            <p>SELESAI</p>
        </div>
    </div>

    <div class="info-card">
        <h3 style="margin-top:0; color:#0A3323;">Ada Aspirasi Baru?</h3>
        <p style="color:#666;">Sampaikan keluhan atau saranmu mengenai fasilitas sekolah agar segera ditindaklanjuti oleh petugas.</p>
        <a href="/siswa/aspirasi/create" class="btn-action">+ Buat Laporan Baru</a>
    </div>
</div>

@endsection