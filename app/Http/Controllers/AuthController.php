<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    // Memproses login
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }
        return redirect()
            ->back()
            ->withInput()
            ->withErrors(['username' => 'Username atau password salah.']);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
