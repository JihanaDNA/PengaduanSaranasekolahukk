@extends('layouts.admin')

@section('content')

<style>
    /* Main Container */
    .data-wrapper {
        background: white;
        padding: 35px;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.03);
        border: 1px solid #f0f0f0;
    }

    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .header-section h2 {
        margin: 0;
        color: #0A3323;
        font-size: 26px;
        font-weight: 700;
    }

    /* Button Tambah */
    .btn-tambah {
        background: #0A3323; 
        color: white;
        text-decoration: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(10, 51, 35, 0.15);
    }

    .btn-tambah:hover {
        background: #144d36;
        transform: translateY(-2px);
    }

    /* Alert Success */
    .alert-success {
        background: #E8F5E9;
        color: #2E7D32;
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        border: 1px solid #C8E6C9;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Search Box */
    .search-box {
        margin-bottom: 25px;
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 14px 20px;
        border: 1.5px solid #E0E0E0;
        border-radius: 12px;
        outline: none;
        transition: 0.3s;
        box-sizing: border-box;
        background: #fafafa;
    }

    .search-box input:focus {
        border-color: #839958;
        background: white;
        box-shadow: 0 0 0 4px rgba(131, 153, 88, 0.1);
    }

    /* Table Styling */
    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    table th {
        background: #F9FBF2;
        color: #839958;
        padding: 18px;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 1px;
        font-weight: 700;
        border-bottom: 2px solid #F1F1F1;
        text-align: left;
    }

    table td {
        padding: 18px;
        border-bottom: 1px solid #F5F5F5;
        font-size: 15px;
        color: #333;
    }

    table tr:hover td {
        background: #fafdfa;
    }

    /* Action Buttons */
    .action-container {
        display: flex;
        gap: 8px;
    }

    .btn-action {
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: 0.2s;
        display: inline-block;
    }

    .btn-edit {
        background: #f1f5f0;
        color: #839958;
    }

    .btn-edit:hover {
        background: #839958;
        color: white;
    }

    .btn-delete {
        background: #fff0f0;
        color: #D32F2F;
    }

    .btn-delete:hover {
        background: #D32F2F;
        color: white;
    }
</style>

<div class="data-wrapper">

    <div class="header-section">
        <h2>Data Kategori</h2>
        <a href="/admin/kategori/create" class="btn-tambah">+ Tambah Kategori</a>
    </div>

    @if(session('success'))
        <div class="alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- SEARCH --}}
    <form method="GET" action="" class="search-box">
        <input 
            type="text"
            name="search"
            placeholder="Cari nama kategori..."
            value="{{ request('search') }}"
        >
    </form>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th width="80">No</th>
                    <th>Nama Kategori</th>
                    <th width="200">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($kategoris as $i => $k)
                <tr>
                    <td style="color: #999; font-weight: 500;">{{ $i+1 }}</td>
                    <td style="font-weight: 500; color: #0A3323;">{{ $k->ket_kategori }}</td>
                    <td>
                        <div class="action-container">
                            <a href="/admin/kategori/edit/{{ $k->id }}" class="btn-action btn-edit">
                                Edit
                            </a>
                            <a href="/admin/kategori/delete/{{ $k->id }}" 
                               class="btn-action btn-danger btn-delete"
                               onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                Hapus
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" align="center" style="padding: 50px; color: #999;">
                        Data kategori belum tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection