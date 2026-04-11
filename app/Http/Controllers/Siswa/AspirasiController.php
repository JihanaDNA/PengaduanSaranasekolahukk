<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Kategori;

class AspirasiController extends Controller
{
    // ======================
    // FORM INPUT
    // ======================
    public function create()
    {
        $kategoris = Kategori::all();
        return view('siswa.aspirasi.create', compact('kategoris'));
    }

    // ======================
    // SIMPAN DATA
    // ======================
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'lokasi' => 'required',
            'keterangan' => 'required'
        ]);

        $namaFile = null;
       if ($request->hasFile('foto')) {
        $namaFile = time().'_'.$request->file('foto')->getClientOriginalName();
        $request->file('foto')->move(public_path('photo/uploads'), $namaFile);
        }

        Aspirasi::create([
            'siswa_id' => session('siswa_id'),
            'kategori_id' => $request->kategori_id,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'status' => 'Menunggu',
            'tanggal_aspirasi' => now(),
            'foto' => $namaFile
        ]);

        return redirect('/siswa/dashboard')->with('success', 'Aspirasi berhasil dikirim');
    }

    public function index()
    {
        $aspirasis = \App\Models\Aspirasi::with('kategori')
            ->where('siswa_id', session('siswa_id'))
            ->get();

        return view('siswa.aspirasi.index', compact('aspirasis'));
    }
}