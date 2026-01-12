<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:35',
            'email'     => 'required|string|email|unique:users,email',
            'password'  => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'user',
        ]);

        return redirect()->route('login.form')
            ->with('success', 'User berhasil dibuat!');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // cek role
            if (Auth::user()->role === 'admin'){
                return redirect()->route('dashboard')->with('role', 'admin');
            } else {
                return redirect()->route('dashboard')->with('role', 'user');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ]);
    }

    public function dashboard(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return view('admin.index');
            } else {
                return view('pages.dashboard.index');
            }
        }

        return redirect()->route('login.form');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}