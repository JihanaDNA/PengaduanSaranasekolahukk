<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $id = session('siswa_id');

        $query = \App\Models\Aspirasi::with('kategori')
            ->where('siswa_id', $id);

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('lokasi', 'like', '%'.$request->search.'%')
                ->orWhere('keterangan', 'like', '%'.$request->search.'%');
            });
        }

        $aspirasis = $query->latest()->take(5)->get();

        $total = \App\Models\Aspirasi::where('siswa_id',$id)->count();
        $menunggu = \App\Models\Aspirasi::where('siswa_id',$id)->where('status','Menunggu')->count();
        $selesai = \App\Models\Aspirasi::where('siswa_id',$id)->where('status','Selesai')->count();

        $siswa = \App\Models\Siswa::find($id);

        return view('siswa.dashboard', compact(
            'aspirasis','total','menunggu','selesai','siswa'
        ));
    }
    
}
