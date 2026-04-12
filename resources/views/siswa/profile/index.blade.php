@extends('layouts.siswa')

@section('content')
<style>
    /* Container utama agar posisi profile di tengah layar */
    .center-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
    }

    .profile-card {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        width: 100%;
        max-width: 600px;
        text-align: center;
    }

    /* Avatar Inisial */
    .avatar-circle {
        width: 100px;
        height: 100px;
        background-color: #839958; /* Moss Green */
        color: white;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 40px;
        font-weight: bold;
        margin: 0 auto 20px;
        border: 4px solid #F7F4D5;
    }

    .profile-card h2 {
        margin-top: 0;
        margin-bottom: 30px;
        color: #0A3323;
        font-size: 26px;
        border-bottom: 2px solid #F7F4D5;
        padding-bottom: 15px;
    }

    /* Table Styling */
    .profile-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .profile-table tr {
        border-bottom: 1px solid #F7F4D5;
    }

    .profile-table tr:last-child {
        border-bottom: none;
    }

    .profile-table td {
        padding: 15px 10px;
        color: #333;
        font-size: 16px;
    }

    .label-cell {
        font-weight: bold;
        color: #0A3323;
        width: 35%;
    }

    .value-cell {
        color: #555;
    }

    .badge-profile {
        background: #105666;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: bold;
    }
</style>

<div class="center-container">
    <div class="profile-card">
        <div class="avatar-circle">
            {{ strtoupper(substr($siswa->nama, 0, 1)) }}
        </div>

        <h2>Profile Siswa</h2>

        <table class="profile-table">
            <tr>
                <td class="label-cell">NIS</td>
                <td class="value-cell">: <strong>{{ $siswa->nis }}</strong></td>
            </tr>
            <tr>
                <td class="label-cell">Nama Lengkap</td>
                <td class="value-cell">: {{ $siswa->nama }}</td>
            </tr>
            <tr>
                <td class="label-cell">Kelas</td>
                <td class="value-cell">: <span class="badge-profile">{{ $siswa->kelas }}</span></td>
            </tr>
        </table>
    </div>
</div>
@endsection