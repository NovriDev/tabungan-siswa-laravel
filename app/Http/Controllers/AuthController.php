<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function index()
    {
        $title = "Login";

        return view('admin.auth.login', compact('title'));
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            // Jika "Ingat Saya" dicentang, simpan data login dalam cookie
            if ($request->has('remember')) {
                $cookie = cookie('remember_email', $request->email, 1440); // 1440 menit = 1 hari
                return redirect()->route('dashboard')->withCookie($cookie);
            }

            return redirect()->route('dashboard');
        }
        return redirect()->back()->with('loginError', 'Email atau Password salah !');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $cookies = [Cookie::forget('remember_email')];
        $request->session()->regenerateToken();
        return redirect('/login')->withCookies($cookies);
    }
}
