<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

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
            'keterangan' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'kategori_id.required' => 'Kategori wajib dipilih!',
            'lokasi.required' => 'Lokasi wajib diisi!',
            'keterangan.required' => 'Keterangan wajib diisi!',
            'foto.required' => 'Foto wajib diupload!',
            'foto.image' => 'File harus berupa gambar!',
            'foto.mimes' => 'Format harus jpg, jpeg, atau png!',
            'foto.max' => 'Ukuran maksimal 2MB!'
        ]);

        // Upload Foto (karena sudah required, pasti ada file)
        $file = $request->file('foto');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('photo/uploads'), $namaFile);

        // Simpan ke database
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
        $aspirasis = Aspirasi::with('kategori')
            ->where('siswa_id', session('siswa_id'))
            ->get();

        return view('siswa.aspirasi.index', compact('aspirasis'));
    }
}