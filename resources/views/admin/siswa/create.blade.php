@extends('layouts.admin')

@section('content')

<h2>Tambah Siswa</h2>

@if ($errors->any())
    <div style="color:red">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="/admin/siswa/store">
    @csrf

    <input type="text" name="nis" placeholder="NIS" required>
    <br><br>

    <input type="text" name="nama" placeholder="Nama" required>
    <br><br>

    <input type="text" name="kelas" placeholder="Kelas (contoh: XII RPL)" required>
    <br><br>

    <button type="submit">Simpan</button>

</form>

@endsection