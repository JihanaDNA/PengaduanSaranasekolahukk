@extends('layouts.siswa')

@section('content')

<h2>Riwayat Aspirasi Saya</h2>

<table border="1" cellpadding="10" width="100%" style="background:white;">
    <tr style="background:#16a085; color:white;">
        <th>No</th>
        <th>Kategori</th>
        <th>Lokasi</th>
        <th>Keterangan</th>
        <th>Foto</th>
        <th>Status</th>
    </tr>

    @forelse($aspirasis as $i => $a)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $a->kategori->ket_kategori ?? '-' }}</td>
        <td>{{ $a->lokasi }}</td>
        <td>{{ $a->keterangan }}</td>

        <!-- FOTO -->
        <td>
            @if($a->foto)
                <img src="/photo/uploads/{{ $a->foto }}" width="100">
            @else
                Tidak ada foto
            @endif
        </td>

        <!-- STATUS -->
        <td>
            @if($a->status == 'Menunggu')
                <span style="color:orange;">Menunggu</span>
            @elseif($a->status == 'Proses')
                <span style="color:blue;">Proses</span>
            @else
                <span style="color:green;">Selesai</span>
            @endif
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6" align="center">Belum ada aspirasi</td>
    </tr>
    @endforelse

</table>

@endsection