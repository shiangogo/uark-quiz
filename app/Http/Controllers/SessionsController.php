<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Constants\AuthOptions;

class SessionsController extends Controller
{
    public function __construct() {
        $this->middleware('guest')->except('destroy');
    }

    public function new() {
        return view('auth-portal', ['authOption' => AuthOptions::LOGIN]);
    }

    public function create(Request $request) {
        $credentials = $request->only('account', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            Auth::login($user, false);

            return response()->json(['success' => '登入成功。'], 201);
        }
        return response()->json(['error' => '帳號或密碼錯誤。'], 401);
    }

    public function destroy() {
        Auth::logout();
        return redirect()->route('login');
    }
}
