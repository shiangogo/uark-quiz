<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        if (Auth::check()) {
            return redirect('/home');
        }
        return redirect()->route('login');
    }

    public function home() {
        if (Auth::check()) {
            $user = Auth::user();
            return view('home', ['user' => $user]);
        }
        return redirect()->route('login');
    }
}
