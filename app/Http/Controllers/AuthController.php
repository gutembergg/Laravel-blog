<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('blog.login');
    }

    public function dologin(LoginRequest $request)
    {
        $credentials = $request->validated();

        if(Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->intended(route('blog.index'));
        }

        return to_route('auth.login')->withErrors([
            'email' => 'Mauvaises credentials'
        ])->onlyInput('email');

    }

    public function logout()
    {
        Auth::logout();
        
        return to_route('auth.login');
    }
}