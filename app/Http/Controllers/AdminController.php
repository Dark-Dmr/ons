<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAdminRequest;
use App\Http\Requests\RegisterAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function loginAdminPage()
    {
        return view('adminLogin');
    }
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
            return redirect(route('login.admin.page'))->with("error","Login details are not valid");
        }

        $token = $admin->createToken('auth_token')->plainTextToken;

        return [
            'admin' => $admin,
            'token' => $token
        ];

    }

    public function logout(Request $request)
    {
        //ماجربته لسه
        $request->user()->currentAccessToken()->delete();
    
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
