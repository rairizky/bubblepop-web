<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiFrontController;
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

Route::prefix('v1/api')->group(function() {
    // auth
    Route::prefix('/auth')->group(function() {
        Route::post('/login', [ApiAuthController::class, 'login'])->name('api.auth.login');
        Route::post('/register', [ApiAuthController::class, 'register'])->name('api.auth.register');
    });

    // menu
    Route::prefix('/menu')->group(function() {
        Route::get('/', [ApiFrontController::class, 'menu'])->name('api.front.menu');
        Route::get('/topping', [ApiFrontController::class, 'topping'])->name('api.front.topping');
    });

    // promo
    Route::prefix('/promo')->group(function() {
        Route::get('/', [ApiFrontController::class, 'promo'])->name('api.front.promo');
    });

    // category
    Route::prefix('/category')->group(function() {
        Route::get('/', [ApiFrontController::class, 'category'])->name('api.front.category');
        Route::get('/{id}/menu', [ApiFrontController::class, 'category_menu'])->name('api.front.category.menu');
        Route::get('/{id}/topping', [ApiFrontController::class, 'category_topping'])->name('api.front.category.topping');
    });
});
