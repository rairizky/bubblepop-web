<?php

use App\Http\Controllers\PanelDashboardController;
use App\Http\Controllers\PanelUsersController;
use App\Http\Controllers\ProfileController;
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

// Auth only
Route::group(['middleware' => 'auth'], function() {  
    // panel
    Route::prefix('v1/panel/')->group(function() {

        // profile
        Route::get('/profile/', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile/', [ProfileController::class, 'addProfile'])->name('profile.addprofile');
        Route::put('/profile/update/account', [ProfileController::class, 'updateProfileName'])->name('profile.updateprofile.account');
        Route::put('/profile/update/information', [ProfileController::class, 'updateProfile'])->name('profile.updateprofile.information');

        // Dashboard
        Route::prefix('dashboard/')->group(function() {
            Route::get('', [PanelDashboardController::class, 'index'])->name('panel.dashboard.index');
        });
    
        // Superadmin access
        Route::group(['middleware' => 'can:isSuperadmin'], function() {
            // Users
            Route::prefix('users/')->group(function() {
                Route::get('', [PanelUsersController::class, 'index'])->name('panel.users.index');
                Route::get('add', [PanelUsersController::class, 'add'])->name('panel.users.add');
            });
        });

        // Admin access
        Route::group(['middleware' => 'can:isAdmin'], function() {
            // Product
            Route::prefix('product/')->group(function() {
                // 
            });
        });

        // Cashier access
        Route::group(['middleware' => 'can:isCashier'], function() {
            // Transaction
            Route::prefix('transaction/')->group(function() {
                // 
            });
        });
    
    });
});


