<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
        $siswa = Siswa::find(session('siswa_id'));

        return view('siswa.dashboard', compact('siswa'));
    }
    
}
