<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function register() {
        return view('users.register');
    }
    public function login()
    {
        return view('users.login');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

       $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        auth()->login($user);

        return redirect('/')->with('message', 'User created and login successfully');
    }

    public function logout(Request $request) {

       auth()->logout();
       $request->session()->invalidate();
       $request->session()->regenerateToken();

       return redirect('/')->with('message', 'User successfully logout');
    }

    public function authenticate(Request $request) {
        $credentials =  $request->validate([
            'email' => 'required|email',
            'password' => 'required'
         ]);

         if(auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You are now logged in!');
         }

         return back()->withErrors(['email' => 'Wrong email or password'])->onlyInput('email');
    }
}
