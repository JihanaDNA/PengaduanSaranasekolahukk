@extends('layouts.admin')

@section('content')

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

@endsection