<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
Route::get('/', function () {
    return view('welcome');
});
/*****admin guest routes*******/
Route::middleware('admin.guest')->group(function() {
    Route::get('admin/login', [AdminController::class,'login'])->name('admin.login');
    Route::post('admin/auth', [AdminController::class,'auth'])->name('admin.auth');
});

/*****admin auth routes*******/
Route::middleware('admin')->prefix('admin')->group(function() {
    Route::get('dashboard', [AdminController::class,'index'])->name('admin.index');
    Route::post('admin/logout', [AdminController::class,'logout'])->name('admin.logout');


 



});
