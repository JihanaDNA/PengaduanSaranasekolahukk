@extends('layouts.siswa')

@section('content')

<h2>Input Aspirasi</h2>

@if ($errors->any())
    <div style="color:red">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="/siswa/aspirasi/store" enctype="multipart/form-data">
    @csrf

    <!-- KATEGORI -->
    <label>Kategori</label>
    <select name="kategori_id" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategoris as $k)
            <option value="{{ $k->id }}">{{ $k->ket_kategori }}</option>
        @endforeach
    </select>

    <br><br>

    <!-- LOKASI -->
    <label>Lokasi</label>
    <input type="text" name="lokasi" placeholder="Contoh: Toilet lantai 2" required>

    <br><br>

    <!-- KETERANGAN -->
    <label>Keterangan</label>
    <textarea name="keterangan" rows="4" placeholder="Jelaskan masalah..." required></textarea>

    <br><br>

    <label>Upload Foto (Opsional)</label>
    <input type="file" name="foto">

    <br><br>

    <button type="submit">Kirim Aspirasi</button>

</form>

@endsection