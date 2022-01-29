<?php

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


Route::prefix('admin')->group(function (){
    Route::get('/user/profile', [AdminController::class, 'profile'])->name('adminProfile');
    Route::post('/user/profile/edit', [AdminController::class, 'edit_profile'])->name('edit_profile');
});
