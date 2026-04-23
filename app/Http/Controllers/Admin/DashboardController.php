<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kategori;
use App\Models\Aspirasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalSiswa = Siswa::count();
        $totalKategori = Kategori::count();
        $totalAspirasi = Aspirasi::count();
        $aspirasiMenunggu = Aspirasi::where('status', 'Menunggu')->count();

        $search = $request->search;
        $status = $request->status;

        $aspirasiTerbaru = Aspirasi::with(['siswa', 'kategori'])
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
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalKategori',
            'totalAspirasi',
            'aspirasiMenunggu',
            'aspirasiTerbaru'
        ));
    }
}