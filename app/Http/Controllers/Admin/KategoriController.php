<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $kategoris = Kategori::when($search, function ($query) use ($search) {
            $query->where('ket_kategori', 'like', "%$search%");
        })->get();

        return view('admin.kategori.index', compact('kategoris'));
    }
 
    public function create()
    {
        return view('admin.kategori.create');
    }

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

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

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

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect('/admin/kategori')->with('success', 'Kategori berhasil dihapus');
    }
}