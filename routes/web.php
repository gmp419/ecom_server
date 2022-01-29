<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
