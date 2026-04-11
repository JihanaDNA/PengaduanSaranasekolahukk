@extends('layouts.admin')

@section('content')

<h2>Riwayat Aspirasi</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10" width="100%" style="background:white;">
    <tr style="background:#2c3e50; color:white;">
        <th>No</th>
        <th>Nama Siswa</th>
        <th>Kategori</th>
        <th>Lokasi</th>
        <th>Keterangan</th>
        <th>Foto</th>
        <th>Status</th>
    </tr>

    @forelse($aspirasis as $i => $a)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $a->siswa->nama ?? '-' }}</td>
        <td>{{ $a->kategori->ket_kategori ?? '-' }}</td>
        <td>{{ $a->lokasi }}</td>
        <td>{{ $a->keterangan }}</td>

        <!-- FOTO -->
        <td>
            @if($a->foto)
                <img src="/photo/uploads/{{ $a->foto }}" width="100" style="border-radius:8px;">
            @else
                Tidak ada foto
            @endif
        </td>

        <!-- STATUS (SUDAH BISA DIUBAH) -->
        <td>
            <form method="POST" action="/admin/riwayat-aspirasi/update-status/{{ $a->id }}">
                @csrf

                <select name="status" onchange="this.form.submit()">
                    <option value="Menunggu" {{ $a->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="Proses" {{ $a->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                    <option value="Selesai" {{ $a->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="7" align="center">Belum ada aspirasi</td>
    </tr>
    @endforelse

</table>

@endsection