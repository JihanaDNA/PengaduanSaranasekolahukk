<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aspirasi;

class RiwayatAspirasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $aspirasis = Aspirasi::with(['siswa', 'kategori'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('siswa', function ($q) use ($search) {
                    $q->where('nama', 'like', "%$search%");
                })
                ->orWhereHas('kategori', function ($q) use ($search) {
                    $q->where('ket_kategori', 'like', "%$search%");
                })
                ->orWhere('lokasi', 'like', "%$search%");
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->get();

        return view('admin.riwayat_aspirasi.index', compact('aspirasis'));
    }

    public function updateStatus(Request $request, $id)
    {
        $aspirasi = Aspirasi::findOrFail($id);

        $request->validate([
            'status' => 'required'
        ]);

        $aspirasi->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status berhasil diubah');
    }

    public function show($id)
    {
        $aspirasi = Aspirasi::with(['siswa', 'kategori'])->findOrFail($id);
        return view('admin.riwayat_aspirasi.detail', compact('aspirasi'));
    }

    public function updateAspirasi(Request $request, $id)
    {
        $aspirasi = Aspirasi::findOrFail($id);

        $request->validate([
            'status' => 'required',
            'foto_bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $aspirasi->status = $request->status;
        $aspirasi->catatan_admin = $request->catatan_admin;

        if ($request->hasFile('foto_bukti')) {
            $file = $request->file('foto_bukti');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('photo/bukti'), $namaFile);

            $aspirasi->foto_bukti = $namaFile;
        }

        $aspirasi->save();

        return redirect('/admin/riwayat-aspirasi')
            ->with('success', 'Data berhasil diperbarui');
    }
}