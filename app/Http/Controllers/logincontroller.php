<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class logincontroller extends Controller
{
    public function dashboard()
    {
        return view('/admin/login/login', [
            'title' => 'Login'
        ]);
    }
    public function authenticate(Request  $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ], );


        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            $userLevel = auth()->user()->level;
    
          return redirect('/dashboardadmin');
            }
            throw ValidationException::withMessages([
                'loginError' => 'Login failed. Please check your credentials.',
            ]);
        
        } catch (ValidationException $exception) {
            throw $exception;
        }
    }
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
