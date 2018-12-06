<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

use App\User;
use Auth;

class AuthController extends Controller
{
    public function showRegister() {
        if(Auth::check()) {
            return redirect('/chat');
        } else {
            return view('register');
        }
    }

    public function showLogin() {
        if(Auth::check()) {
            return redirect('/chat');
        } else {
            return view('login');
        }
    }

    public function register(RegisterRequest $req) {
        User::create([
            'fname' => $req->fname,
            'lname' => $req->lname,
            'username' => $req->username,
            'password' => bcrypt($req->password)
        ]);

        return redirect('/login');
    }

    public function login(LoginRequest $req) {
        // Try to login
        if (Auth::attempt(['username' => $req->username, 'password' => $req->password])) {
            User::where('username', $req->username)->update(['is_online' => 1]);
            broadcast(new \App\Events\OnlineUsers());
            return redirect('/chat');
        } else {
            // Wrong email and/or password
            $message = 'Pogrešno korisničko ime i/ili lozinka.';

            // Login view with error message
            return view('login', compact('message'));
        }
    }

	public function logout() {
        User::where('username', Auth::user()->username)->update(['is_online' => 0]);
        Auth::logout();
        broadcast(new \App\Events\OnlineUsers());
    	return redirect('/login');
    }
}
