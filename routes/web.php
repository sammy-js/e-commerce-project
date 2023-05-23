<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/redirect', [HomeController::class, 'redirect']);

Route::get('/product_details/{id}', [HomeController::class, 'product_details']);

Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);

Route::get('/show_cart', [HomeController::class, 'show_cart']);

Route::get('/remove_product/{id}', [HomeController::class, 'remove_product']);

Route::get('/cash_order', [HomeController::class, 'cash_order']);

Route::get('/mpesastk/{totalprice}', [HomeController::class, 'mpesastk']);

Route::get('/initiatepush', [HomeController::class, 'initiate_push']);

/*
Route::controller(HomeController::class)
->prefix('payments')
->as('payments')
->group(function(){
    Route::get('/initiatepush','initiate_push')->name('initiatepush');
});
*/


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/view_category', [AdminController::class, 'view_category']);

Route::post('/add_category', [AdminController::class, 'add_category']);

Route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);

Route::get('/view_product', [AdminController::class, 'view_product']);

Route::post('/add_product', [AdminController::class, 'add_product']);

Route::get('/show_product', [AdminController::class, 'show_product']);

Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);

Route::get('/update_product/{id}', [AdminController::class, 'update_product']);

Route::post('/update_product_confirm/{id}',[AdminController::class, 'update_product_confirm']);

Route::get('/view_order', [AdminController::class, 'view_order']);

Route::get('/delivered/{id}', [AdminController::class, 'delivered']);




