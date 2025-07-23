<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\ContentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('register',[AdminController::class, 'regiser']);



Route::get('/contents/index',[ContentController::class, 'index']);
Route::get('/contents/{id}', [ContentController::class, 'show']);
// جربتها في الاي بي اي بس حطيتها في الويب لأن الاكسيس بيكون من صفحة بليد
// Route::post('login',[AdminController::class, 'login']);
// Route::post('logout',[AdminController::class, 'logout']);

Route::get('/categories', [CategoryApiController::class, 'index']);
Route::get('/categories/{id}/contents', [CategoryApiController::class, 'contents']);


