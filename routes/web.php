<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\DashboardConroller;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\frontend\Order\OrederController;
use App\Http\Controllers\frontend\ProfileController;
use App\Http\Controllers\frontend\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use App\Http\Livewire\Admin\Brands\Index

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

Auth::routes();

Route::get('/', [FrontendController::class, 'index']);
Route::get('/collections', [FrontendController::class, 'categories']);
Route::get('/collections/{category_slug}', [FrontendController::class, 'products']);
Route::get('/collections/{category_slug}/{product_slug}', [FrontendController::class, 'productview']);

Route::get('/new-arrivals', [FrontendController::class, 'newArrivals']);
Route::get('/featured-products', [FrontendController::class, 'featuredProducts']);
Route::get('/search', [FrontendController::class, 'searchProducts']);

///wishlist
Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index']);
    Route::get('/cart', [CartController::class, 'index']);
    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::get('/orders', [OrederController::class, 'index']);
    Route::get('/orders/{orderId}', [OrederController::class, 'show']);

    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile', [ProfileController::class, 'updateUserDetails']);
    Route::get('/change-password', [ProfileController::class, 'changepassword']);
    Route::post('/change-password', [ProfileController::class, 'updatepassword']);
});

Route::get('/thank-you', [FrontendController::class, 'thankyou']);

//home page
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardConroller::class, 'index']);

    Route::get('/site-setting', [SettingController::class, 'index']);
    Route::post('/site-setting', [SettingController::class, 'store']);


    // category Rotue
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category',  'index');
        Route::get('/category/create',  'create');
        Route::post('/category',  'store');
        Route::get('/category/{cate_item}/edit',  'edit');
        Route::put('/update_category/{category_id}',  'update');
        Route::get('/brands',  'index');
    });
    // Routes Product
    Route::controller(ProductController::class)->group(function () {
        Route::get('/product', 'index');
        Route::get('/product/create', 'create');
        Route::post('/products', 'store');
        Route::get('/products/{product}/edit',  'edit');
        Route::PUT('/products/{product}',  'update');
        Route::get('/products/{product_id}/delete',  'destroy');
        Route::get('/product-image/{product_image_id}/delete',  'destroyImage');

        Route::post('/product-color/{prod_color_id}', 'updateProdColorQty');
        Route::get('/product-color/{prod_color_id}/delete', 'destroyProdColor');
    });
    // Color Rotue
    Route::controller(ColorController::class)->group(function () {
        Route::get('/colors', 'index');
        Route::get('/colors/create', 'create');
        Route::post('/colors/create', 'store');
        Route::get('/colors/{color_id}/edit', 'edit');
        Route::put('/colors/{color_id}', 'update');
        Route::get('/colors/{color_id}/delete', 'destroy');
    });
    // Slider Rotue
    Route::controller(SliderController::class)->group(function () {
        Route::get('/sliders', 'index');
        Route::get('/sliders/create', 'create');
        Route::post('/sliders/create', 'store');
        Route::get('/sliders/{slider}/edit', 'edit');
        Route::put('/sliders/{slider}', 'update');
        Route::get('/sliders/{slider}/delete', 'destroy');
    });
    //orders Route
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/orders/{orderId}', 'show');
        Route::put('/orders/{orderId}', 'updateOrderstatus');

        // invoice Route
        Route::get('/invoice/{orderId}', 'viewInvoice');
        Route::get('/invoice/{orderId}/generate', 'generateInvoice');
        Route::get('/invoice/{orderId}/mail', 'mailInvoice');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('/users/create', 'store');
        Route::get('/users/{userid}/edit', 'edit');
        Route::put('/users/{userid}', 'update');
        Route::get('/users/{userid}/delete', 'destroy');
    });

    Route::get('/brands', App\Http\Livewire\Admin\Brands\Index::class);
});
