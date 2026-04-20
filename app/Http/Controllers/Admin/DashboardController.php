<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kategori;
use App\Models\Aspirasi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalKategori = Kategori::count();
        $totalAspirasi = Aspirasi::count();
        $aspirasiMenunggu = Aspirasi::where('status', 'Menunggu')->count();

        $aspirasiTerbaru = \App\Models\Aspirasi::with(['siswa', 'kategori'])
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