@extends('layouts.admin')

@section('content')

<h2>Tambah Kategori</h2>

<form method="POST" action="/admin/kategori/store">
    @csrf

    <input type="text" name="ket_kategori" placeholder="Nama Kategori">

    <br><br>

    <button type="submit">Simpan</button>
</form>

@endsection