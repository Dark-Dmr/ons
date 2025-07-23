<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DocxToJsonController;
use App\Models\Category;

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
Route::get('/', function () {
    return redirect()->route('login.admin.page');
});
Route::post('admin/login',[AdminController::class, 'login'])->name('login.admin');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('logout.admin');


Route::group(['middleware' => ['auth:admin']], function () {

    //contents
    Route::get('/contents/index',[ContentController::class, 'viewiIndex'])->name('contents.index');
    Route::get('/contents/create', [ContentController::class, 'create'])->name('contents.create');
    Route::post('store-content', [ContentController::class, 'store'])->name('contents.store');
    Route::get('/contents/details/{content}', [ContentController::class, 'details'])->name('contents.details');
    Route::put('contents/update/{content}', [ContentController::class, 'update'])->name('contents.update'); 
    Route::delete('contents/delete/{content}', [ContentController::class, 'destroy'])->name('contents.delete');

    
    //Docx to Json
    Route::get('contents/upload', [DocxToJsonController::class, 'showForm'])->name('upload.showForm');
    Route::post('contents/upload', [DocxToJsonController::class, 'convert'])->name('upload.convert');
 

    //category
    Route::get('/categories', [CategoryController::class, 'viewIndex'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

