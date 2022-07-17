<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MyTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGalleryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Route as RoutingRoute;
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

route::get('/', [FrontendController::class, 'index'])->name('index');
route::get('/detail/{slug}', [FrontendController::class, 'details'])->name('details');


Route::middleware(['auth:sanctum', 'verified'])->group(function (){
    route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
    route::post('/cart/{id}', [FrontendController::class, 'cartAdd'])->name('cart-add');
    route::delete('/cart/{id}', [FrontendController::class, 'cartDelete'])->name('cart-delete');
    route::post('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
    Route::get('/cities/{province_id}', [FrontendController::class,'getCities'])->name('city');
    Route::post('/ongkir', [FrontendController::class,'ongkir']);
    route::get('/checkout/success', [FrontendController::class, 'success'])->name('checkout-success');
    
  
});

Route::middleware(['auth:sanctum', 'verified'])->name('dashboard.')->prefix('dashboard')->group(function (){
    Route::get('/' ,[DashboardController::class, 'index'])->name('index');
    Route::resource('my-transaction', MyTransactionController::class)->only([
        'index',
        'show',
    ]);
    
    Route::middleware(['admin'])->group(function(){
        Route::get('/export/laporan/ready', [ExportController::class, 'index'])->name('export.laporan.ready');
        Route::get('/export/laporan/handmade', [ExportController::class, 'handmade'])->name('export.laporan.handmade');
        Route::resource('product', ProductController::class);
        Route::resource('product.gallery', ProductGalleryController::class)->shallow()->only([
            'index',
            'create',
            'store',
            'destroy'
        ]);
        Route::resource('transaction', TransactionController::class)->only([
            'index',
            'show',
            'edit',
            'update'
        ]);
        Route::resource('user', UserController::class)->only([
            'index',
            'edit',
            'update',
            'destroy',
            'show'
        ]);
        Route::resource('category', CategoryController::class)->only([
            'index',
            'edit',
            'update',
            'destroy',
            'show',
            'store',
            'create'
        ]);
    });
});
