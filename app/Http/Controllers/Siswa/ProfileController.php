<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;

class ProfileController extends Controller
{
    public function index()
    {
        $siswa = Siswa::find(session('siswa_id'));

        return view('siswa.profile.index', compact('siswa'));
    }
}
