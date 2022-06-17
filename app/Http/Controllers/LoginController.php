<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
 
class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // dd($request->post());
 
        if (Auth::attempt($credentials)) { 

            $query=User::select('id')->where('email', $credentials['email'])->get();
            $queryforname=User::select('name')->where('email', $credentials['email'])->get();
            $id=$query[0]['id'];
            $name=$queryforname[0]['name'];
            $request->session()->regenerate();
            $request->session()->put('id', $id);
            $request->session()->regenerate();
            $request->session()->put('name', $name);
            // dd($request->session()->get('id'));
           return redirect()->intended('dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function login(){
        return view('login');
    }
    public function dashboard(){
        return view('dashboard');
    }
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }
}