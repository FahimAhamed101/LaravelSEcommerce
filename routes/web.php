<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ChildcategoryController;
use App\Http\Controllers\Admin\BrandController;
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

 Route::resource('categories', CategoryController::class, [
        'names' => [
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'store' => 'admin.categories.store',
            'edit' => 'admin.categories.edit',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy',
        ]
    ]);
 
//subcategory routes
    Route::resource('subcategories', SubcategoryController::class, [
        'names' => [
            'index' => 'admin.subcategories.index',
            'create' => 'admin.subcategories.create',
            'store' => 'admin.subcategories.store',
            'edit' => 'admin.subcategories.edit',
            'update' => 'admin.subcategories.update',
            'destroy' => 'admin.subcategories.destroy',
        ]
    ]);
    //childcategory routes
    Route::resource('childcategories', ChildcategoryController::class, [
        'names' => [
            'index' => 'admin.childcategories.index',
            'create' => 'admin.childcategories.create',
            'store' => 'admin.childcategories.store',
            'edit' => 'admin.childcategories.edit',
            'update' => 'admin.childcategories.update',
            'destroy' => 'admin.childcategories.destroy',
        ]
    ]);
    //brand routes
    Route::resource('brands', BrandController::class, [
        'names' => [
            'index' => 'admin.brands.index',
            'create' => 'admin.brands.create',
            'store' => 'admin.brands.store',
            'edit' => 'admin.brands.edit',
            'update' => 'admin.brands.update',
            'destroy' => 'admin.brands.destroy',
        ]
    ]);


});
