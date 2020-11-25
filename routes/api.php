<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiFrontController;
use App\Http\Controllers\ApiTransactionController;
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

Route::prefix('v1/')->group(function() {
    // auth
    Route::prefix('/auth')->group(function() {
        Route::post('/login', [ApiAuthController::class, 'login'])->name('api.auth.login');
        Route::post('/register', [ApiAuthController::class, 'register'])->name('api.auth.register');
    });

    // search
    Route::prefix('/search')->group(function() {
        // menu
        Route::get('/menu', [ApiFrontController::class, 'search_menu'])->name('api.front.search.menu');
        // topping
        Route::get('/topping', [ApiFrontController::class, 'search_topping'])->name('api.front.search.topping');
    });

    // header
    Route::prefix('/header')->group(function() {
        Route::get('/', [ApiFrontController::class, 'header'])->name('api.front.header');
    });

    // promo
    Route::prefix('/promo')->group(function() {
        Route::get('/', [ApiFrontController::class, 'promo'])->name('api.front.promo');
    });

    // menu
    Route::prefix('/menu')->group(function() {
        Route::get('/', [ApiFrontController::class, 'menu'])->name('api.front.menu');
        Route::get('/{id}', [ApiFrontController::class, 'detail_menu'])->name('api.front.detail.menu');
    });

    // topping
    Route::prefix('/topping')->group(function() {
        Route::get('/', [ApiFrontController::class, 'topping'])->name('api.front.topping');
        Route::get('/{id}', [ApiFrontController::class, 'detail_topping'])->name('api.front.topping.detail');
    });

    // category
    Route::prefix('/category')->group(function() {
        Route::get('/', [ApiFrontController::class, 'category'])->name('api.front.category');
        Route::get('/menu', [ApiFrontController::class, 'category_menu'])->name('api.front.category.menu');
        Route::get('/topping', [ApiFrontController::class, 'category_topping'])->name('api.front.category.topping');
    });
    
    // transaction
    Route::prefix('/transaction')->group(function() {
        // create cart and add menu
        Route::get('/{iduser}/finish', [ApiTransactionController::class, 'tr_finish'])->name('api.front.transaction.finish');
        Route::get('/{iduser}/pending', [ApiTransactionController::class, 'tr_pending'])->name('api.front.transaction.pending');
        Route::get('/{iduser}/cart', [ApiTransactionController::class, 'tr_cart'])->name('api.front.transaction.cart');
        Route::post('/{iduser}/cart/add', [ApiTransactionController::class, 'addMenuToCart'])->name('api.front.transaction.add');

        // checkout cart
        Route::post('/{iduser}/cart/checkout', [ApiTransactionController::class, 'checkoutCart'])->name('api.front.transaction.checkout');
    });

});
