<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginProcess(Request $request)
    {
        if ($request->login_type == 'admin') {

            $admin = Admin::where('username', $request->username)->first();

            if ($admin && Hash::check($request->password, $admin->password)) {

                session([
                    'login' => true,
                    'role' => 'admin',
                    'admin_id' => $admin->id
                ]);

                return redirect('/admin/dashboard');
            }

            return back()->with('error', 'Username atau Password salah');
        }

        if ($request->login_type == 'siswa') {

            $siswa = Siswa::where('nis', $request->nis)
                ->where('kelas', $request->kelas)
                ->first();

            if ($siswa) {

                session([
                    'login' => true,
                    'role' => 'siswa',
                    'siswa_id' => $siswa->id
                ]);

                return redirect('/siswa/dashboard');
            }

            return back()->with('error', 'NIS atau Kelas salah');
        }

        return back()->with('error', 'Pilih tipe login terlebih dahulu');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}