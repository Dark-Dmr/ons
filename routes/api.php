<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('register',[AdminController::class, 'regiser']);

// جربتها في الاي بي اي بس حطيتها في الويب لأن الاكسيس بيكون من صفحة بليد
// Route::post('login',[AdminController::class, 'login']);
// Route::post('logout',[AdminController::class, 'logout']);

