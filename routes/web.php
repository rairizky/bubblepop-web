<?php

use App\Http\Controllers\PanelCategoryController;
use App\Http\Controllers\PanelDashboardController;
use App\Http\Controllers\PanelProductController;
use App\Http\Controllers\PanelTransactionOnsite;
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
        Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.changepassword');

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
                Route::post('add', [PanelUsersController::class, 'storeUsers'])->name('panel.users.storeusers');
                Route::delete('{id}/delete', [PanelUsersController::class, 'deleteUsers'])->name('panel.users.delete');
            });
        });

        // Admin access
        Route::group(['middleware' => 'can:isAdmin'], function() {
            // Product
            Route::prefix('product/')->group(function() {
                // Menu
                Route::prefix('menu/')->group(function() {
                    Route::get('', [PanelProductController::class, 'indexMenu'])->name('panel.product.index.menu');
                    Route::get('/add', [PanelProductController::class, 'addMenu'])->name('panel.product.add.menu');
                    Route::post('/add', [PanelProductController::class, 'storeMenu'])->name('panel.product.store.menu');
                    Route::get('/{id}/edit', [PanelProductController::class, 'editMenu'])->name('panel.product.edit.menu');
                    Route::put('/{id}/edit/update', [PanelProductController::class, 'updateMenu'])->name('panel.product.update.menu');
                    Route::delete('{id}/delete', [PanelProductController::class, 'deleteMenu'])->name('panel.product.delete.menu');
                });
            // Topping
                Route::prefix('topping/')->group(function() {
                    Route::get('', [PanelProductController::class, 'indexTopping'])->name('panel.product.index.topping');
                    Route::get('/add', [PanelProductController::class, 'addTopping'])->name('panel.product.add.topping');
                    Route::post('/add', [PanelProductController::class, 'storeTopping'])->name('panel.product.store.topping');
                    Route::get('/{id}/edit', [PanelProductController::class, 'editTopping'])->name('panel.product.edit.topping');
                    Route::put('/{id}/edit/update', [PanelProductController::class, 'updateTopping'])->name('panel.product.update.topping');
                    Route::delete('{id}/delete', [PanelProductController::class, 'deleteTopping'])->name('panel.product.delete.topping');
                });
            });

            // Category
            Route::prefix('category/')->group(function() {
                Route::get('', [PanelCategoryController::class, 'index'])->name('panel.category.index');
                Route::get('/add', [PanelCategoryController::class, 'add'])->name('panel.category.add');
                Route::post('/add', [PanelCategoryController::class, 'storeCategory'])->name('panel.category.storecategory');
                Route::get('/{id}/edit', [PanelCategoryController::class, 'editCategory'])->name('panel.category.edit');
                Route::put('/{id}/edit/update', [PanelCategoryController::class, 'updateCategory'])->name('panel.category.updatecategory');
                Route::delete('{id}/delete', [PanelCategoryController::class, 'deleteCategory'])->name('panel.category.delete');
            });
        });

        // Cashier access
        Route::group(['middleware' => 'can:isCashier'], function() {
            // Transaction
            Route::prefix('transaction/')->group(function() {
                // Onsite
                Route::prefix('onsite/')->group(function() {
                    Route::get('', [PanelTransactionOnsite::class, 'addInvoice'])->name('panel.transaction.addinvoice.onsite');
                    Route::post('', [PanelTransactionOnsite::class, 'storeInvoice'])->name('panel.transaction.storeinvoice.onsite');
                    Route::get('/{id}', [PanelTransactionOnsite::class, 'cartMenu'])->name('panel.transaction.cartmenu.onsite');
                    Route::post('/{id}/addmenu', [PanelTransactionOnsite::class, 'storeCart'])->name('panel.transaction.storecart.onsite');
                });

                // Scan
                Route::prefix('scan/')->group(function() {
                    // 
                });
            });
        });
    
    });
});


