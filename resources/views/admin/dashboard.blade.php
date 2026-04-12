@extends('layouts.admin')

@section('content')
<style>
    .dashboard-wrapper {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .dashboard-wrapper h2 {
        margin-top: 0;
        font-size: 24px;
        color: #0A3323;
    }

    .dashboard-wrapper p {
        color: #666;
        margin-bottom: 25px;
    }

    /* Grid Kartu Statistik */
    .cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
    }

    .card {
        padding: 20px;
        border-radius: 12px;
        color: #F7F4D5; /* Warna teks beige */
        text-align: center;
    }

    .card h3 {
        margin: 0;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        opacity: 0.9;
    }

    .card p {
        font-size: 40px;
        margin: 10px 0 0 0;
        font-weight: bold;
    }

    /* Warna sesuai foto palet yang kamu kasih */
    .blue { background: #105666; }   /* Midnight Green */
    .green { background: #839958; }  /* Moss Green */
    .orange { background: #D3968C; } /* Rosy Brown */
    .red { background: #0A3323; }    /* Dark Green */

    @media (max-width: 768px) {
        .cards { grid-template-columns: repeat(2, 1fr); }
    }
</style>

<div class="dashboard-wrapper">
    <h2>Dashboard Admin</h2>
    <p>Selamat datang di sistem pengaduan siswa 👋</p>

    <div class="cards">
        <div class="card blue">
            <h3>Total Siswa</h3>
            <p>{{ $totalSiswa }}</p>
        </div>

        <div class="card green">
            <h3>Total Kategori</h3>
            <p>{{ $totalKategori }}</p>
        </div>

        <div class="card orange">
            <h3>Total Aspirasi</h3>
            <p>{{ $totalAspirasi }}</p>
        </div>

        <div class="card red">
            <h3>Menunggu</h3>
            <p>{{ $aspirasiMenunggu }}</p>
        </div>
    </div>
</div>
@endsection