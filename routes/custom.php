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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {

//my web route
        Route::get('/', [App\Http\Controllers\Web\IndexController::class, 'index']);

        Route::get('/about-us', [App\Http\Controllers\Web\AboutUsController::class, 'index']);
        Route::get('/contact', [App\Http\Controllers\Web\ContactUsController::class, 'index'])->name('contact');
        Route::post('/contact-message', [App\Http\Controllers\Web\ContactUsController::class, 'sendMessage']);
        Route::post('/send-letter', [App\Http\Controllers\Web\ContactUsController::class, 'sendLetter']);

        Route::get('/blogs', [App\Http\Controllers\Web\BlogsController::class, 'index']);
        Route::get('blogs/fetch_data', [App\Http\Controllers\Web\BlogsController::class, 'fetch_data']);
    });

//...
// Route::get('/', function () {
//     return view('web.home');
//     // return Redirect::to(Config::get('app.default_language'));
// });
// Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);
//        //about us
// Route::get('/about', [App\Http\Controllers\IndexController::class, 'about'])->name('about');
//     //contact us
// Route::get('/contact', [App\Http\Controllers\IndexController::class, 'contact'])->name('contact');
// Route::post('/contact-message', [App\Http\Controllers\IndexController::class,'sendMessage']);
//   //service
// Route::get('/web-service', [App\Http\Controllers\IndexController::class, 'service'])->name('service');
// Route::get('/single-service/{id}', [App\Http\Controllers\IndexController::class,'singleService']);
//  //client
// Route::get('/web-client', [App\Http\Controllers\IndexController::class, 'client'])->name('client');
//    //gallery
// Route::get('/web-gallery', [App\Http\Controllers\IndexController::class, 'gallery'])->name('gallery');
//  //blogs
// Route::get('/web-blogs', [App\Http\Controllers\IndexController::class, 'blogs'])->name('blogs');
// Route::get('/single-blog/{id}', [App\Http\Controllers\IndexController::class,'singleBlog']);
// Route::post('/send-Comment', [App\Http\Controllers\IndexController::class,'sendComment']);
