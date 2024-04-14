<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Constants\AuthOptions;

class UsersController extends Controller
{

    public function __construct() {
        $this->middleware('guest');
    }
    public function new() {
        return view('auth-portal', ['authOption' => AuthOptions::REGISTER]);
    }

    public function create(Request $request) {
        $validatedData = $request->validate([
            'org_no' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'account' => 'required|unique:users',
            'password' => 'required|min:8',
            'apply_file' => 'required|file',
        ]);

        $org = Organization::where('org_no', $validatedData['org_no'])->first();

        if (!$org) {
            return response()->json(['error' => '機關單位代碼不存在，請先建立機關。'], 401); 
        }

        $user = User::create([
            'org_id' => $org->id,
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'account' => $validatedData['account'],
            'password' => Hash::make($validatedData['password']),
            'status' => 'pending',
        ]);

        $filePath = $request->file('apply_file')->store('apply_files');
        $user->applyFiles()->create(['file_path' => $filePath]);

        return response()->json(['success' => '帳號建立成功。'], 201);
    }

}
