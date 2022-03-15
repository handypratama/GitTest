<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function index()
    {
        return view('login', [
            'pageTitle' => "Login"
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if ($request->remember) {
            Cookie::queue('emailCookie', $request->email, 60);
            Cookie::queue('passwordCookie',  $request->password, 60);
        }

        if (Auth::attempt($credentials)) {
            if ($request->email === 'admin@gmail.com') {
                $request->session()->regenerate();
                return redirect()->intended('/admin');
            }

            $request->session()->regenerate();
            return redirect()->intended('/user');
        }

        return back()->with('loginErrorMessage', 'Login failed, please try again!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('logoutMessage', 'You are logged out.');
    }
}
