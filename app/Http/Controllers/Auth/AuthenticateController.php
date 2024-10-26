<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthenticateController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Login', [
            'status' => session('status')
        ]);
    }

    public function store(Request $request)
    {

        $credentials = $request->validate([

            'email' => 'required|email',
            'password' => 'required'

        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        } else {

            return redirect()->back()->withErrors([
                'email' => 'Provided Credentials do not match our records'
            ])->onlyInput('email');
        }
    }

    public function destroy(Request $request){

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect()->route('login');
    }
}
