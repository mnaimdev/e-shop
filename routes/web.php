<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// -------------------------------------- Admin --------------------------- //


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Category
Route::middleware(['auth'])->group(function () {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'category')->name('category');
        Route::post('/category/store', 'category_store')->name('category.store');

        Route::get('/category/edit/{category_id}', 'category_edit')->name('category.edit');
        Route::get('/category/delete/{category_id}', 'category_delete')->name('category.delete');
        Route::post('/category/update',  'category_update')->name('category.update');
    });
});



// Product
Route::middleware(['auth'])->group(function () {
    Route::controller(ProductController::class)->group(function () {
        // Product
        Route::get('/product/create', 'product')->name('product');
        Route::post('/product/store', 'product_store')->name('product.store');
        Route::get('/product/list', 'product_list')->name('product.list');
        Route::get('/product/edit/{product_id}', 'product_edit')->name('product.edit');
        Route::post('/product/update/', 'product_update')->name('product.update');

        Route::get('/product/delete/{product_id}', 'product_delete')->name('product.delete');

        Route::get('/changeStatus', 'changeStatus');
    });
});

// --------------------------------- Frontend ------------------------------- //


// Frontend
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('HOME');
    Route::get('/product/details/{product_id}', 'productDetails')->name('product.details');

    Route::get('/orderplaced', 'orderPlace')->name('ORDERPLACED');

    Route::get('/checkout', 'checkout')->name('CHECKOUT');

    Route::post('/cart/store', 'cartStore')->name('cart.store');
    Route::get('/cart', 'cart')->name('cart');
    Route::get('/order', 'order')->name('order');
    Route::post('/order/store', 'orderStore')->name('order.store');
});


// Banner
Route::middleware(['auth'])->group(function () {
    Route::controller(BannerController::class)->group(function () {
        // Banner
        Route::get('/banner/create', 'banner')->name('banner');
        Route::post('/banner/store', 'banner_store')->name('banner.store');
        Route::get('/banner/list', 'banner_list')->name('banner.list');
        Route::get('/banner/edit/{banner_id}', 'banner_edit')->name('banner.edit');
        Route::post('/banner/update/', 'banner_update')->name('banner.update');

        Route::get('/banner/delete/{banner_id}', 'banner_delete')->name('banner.delete');
    });
});




require __DIR__ . '/auth.php';
