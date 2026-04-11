@extends('layouts.admin')

@section('content')

<h2>Daftar Siswa</h2>

<!-- NOTIFIKASI -->
@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<!-- TOMBOL TAMBAH -->
<a href="/admin/siswa/create" style="
    display:inline-block;
    margin-bottom:15px;
    padding:8px 12px;
    background:#3498db;
    color:white;
    text-decoration:none;
    border-radius:5px;
">
    + Tambah Siswa
</a>

<!-- TABEL -->
<table border="1" cellpadding="10" cellspacing="0" width="100%" style="background:white; border-radius:8px; overflow:hidden;">
    <tr style="background:#2c3e50; color:white;">
        <th>No</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>Kelas</th>
    </tr>

    @forelse($siswas as $i => $s)
    <tr>
        <td>{{ $i + 1 }}</td>
        <td>{{ $s->nis }}</td>
        <td>{{ $s->nama }}</td>
        <td>{{ $s->kelas }}</td>
    </tr>
    @empty
    <tr>
        <td colspan="4" style="text-align:center;">Belum ada data siswa</td>
    </tr>
    @endforelse

</table>

@endsection