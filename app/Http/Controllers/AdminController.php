<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAdminRequest;
use App\Http\Requests\RegisterAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    
    public function regiser (RegisterAdminRequest $request){
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        $admin = Admin::create($data);

        $token = $admin->createToken('auth_token')->plainTextToken;
        //تذكرني لاحقا الميزة الي تحت
        // $admin->remember_token = $token;
        // $admin->save();
    
        return [
            'admin' => $admin,
            'token' => $token
        ];
    }
    
    public function login (LoginAdminRequest $request){
        $data = $request->validated();
        $admin = Admin::where('email', $data['email'])->first();
        if (!$admin || !Hash::check($data['password'], $admin->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $admin->createToken('auth_token')->plainTextToken;

        return [
            'admin' => $admin,
            'token' => $token
        ];

    }
}
