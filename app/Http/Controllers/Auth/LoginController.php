<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function admin()
    {
        return view('pages.auth.admin.login');
    }

    public function authenticate(Request $request)
    {
        $credential = null;

        if ($request->has("email") && $request->has("password")) {
            $credential = $request->validate([
                'email'  => 'required',
                'password'  => 'required'
            ]);
        } else {
            $credential = $request->validate([
                'nik'       =>  'required',
                'g-recaptcha-response' => 'required|captcha',
            ]);
            $credential['password'] = $request->nik;
            unset($credential['g-recaptcha-response']);
        }
        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            $panel = null;
            if (Auth::user()->role == 'ADMIN') {
                $panel = route('admin');
            }
            if (Auth::user()->role == 'ALUMNI') {
                $panel = route('alumni');
            }
            return redirect()->intended($panel)->with('notif', 'Selamat Datang ' . Auth::user()->name);
        }
        return back()->with('notif-fail', 'Login Gagal!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->invalidate();
        return redirect('/');
    }
}
