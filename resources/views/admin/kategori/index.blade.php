@extends('layouts.admin')

@section('content')

<h2>Data Kategori</h2>

<a href="/admin/kategori/create">+ Tambah Kategori</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Kategori</th>
        <th>Aksi</th>
    </tr>

    @foreach($kategoris as $i => $k)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $k->ket_kategori }}</td>
        <td>
            <a href="/admin/kategori/edit/{{ $k->id }}">Edit</a> |
            <a href="/admin/kategori/delete/{{ $k->id }}" onclick="return confirm('Yakin?')">Hapus</a>
        </td>
    </tr>
    @endforeach

</table>

@endsection