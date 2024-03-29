<?php

use App\Http\Controllers\Web\UsersController;
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
        Route::get('/reg', function () {
            return view('web.register');
        });
        Route::get('/about-us', [App\Http\Controllers\Web\AboutUsController::class, 'index']);
        Route::get('/contact', [App\Http\Controllers\Web\ContactUsController::class, 'index'])->name('contact');
        Route::post('/contact-message', [App\Http\Controllers\Web\ContactUsController::class, 'sendMessage']);
        Route::post('/send-letter', [App\Http\Controllers\Web\ContactUsController::class, 'sendLetter']);

        Route::get('/blogs', [App\Http\Controllers\Web\BlogsController::class, 'index']);
        Route::get('blogs/fetch_data', [App\Http\Controllers\Web\BlogsController::class, 'fetch_data']);
        Route::get('/single-blog/{id}/{slug?}',[App\Http\Controllers\Web\BlogsController::class, 'singleBlog'])->name('single-blog.show');
        Route::get('/single-blog/{id}/{slug?}', 'App\Http\Controllers\Web\BlogsController@singleBlog')->name('single-blog.show');


        Route::get('/products/{id}', [App\Http\Controllers\Web\ProductsController::class, 'index']);

        Route::get('/search-product', [App\Http\Controllers\Web\ProductsController::class, 'search'])->name('search-product');
        Route::get('/web-fetchProduct',  [App\Http\Controllers\Web\ProductsController::class, 'fetch_product'])->name('web-fetchProduct');

        Route::get('/web-fetchProductSearch',  [App\Http\Controllers\Web\ProductsController::class, 'fetchProductSearch'])->name('web-fetchProductSearch');

        Route::get('/fetch-product-filter',  [App\Http\Controllers\Web\ProductsController::class, 'fetch_data'])->name('fetch-product-filter');
        Route::get('fetch-product-filter-search', [App\Http\Controllers\Web\ProductsController::class, 'fetch_Search'])->name('fetch-product-filter-search');
        Route::get('/single-product/{id}',[App\Http\Controllers\Web\ProductsController::class, 'singleProduct'])->name('single-product');
        Route::get('/leave-comment/{id}',[App\Http\Controllers\Web\ProductsController::class, 'leaveComment'])->name('leave-comment');

        Route::post('/saveReview',[App\Http\Controllers\Web\ProductsController::class, 'saveComment'])->name('saveReview');


        //cart
        Route::get('/my-cart/{id}', [App\Http\Controllers\Web\CartController::class, 'index']);
        Route::get('/my-fav/{id}', [App\Http\Controllers\Web\CartController::class, 'fav']);
        Route::post('add-to-my-cart', [App\Http\Controllers\Web\CartController::class,'storeCart']);

        Route::post('add-to-fav', [App\Http\Controllers\Web\CartController::class,'storeFav']);
        // web-fetchInc
        Route::get('/web-fetchInc', [App\Http\Controllers\Web\CartController::class,'AddQuantity'])->name('web-fetchInc');
        Route::get('/web-fetchDec', [App\Http\Controllers\Web\CartController::class,'SubQuantity'])->name('web-fetchDec');

        Route::get('/web-item-del', [App\Http\Controllers\Web\CartController::class,'DelItem'])->name('web-item-del');

        Route::get('/web-item-del-fav', [App\Http\Controllers\Web\CartController::class,'DelItemFav'])->name('web-item-del-fav');

        //oder
Route::get('/place-order/{id}', [App\Http\Controllers\Web\OrderController::class, 'index']);

Route::get('/getDeliverCost', [App\Http\Controllers\Web\OrderController::class, 'delivery'])->name('getDeliverCost');
Route::get('/getPromoCost', [App\Http\Controllers\Web\OrderController::class, 'promo'])->name('getPromoCost');
Route::post('saving-order', [App\Http\Controllers\Web\OrderController::class,'storeOrder']);
//add-favorite
Route::post('add-favorite', [App\Http\Controllers\Web\CartController::class,'storeFavorite']);
//user route
//get Login Form
Route::get('/user-login', [UsersController::class, 'login'])->name('user-login');
//store Login
Route::post('/save-user', [UsersController::class, 'saveLogin'])->name('save-user');

Route::post('/user-register', [UsersController::class, 'registerUser'])->name('user-register');

Route::post('/captcha-validation', [UsersController::class, 'capthcaFormValidate']);
Route::get('/reload-captcha', [UsersController::class, 'reloadCaptcha']);
Route::get('/user-profile/{id}', [UsersController::class, 'profile'])->name('user-profile');
Route::post('/update-profile', [UsersController::class, 'updateProfile']);

// Route::get('sub-qty/{id}', 'Api\CartController@SubstractQuantity');
        // Route::get('/confirm',
        // function () {
        //     Session::flash('error', 'test');
        //     return view('welcome');
        // });
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
