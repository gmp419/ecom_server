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
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\FavouriteController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);

Route::post('/user', [AuthController::class, 'getUser']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/forget-password', [AuthController::class, 'forgetPassword']);

Route::post('/reset-password', [AuthController::class, 'resetPassword']);


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

Route::get('/suggested-product/{key}', [ProductListController::class, 'getSuggestedProduct']);

//Slider images
Route::get('/slider-images', [SliderController::class, 'getSliderImages']);

//Product details
Route::get('/product-details/{id}', [ProductDetailsController::class, 'getProductDetails']);

//Notification
Route::get('/notification', [NotificationController::class, 'getNotification']);

//Search
Route::get('/search/{subcategory}', [ProductListController::class, 'searchProduct']);

//reviews
Route::get('/review/{id}', [ReviewController::class, 'getReviews']);

//Add to cart
Route::post('/add-to-cart', [CartController::class, 'addToCart']);

Route::get('/cart-count/{user_email}', [CartController::class, 'countCart']);

//cart list route by email
Route::get('/cart-list/{user_email}', [CartController::class, 'getCartList']);

//remove cart item
Route::post('/remove-cart-item/{user_email}/{id}', [CartController::class, 'removeCartItem']);

Route::post('/cartItemPlus/{id}/{quanity}/{price}', [CartController::class, 'cartItemPlus']);

Route::post('/cartItemMinus/{id}/{quanity}/{price}', [CartController::class, 'cartItemMinus']);


//Favorite product
Route::get('/add-to-favorite/{product_code}/{email}', [FavouriteController::class, 'addToFavorite']);

Route::get('/favorite-list/{email}', [FavouriteController::class, 'favoriteList']);

Route::post('/remove-favorite/{product_code}/{email}', [FavouriteController::class, 'removeFavorite']);

//Order
Route::post('/order/{user_email}', [CartController::class, 'order']);

//Order History
Route::get('/order-history/{user_email}', [CartController::class, 'orderHistory']);