<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    // ======================
    // LIST KATEGORI
    // ======================
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori.index', compact('kategoris'));
    }

    // ======================
    // FORM TAMBAH
    // ======================
    public function create()
    {
        return view('admin.kategori.create');
    }

    // ======================
    // SIMPAN DATA
    // ======================
    public function store(Request $request)
    {
        $request->validate([
            'ket_kategori' => 'required'
        ]);

        Kategori::create([
            'ket_kategori' => $request->ket_kategori
        ]);

        return redirect('/admin/kategori')->with('success', 'Kategori berhasil ditambah');
    }

    // ======================
    // FORM EDIT
    // ======================
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    // ======================
    // UPDATE
    // ======================
    public function update(Request $request, $id)
    {
        $request->validate([
            'ket_kategori' => 'required'
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'ket_kategori' => $request->ket_kategori
        ]);

        return redirect('/admin/kategori')->with('success', 'Kategori berhasil diupdate');
    }

    // ======================
    // DELETE
    // ======================
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect('/admin/kategori')->with('success', 'Kategori berhasil dihapus');
    }
}