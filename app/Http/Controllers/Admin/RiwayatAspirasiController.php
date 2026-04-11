<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatAspirasiController extends Controller
{
    public function index()
    {
        $aspirasis = \App\Models\Aspirasi::with(['siswa', 'kategori'])->get();

        return view('admin.riwayat_aspirasi.index', compact('aspirasis'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $aspirasi = \App\Models\Aspirasi::findOrFail($id);

        $aspirasi->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status berhasil diubah');
    }
}