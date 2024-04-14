<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constants\AuthOptions;
use App\Models\Organization;

class OrganizationsController extends Controller
{
    public function new() {
        return view('auth-portal', ['authOption' => AuthOptions::CREATE_ORGANIZATION]);
    }

    public function create(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required',
            'org_no' => 'required|unique:orgs',
        ]);

        Organization::create([
            'title' => $validatedData['title'],
            'org_no' => $validatedData['org_no'],
        ]);

        return response()->json(['success' => '機關單位建立成功。'], 201);
    }
}
