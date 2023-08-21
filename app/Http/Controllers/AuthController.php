<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('content.login');
    }

    public function checkLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/content');
        }
        return back()->withErrors([
            'email' => 'Creantials do not match our records',
        ]);
    }

    public function logout(Request $request)
    {
        // $credentials = $request->validate([
        //     'email' => ['required','email'],
        //     'password' => ['required'],
        // ]);

        Auth::logout();
            // $request->session()->reflash();
            echo('test');
            return redirect()->intended('/login');
        // }
        // return back()->withErrors([
        //     'email' => 'Creantials do not match our records',
        // ]);
    }
}
