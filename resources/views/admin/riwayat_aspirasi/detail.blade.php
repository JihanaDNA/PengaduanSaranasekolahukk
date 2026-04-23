@extends('layouts.admin')

@section('content')
<style>
    .data-wrapper {
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        max-width: 900px;
        margin: 20px auto;
        border: 1px solid #f0f0f0;
    }

    .data-wrapper h2 {
        margin-top: 0;
        margin-bottom: 30px;
        color: #0A3323;
        font-size: 26px;
        font-weight: 700;
        border-bottom: 3px solid #F7F4D5;
        padding-bottom: 15px;
    }

    /* Grid Layout untuk info laporan */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 30px;
    }

    .detail-item label {
        font-weight: 700;
        color: #839958;
        display: block;
        margin-bottom: 8px;
        font-size: 13px;
        text-transform: uppercase;
    }

    .detail-box {
        background: #f9fbf2;
        border: 1px solid #e0e6d6;
        padding: 12px 16px;
        border-radius: 10px;
        color: #333;
        font-size: 15px;
        min-height: 20px;
    }

    /* Khusus Keterangan yang panjang */
    .full-width {
        grid-column: span 2;
    }

    .admin-action-section {
        background: #fcfcfc;
        padding: 30px;
        border-radius: 15px;
        border: 2px dashed #DEDAB4;
        margin-top: 30px;
    }

    .admin-action-section h3 {
        margin-top: 0;
        color: #0A3323;
        font-size: 18px;
        margin-bottom: 20px;
    }

    textarea, input[type="file"], select {
        width: 100%;
        padding: 12px;
        border-radius: 10px;
        border: 1.5px solid #DEDAB4;
        box-sizing: border-box;
        font-family: inherit;
        outline: none;
    }

    textarea:focus, select:focus {
        border-color: #839958;
        box-shadow: 0 0 0 3px rgba(131, 153, 88, 0.1);
    }

    .btn-submit {
        background: #0A3323;
        color: white;
        padding: 14px 25px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 700;
        font-size: 15px;
        width: 100%;
        transition: 0.3s;
        margin-top: 20px;
    }

    .btn-submit:hover {
        background: #1a4a35;
        transform: translateY(-2px);
    }

    .img-preview {
        margin-top: 15px;
        border-radius: 12px;
        border: 2px solid #f0f0f0;
        object-fit: cover;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .btn-back {
        display: inline-block;
        margin-top: 25px;
        text-decoration: none;
        color: #888;
        font-size: 14px;
        font-weight: 500;
        transition: 0.2s;
    }

    .btn-back:hover {
        color: #0A3323;
    }

    .status-select-container {
        margin-bottom: 20px;
    }
</style>

<div class="data-wrapper">
    <h2>Detail & Respond Aspirasi</h2>

    <div class="info-grid">
        <div class="detail-item">
            <label>Nama Siswa</label>
            <div class="detail-box">{{ $aspirasi->siswa->nama ?? 'Siswa Terhapus' }}</div>
        </div>

        <div class="detail-item">
            <label>Kategori</label>
            <div class="detail-box">{{ $aspirasi->kategori->ket_kategori ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <label>Lokasi</label>
            <div class="detail-box">{{ $aspirasi->lokasi }}</div>
        </div>

        <div class="detail-item">
            <label>Tanggal Laporan</label>
            <div class="detail-box">{{ \Carbon\Carbon::parse($aspirasi->created_at)->format('d F Y, H:i') }}</div>
        </div>

        <div class="detail-item full-width">
            <label>Keterangan Aspirasi</label>
            <div class="detail-box" style="line-height: 1.6;">{{ $aspirasi->keterangan }}</div>
        </div>

        <div class="detail-item full-width">
            <label>Foto Laporan dari Siswa</label>
            @if($aspirasi->foto)
                <img src="/photo/uploads/{{ $aspirasi->foto }}" width="300" class="img-preview">
            @else
                <div class="detail-box" style="color: #999;">Tidak ada foto terlampir</div>
            @endif
        </div>
    </div>

    <div class="admin-action-section">
        <h3>Tanggapan Admin</h3>
        
        <form method="POST" action="/admin/riwayat-aspirasi/update/{{ $aspirasi->id }}" enctype="multipart/form-data">
            @csrf

            <div class="status-select-container">
                <label style="font-weight: 700; font-size: 13px; color: #444; display: block; margin-bottom: 8px;">Update Status</label>
                
                @php
                    $colors = [
                        'Menunggu' => ['bg' => '#FFE5E5', 'text' => '#D32F2F'],
                        'Proses'   => ['bg' => '#FFF4E5', 'text' => '#ED6C02'],
                        'Selesai'  => ['bg' => '#E8F5E9', 'text' => '#2E7D32'],
                    ];
                    $currentStatus = $aspirasi->status;
                    $style = $colors[$currentStatus] ?? ['bg' => '#eee', 'text' => '#333'];
                @endphp

                <select name="status" id="statusSelect" 
                    style="background-color: {{ $style['bg'] }}; color: {{ $style['text'] }}; font-weight: bold; border: 1.5px solid {{ $style['text'] }}33;">
                    <option value="Menunggu" {{ $aspirasi->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="Proses" {{ $aspirasi->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                    <option value="Selesai" {{ $aspirasi->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="detail-item">
                <label>Catatan / Feedback Admin</label>
                <textarea name="catatan_admin" rows="4" placeholder="Tuliskan alasan penolakan, instruksi, atau progres perbaikan...">{{ $aspirasi->catatan_admin }}</textarea>
            </div>

            <div class="detail-item" style="margin-top: 15px;">
                <label>Unggah Foto Bukti (Khusus jika Selesai)</label>
                <input type="file" name="foto_bukti">

                @if($aspirasi->foto_bukti)
                    <div style="margin-top: 10px;">
                        <span style="font-size: 11px; color: #888; display: block;">Bukti saat ini:</span>
                        <img src="/photo/bukti/{{ $aspirasi->foto_bukti }}" width="150" class="img-preview">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn-submit">Simpan & Perbarui Status</button>
        </form>
    </div>

    <a href="/admin/riwayat-aspirasi" class="btn-back">← Kembali ke Riwayat</a>
</div>

<script>
    const select = document.getElementById('statusSelect');
    select.addEventListener('change', function() {
        if(this.value === 'Menunggu') {
            this.style.backgroundColor = '#FFE5E5'; this.style.color = '#D32F2F';
        } else if(this.value === 'Proses') {
            this.style.backgroundColor = '#FFF4E5'; this.style.color = '#ED6C02';
        } else if(this.value === 'Selesai') {
            this.style.backgroundColor = '#E8F5E9'; this.style.color = '#2E7D32';
        }
    });
</script>
@endsection