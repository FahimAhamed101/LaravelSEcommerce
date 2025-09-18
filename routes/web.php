<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ChildcategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProductController as FrontendProductController;

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
 //color routes
    Route::resource('colors', ColorController::class, [
        'names' => [
            'index' => 'admin.colors.index',
            'create' => 'admin.colors.create',
            'store' => 'admin.colors.store',
            'edit' => 'admin.colors.edit',
            'update' => 'admin.colors.update',
            'destroy' => 'admin.colors.destroy',
        ]
    ]);
    //size routes
    Route::resource('sizes', SizeController::class, [
        'names' => [
            'index' => 'admin.sizes.index',
            'create' => 'admin.sizes.create',
            'store' => 'admin.sizes.store',
            'edit' => 'admin.sizes.edit',
            'update' => 'admin.sizes.update',
            'destroy' => 'admin.sizes.destroy',
        ]
    ]);
    //product routes
    Route::resource('products', ProductController::class, [
        'names' => [
            'index' => 'admin.products.index',
            'create' => 'admin.products.create',
            'store' => 'admin.products.store',
            'edit' => 'admin.products.edit',
            'update' => 'admin.products.update',
            'destroy' => 'admin.products.destroy',
        ]
    ]);

});


Route::get('/', [FrontendProductController::class,'index'])->name('home');
//filter products routes
Route::get('show/{product}/product', [FrontendProductController::class,'show'])->name('products.show');
Route::get('subcategory/{subcategory}/products', [FrontendProductController::class,'productsBySubcategory'])->name('subcategory.products');
Route::get('childcategory/{childcategory}/products', [FrontendProductController::class,'productsByChildcategory'])->name('childcategory.products');
Route::get('brand/{brand}/products', [FrontendProductController::class,'productsByBrand'])->name('brand.products');
Route::get('color/{color}/products', [FrontendProductController::class,'productsByColor'])->name('color.products');
Route::get('size/{size}/products', [FrontendProductController::class,'productsBySize'])->name('size.products');
//search for products
Route::get('search/products', [FrontendProductController::class,'searchProducts'])->name('search.products');
//order products route
Route::get('order/products', [FrontendProductController::class,'orderProducts'])->name('order.products');


Route::middleware('guest')->group(function() {
    Route::get('user/register', [FrontendUserController::class,'showRegisterForm'])->name('user.register');
    Route::post('user/store', [FrontendUserController::class,'store'])->name('user.store');
    Route::get('user/login', [FrontendUserController::class,'showLoginForm'])->name('login');
    Route::post('user/auth', [FrontendUserController::class,'auth'])->name('user.auth');
});
Route::get('cart', [CartController::class,'index'])->name('cart.index');