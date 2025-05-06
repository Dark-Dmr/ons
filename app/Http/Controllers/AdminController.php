<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAdminRequest;
use App\Http\Requests\RegisterAdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
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
    
    public function login(LoginAdminRequest $request)
    {
        $data = $request->validated();
        $admin = Admin::where('email', $data['email'])->first();

        if (!$admin || !Hash::check($data['password'], $admin->password)) {
            return redirect(route('login.admin.page'))->with("error", "Login details are not valid");
        }

        // 1. Session login (for accessing dashboard)
        Auth::guard('admin')->login($admin);

        // 2. Create Sanctum token (for future API use)
        $token = $admin->createToken('admin-auth-token')->plainTextToken;

        // 3. Save the token in session (optional)
        session(['admin_token' => $token]);

        // 4. Redirect to dashboard
        return redirect()->route('contents.index')->with('token', $token);
    }   

    public function logout(Request $request)
    {
        // Revoke Sanctum token if exists
        $request->user('admin')?->currentAccessToken()?->delete();

        // Logout and destroy session
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.admin.page');
    }

}
