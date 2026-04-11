<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // =========================
    // HALAMAN LOGIN
    // =========================
    public function login()
    {
        return view('auth.login');
    }

    // =========================
    // PROSES LOGIN
    // =========================
    public function loginProcess(Request $request)
    {
        // =========================
        // LOGIN ADMIN
        // =========================
        if ($request->login_type == 'admin') {

            $admin = Admin::where('username', $request->username)->first();

            if ($admin && Hash::check($request->password, $admin->password)) {

                // SIMPAN SESSION ADMIN
                session([
                    'login' => true,
                    'role' => 'admin',
                    'admin_id' => $admin->id
                ]);

                // REDIRECT KE DASHBOARD ADMIN
                return redirect('/admin/dashboard');
            }

            return back()->with('error', 'Username atau Password salah');
        }

        // =========================
        // LOGIN SISWA
        // =========================
        if ($request->login_type == 'siswa') {

            $siswa = Siswa::where('nis', $request->nis)
                ->where('kelas', $request->kelas)
                ->first();

            if ($siswa) {

                // SIMPAN SESSION SISWA
                session([
                    'login' => true,
                    'role' => 'siswa',
                    'siswa_id' => $siswa->id
                ]);

                // REDIRECT KE DASHBOARD SISWA
                return redirect('/siswa/dashboard');
            }

            return back()->with('error', 'NIS atau Kelas salah');
        }

        // JIKA TIDAK PILIH LOGIN TYPE
        return back()->with('error', 'Pilih tipe login terlebih dahulu');
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}