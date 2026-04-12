@extends('layouts.admin')

@section('content')
<style>
    .data-wrapper {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .data-wrapper h2 {
        margin-top: 0;
        margin-bottom: 25px;
        color: #0A3323;
        font-size: 24px;
        border-bottom: 2px solid #F7F4D5;
        padding-bottom: 15px;
    }

    /* Alert Sukses */
    .alert-success {
        background: #d4edda;
        color: #155724;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        border-left: 5px solid #839958;
        font-weight: bold;
    }

    /* Styling Tabel Bergaris */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        border: 1px solid #839958; /* Warna Moss Green */
    }

    table th {
        background: #F7F4D5; /* Beige */
        color: #0A3323;
        text-align: left;
        padding: 12px;
        border: 1px solid #839958;
        font-size: 14px;
    }

    table td {
        padding: 12px;
        border: 1px solid #839958;
        color: #333;
        font-size: 14px;
        vertical-align: middle;
    }

    table tr:nth-child(even) {
        background-color: #fcfcfc;
    }

    /* Styling Select Status */
    select {
        width: 100%;
        padding: 8px;
        border-radius: 6px;
        border: 1px solid #839958;
        cursor: pointer;
        outline: none;
        font-family: inherit;
        font-size: 13px;
        font-weight: bold;
    }

    select:focus {
        border-color: #105666;
    }

    .img-display {
        border-radius: 8px;
        border: 1px solid #839958;
        display: block;
        object-fit: cover;
    }
</style>

<div class="data-wrapper">
    <h2>Laporan Aspirasi</h2>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th width="40">No</th>
                <th>Nama Siswa</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Keterangan</th>
                <th width="120">Foto</th>
                <th width="160">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($aspirasis as $i => $a)
            <tr>
                <td align="center">{{ $i+1 }}</td>
                <td><strong>{{ $a->siswa->nama ?? '-' }}</strong></td>
                <td>{{ $a->kategori->ket_kategori ?? '-' }}</td>
                <td>{{ $a->lokasi }}</td>
                <td>{{ $a->keterangan }}</td>

                <td align="center">
                    @if($a->foto)
                        {{-- Foto tampil biasa tanpa link --}}
                        <img src="/photo/uploads/{{ $a->foto }}" width="80" height="80" class="img-display">
                    @else
                        <span style="color: #999; font-style: italic; font-size: 12px;">Tidak ada foto</span>
                    @endif
                </td>

                <td>
                    <form method="POST" action="/admin/riwayat-aspirasi/update-status/{{ $a->id }}">
                        @csrf
                        @php
                            $bgColor = '#f8d7da'; 
                            $textColor = '#721c24';
                            
                            if($a->status == 'Proses') {
                                $bgColor = '#fff3cd'; 
                                $textColor = '#856404';
                            } elseif($a->status == 'Selesai') {
                                $bgColor = '#d4edda'; 
                                $textColor = '#155724';
                            } elseif($a->status == 'Ditolak') {
                                $bgColor = '#ebebeb'; 
                                $textColor = '#333';
                            }
                        @endphp

                        <select name="status" onchange="this.form.submit()" 
                            style="background-color: {{ $bgColor }}; color: {{ $textColor }};">
                            <option value="Menunggu" {{ $a->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="Proses" {{ $a->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                            <option value="Selesai" {{ $a->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Ditolak" {{ $a->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" align="center" style="padding: 30px; color: #999;">Belum ada laporan aspirasi masuk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection