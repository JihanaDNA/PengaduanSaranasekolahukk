@extends('layouts.admin')

@section('content')

<h2>Edit Kategori</h2>

<form method="POST" action="/admin/kategori/update/{{ $kategori->id }}">
    @csrf

    <input type="text" name="ket_kategori" value="{{ $kategori->ket_kategori }}">

    <br><br>

    <button type="submit">Update</button>
</form>

@endsection