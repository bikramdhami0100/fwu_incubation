<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
Route::get('/', function () {
    return view('welcome');
});

// admin  
Route::get("/admin-login", function () {
    return view('admin.admin-login');
})->name('admin.login');

Route::post('/admin-login', [AdminController::class, 'login']);
Route::get('/admin-dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
Route::get('/news-updates',[NewsController::class,'index'])->name('admin.news-updates');
// Route::get('/news-updates',[NewsController::class,'index'])->name('admin.news.index');
Route::post('/news-updates',[NewsController::class,'store'])->name('admin.news.store');
Route::get('/news-updates/{id}/edit',[NewsController::class,'edit'])->name('admin.news.edit');
Route::put('/news-updates/{id}',[NewsController::class,'update'])->name('admin.news.update');
Route::delete('/news-updates/{id}',[NewsController::class,'destroy'])->name('admin.news.destroy');
