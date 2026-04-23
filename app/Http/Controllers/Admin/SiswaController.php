<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $siswas = Siswa::when($search, function ($query) use ($search) {
            $query->where('nis', 'like', "%$search%")
                  ->orWhere('nama', 'like', "%$search%")
                  ->orWhere('kelas', 'like', "%$search%");
        })->get();

        return view('admin.siswa.index', compact('siswas'));
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswas,nis',
            'nama' => 'required',
            'kelas' => 'required'
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas
        ]);

        return redirect('/admin/siswa')->with('success', 'Siswa berhasil ditambahkan');
    }
}