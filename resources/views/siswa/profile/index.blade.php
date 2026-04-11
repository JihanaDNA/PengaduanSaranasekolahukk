@extends('layouts.siswa')

@section('content')

<h2>Profile Siswa</h2>

<div style="background:white; padding:20px; border-radius:10px; max-width:600px;">
    <table cellpadding="10" width="100%">
        <tr>
            <td width="150"><b>NIS</b></td>
            <td>: {{ $siswa->nis }}</td>
        </tr>
        <tr>
            <td><b>Nama</b></td>
            <td>: {{ $siswa->nama }}</td>
        </tr>
        <tr>
            <td><b>Kelas</b></td>
            <td>: {{ $siswa->kelas }}</td>
        </tr>
    </table>
</div>

@endsection