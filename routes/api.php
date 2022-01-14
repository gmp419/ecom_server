<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductListController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductDetailsController;
use App\Http\Controllers\Admin\NotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Get visitor on home page
Route::get('/getvisitor', [VisitorController::class, 'getVisitorDetails']);

//Contact page form submission
Route::post('/contact-us', [ContactController::class, 'contactUs']);

//Site info
Route::get('/site-info', [SiteInfoController::class, 'siteInfo']);

//Category
Route::get('/category', [CategoryController::class, 'getCategories']);

//Product list
Route::get('/product-by-remark/{remark}', [ProductListController::class, 'getProductListByRemark']);

Route::get('/product-by-category/{category}', [ProductListController::class, 'getProductListByCategory']);

Route::get('/product-by-subcategory/{category}/{subcategory}', [ProductListController::class, 'getProductListBySubategory']);

//Slider images
Route::get('/slider-images', [SliderController::class, 'getSliderImages']);

//Product details
Route::get('/product-details/{id}', [ProductDetailsController::class, 'getProductDetails']);

//Notification
Route::get('/notification', [NotificationController::class, 'getNotification']);