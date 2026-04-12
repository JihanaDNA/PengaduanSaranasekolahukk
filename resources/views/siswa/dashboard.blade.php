@extends('layouts.siswa')

@section('content')
<style>
    /* Section Welcome */
    .welcome-header {
        margin-bottom: 30px;
    }
    .welcome-header h2 {
        color: #0A3323;
        margin: 0;
    }

    /* GRID KOTAK STATISTIK - Persis Admin */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .box-stat {
        padding: 25px;
        border-radius: 12px;
        color: white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .box-stat h3 {
        margin: 0;
        font-size: 35px;
    }

    .box-stat p {
        margin: 5px 0 0;
        font-weight: bold;
        font-size: 14px;
        opacity: 0.9;
    }

    /* Warna Kotak Sesuai Tema Admin */
    .bg-dark-green { background: #0A3323; } /* Total */
    .bg-moss-green { background: #839958; } /* Selesai */
    .bg-rosy-brown { background: #D3968C; } /* Menunggu */

    /* Card Info Bawah */
    .info-card {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border-left: 8px solid #105666;
    }

    .btn-action {
        display: inline-block;
        background: #105666;
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        margin-top: 15px;
    }
</style>

{{-- Ambil data langsung agar tidak error --}}
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
    <div class="box-stat bg-dark-green">
        <h3>{{ $total }}</h3>
        <p>TOTAL ASPIRASI</p>
    </div>

    <div class="box-stat bg-rosy-brown">
        <h3>{{ $menunggu }}</h3>
        <p>MENUNGGU</p>
    </div>

    <div class="box-stat bg-moss-green">
        <h3>{{ $selesai }}</h3>
        <p>SELESAI</p>
    </div>
</div>

<div class="info-card">
    <h3 style="margin-top:0; color:#105666;">Ada Aspirasi Baru?</h3>
    <p style="color:#666;">Sampaikan keluhan atau saranmu mengenai fasilitas sekolah agar segera ditindaklanjuti oleh petugas.</p>
    <a href="/siswa/aspirasi/create" class="btn-action">+ Buat Laporan Baru</a>
</div>

@endsection