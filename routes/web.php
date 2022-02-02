<?php

use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductListController;
use App\Http\Controllers\Admin\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubcategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('/logout', [AdminController::class, 'logout'])->name('adminLogout');


Route::prefix('admin')->group(function () {
    Route::get('/user/profile', [AdminController::class, 'profile'])->name('adminProfile');
    Route::post('/user/profile/edit', [AdminController::class, 'edit_profile'])->name('edit_profile');
    Route::get('/user/profile/edit/password', [AdminController::class, 'change_password'])->name('changePassword');
    Route::post('/user/profile/update/password', [AdminController::class, 'update_password'])->name('update_password');
});

Route::prefix('category')->group(function(){
    Route::get('/allcategory', [CategoryController::class, 'categories'])->name('allCategory');
    Route::get('/addcategory', [CategoryController::class, 'add_category'])->name('addCategory');
    Route::post('/storecategory', [CategoryController::class, 'store_category'])->name('storeCategory');
    Route::get('/edit/{id}', [CategoryController::class, 'edit_category']);
    Route::post('/update/{id}', [CategoryController::class, 'update_category'])->name('updateCategory');
    Route::get('/delete/{id}', [CategoryController::class, 'delete_category'])->name('deleteCategory');
});

Route::post('/subcategory/update/{id}', [SubcategoryController::class, 'update'])->name('updateSubcategory');
Route::get('/subcategory/delete/{id}', [SubcategoryController::class, 'delete'])->name('deleteSubcategory');
Route::resource('subcategory', SubcategoryController::class);


Route::prefix('slider')->group(function(){
    Route::get('/all', [SliderController::class, 'index'])->name('slider.all');
    Route::get('/add', [SliderController::class, 'create'])->name('slider.add');
    Route::post('/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::post('/update/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::get('/delete/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');
});

Route::prefix('product')->group(function(){
    Route::get('/all', [ProductListController::class, 'index'])->name('product.all');
    Route::get('/add', [ProductListController::class, 'add'])->name('product.add');
    Route::post('/store', [ProductListController::class, 'store'])->name('product.store');
    Route::get('/edit/{id}', [ProductListController::class, 'edit'])->name('product.edit');
    Route::post('/update/{id}', [ProductListController::class, 'update'])->name('product.update');
    Route::get('/delete/{id}', [ProductListController::class, 'delete'])->name('product.delete');
});

Route::prefix('orders')->group(function(){
    Route::get('/pending', [CartController::class, 'pending'])->name('order.pending');
    Route::get('/processing', [CartController::class, 'processing'])->name('order.processing');
    Route::get('/completed', [CartController::class, 'completed'])->name('order.completed');
    Route::post('/status/{id}', [CartController::class, 'status'])->name('order.status');
});

