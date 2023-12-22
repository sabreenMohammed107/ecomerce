<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReactCartController;
use App\Http\Controllers\Api\ReactDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('user', function (Request $request) {
    return $request->user();
});
// react apis workshop
 Route::get('home', [ReactDataController::class, 'home']);

 Route::get('ProductsByCat/{id}', [ReactDataController::class, 'ProductsByCat']);
 Route::get('show-product/{id}', [ReactDataController::class, 'singlePro']);
 Route::get('/fetchProduct', [ReactDataController::class, 'fetch_product']);

 Route::get('search', [ReactDataController::class, 'search']);

  Route::post('register', [AuthController::class, 'register']);
 Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('refreshToken', [AuthController::class, 'tokenUpdate']);
    Route::post('add-to-cart',  [ReactCartController::class, 'storeCart']);
    Route::get('cart', [ReactCartController::class, 'cart']);
    Route::get('add-qty/{id}', [ReactCartController::class, 'AddQuantity']);
    Route::get('sub-qty/{id}', [ReactCartController::class, 'SubstractQuantity']);
    Route::get('del-product/{id}', [ReactCartController::class, 'deleteProduct']);
});





//slider - offers

// Route::post('register', 'App\Http\Controllers\Api\AuthController@register');
// Route::post('login', 'App\Http\Controllers\Api\AuthController@login');

// Route::post('password/email', 'App\Http\Controllers\Api\AuthController@forgot');
// Route::post('password/reset', 'App\Http\Controllers\Api\AuthController@reset');
// Route::get('all-products', 'App\Http\Controllers\Api\ProductController@allProduct');
// Route::get('products/{id}', 'App\Http\Controllers\Api\ProductController@index');
// Route::get('categories', 'App\Http\Controllers\Api\ProductController@categories');
// Route::get('latest-product', 'App\Http\Controllers\Api\ProductController@latest');
// Route::get('home-slider', 'App\Http\Controllers\Api\ProductController@homeSlider');
// Route::get('show-product/{id}', 'App\Http\Controllers\Api\ProductController@single_product');
// Route::get('search/{str}', 'App\Http\Controllers\Api\ProductController@search');
// Route::get('show-product/{id}', 'App\Http\Controllers\Api\ProductController@single_product');
// Route::middleware('auth:api')->group(function () {


//     Route::post('make-review', 'App\Http\Controllers\Api\CartController@review');


// });
