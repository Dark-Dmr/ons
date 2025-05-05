<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';


//بداية الويب اي بي اي
Route::get('admin/login',[AdminController::class, 'loginAdminPage'])->name('login.admin.page');
Route::post('admin/login',[AdminController::class, 'login'])->name('login.admin');
Route::post('logout',[AdminController::class, 'logout'])->name('logout.admin');