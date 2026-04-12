@extends('layouts.siswa')

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

    /* Styling Tabel Bergaris */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        border: 1px solid #839958; /* Moss Green */
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

    /* Badge Status */
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        display: inline-block;
    }

    .status-menunggu { background: #f8d7da; color: #721c24; }
    .status-proses { background: #fff3cd; color: #856404; }
    .status-selesai { background: #d4edda; color: #155724; }
    .status-ditolak { background: #ebebeb; color: #333; }

    .img-thumbnail {
        border-radius: 8px;
        border: 1px solid #839958;
        object-fit: cover;
    }
</style>

<div class="data-wrapper">
    <h2>Riwayat Aspirasi Saya</h2>

    <table>
        <thead>
            <tr>
                <th width="40">No</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Keterangan</th>
                <th width="120">Foto</th>
                <th width="130">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($aspirasis as $i => $a)
            <tr>
                <td align="center">{{ $i+1 }}</td>
                <td><strong>{{ $a->kategori->ket_kategori ?? '-' }}</strong></td>
                <td>{{ $a->lokasi }}</td>
                <td>{{ $a->keterangan }}</td>

                <td align="center">
                    @if($a->foto)
                        <img src="/photo/uploads/{{ $a->foto }}" width="80" height="80" class="img-thumbnail">
                    @else
                        <span style="color: #999; font-style: italic; font-size: 12px;">Tidak ada foto</span>
                    @endif
                </td>

                <td align="center">
                    @if($a->status == 'Menunggu')
                        <span class="status-badge status-menunggu">Menunggu</span>
                    @elseif($a->status == 'Proses')
                        <span class="status-badge status-proses">Proses</span>
                    @elseif($a->status == 'Selesai')
                        <span class="status-badge status-selesai">Selesai</span>
                    @else
                        <span class="status-badge status-ditolak">Ditolak</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" align="center" style="padding: 30px; color: #999;">Kamu belum pernah mengirim aspirasi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection