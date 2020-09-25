<?php

use App\Http\Controllers\PanelDashboardController;
use App\Http\Controllers\PanelUsersController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;

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


