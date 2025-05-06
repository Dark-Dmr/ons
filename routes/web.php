<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContentController;
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
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('logout.admin');


Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('/contents/index',[ContentController::class, 'index'])->name('contents.index');
    Route::get('/contents/create', [ContentController::class, 'create'])->name('contents.create');
    Route::post('store-content', [ContentController::class, 'store'])->name('store.content');
    Route::get('details/{content}', [ContentController::class, 'details'])->name('content.details');
    Route::put('update/{content}', [ContentController::class, 'update'])->name('content.update'); 
    Route::delete('delete/{content}', [ContentController::class, 'destroy'])->name('content.delete'); //not use
});

