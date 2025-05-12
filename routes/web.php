<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DocxToJsonController; 

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

    //contents
    Route::get('/contents/index',[ContentController::class, 'index'])->name('contents.index');
    Route::get('/contents/create', [ContentController::class, 'create'])->name('contents.create');
    Route::post('store-content', [ContentController::class, 'store'])->name('store.content');
    Route::get('/contents/details/{content}', [ContentController::class, 'details'])->name('content.details');
    Route::put('contents/update/{content}', [ContentController::class, 'update'])->name('content.update'); 
    Route::delete('contents/delete/{content}', [ContentController::class, 'destroy'])->name('content.delete');
    //Categories
    Route::get('/categories/index',[CategoryController::class, 'index'])->name('category.index');
    Route::get('/categories/create', [categoryController::class, 'create'])->name('category.create');
    Route::post('store-category', [categoryController::class, 'store'])->name('store.category');
    Route::get('/categories/details/{category}', [categoryController::class, 'details'])->name('category.details');
    Route::put('/categories/update/{category}', [categoryController::class, 'update'])->name('category.update'); 
    Route::delete('/categories/delete/{category}', [categoryController::class, 'destroy'])->name('category.delete');
//    //Docx to Json
    Route::get('/upload', [DocxToJsonController::class, 'showForm']);
    Route::post('/upload', [DocxToJsonController::class, 'convert']);
 
});

