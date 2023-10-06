<?php

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
