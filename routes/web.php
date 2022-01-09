<?php

use Illuminate\Support\Facades\Route;

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


// Auth::routes();
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Auth::routes(['register' => false]);

Route::group(['middleware' => ['is_admin']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('roles', 'App\Http\Controllers\RoleController');
Route::resource('users', 'App\Http\Controllers\UserController');
Route::resource('size', 'App\Http\Controllers\SizeController');
Route::resource('color', 'App\Http\Controllers\ColorController');
Route::resource('city', 'App\Http\Controllers\CityController');
Route::resource('product', 'App\Http\Controllers\ProductController');
Route::resource('category', 'App\Http\Controllers\CategoryController');
//category
Route::resource('attachment-category', 'App\Http\Controllers\AttachmentCategoryController');

 //attachment
 Route::resource('attachment', 'App\Http\Controllers\AttachmentController');
 //productColor
 Route::resource('productColor', 'App\Http\Controllers\ProductColorController');
  //productSize
  Route::resource('productSize', 'App\Http\Controllers\ProductSizeController');
 //features
 Route::resource('features', 'App\Http\Controllers\FeaturesController');
 //productRate
 Route::resource('productRate', 'App\Http\Controllers\ProductRateController');
 Route::resource('admin-cart', 'App\Http\Controllers\CartController');
 Route::resource('admin-order', 'App\Http\Controllers\OrderController');

 Route::resource('admin-slider', 'App\Http\Controllers\HomeSliderController');

 //test-notify
 Route::get('send', 'App\Http\Controllers\HomeController@sendNotification');
 Route::get('comment-replay/{id}','App\Http\Controllers\HomeController@comment_replay')->name('commentReplay');

 Route::resource('articles', 'App\Http\Controllers\ArticlesController');
 Route::post('articlesTag', 'App\Http\Controllers\ArticlesController@articlesTag')->name('articlesTag');
 //clients
 Route::resource('clients', 'App\Http\Controllers\ClientController');
 //admin-company-contact
 Route::resource('admin-company-contact', 'App\Http\Controllers\CompanyContactController');
 //whyus
 Route::resource('whyus', 'App\Http\Controllers\WhyUsController');
 //admin-company
 Route::resource('admin-company', 'App\Http\Controllers\CompanyController');
 Route::get('getNewsLetters','App\Http\Controllers\CompanyController@getNewsLetters')->name('getNewsLetters');
 Route::get('admin-contact-form', 'App\Http\Controllers\CompanyController@contactForm')->name('admin-contact-form');

 Route::resource('promo', 'App\Http\Controllers\PromoController');
Route::get('facebook', function () {
    return view('facebook');
});
Route::get('auth/facebook', 'App\Http\Controllers\Auth\FacebookController@redirectToFacebook');
Route::get('auth/facebook/callback', 'App\Http\Controllers\Auth\FacebookController@handleFacebookCallback');
});
