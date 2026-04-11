@extends('layouts.siswa')

@section('content')

<h2>Dashboard Siswa</h2>
<p>Selamat datang, <b>{{ $siswa->nama }}</b> 👋</p>

<div class="card">
    <h3>Halo Siswa!</h3>
    <p>Silakan input aspirasi kamu atau cek riwayat laporan.</p>
</div>

@endsection