<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

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

Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth','verified');

Route::get('/product_details/{id}', [HomeController::class, 'product_details']);

Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);

Route::get('/show_cart', [HomeController::class, 'show_cart']);

Route::get('/remove_product/{id}', [HomeController::class, 'remove_product']);

Route::get('/cash_order', [HomeController::class, 'cash_order']);

Route::get('/mpesastk/{totalprice}', [HomeController::class, 'mpesastk']);

Route::get('/initiatepush', [HomeController::class, 'initiate_push']);

Route::get('/show_order', [HomeController::class, 'show_order']);

Route::get('/cancel_order/{id}', [HomeController::class, 'cancel_order']);

Route::post('/add_comment', [HomeController::class, 'add_comment']);

Route::post('/add_reply', [HomeController::class, 'add_reply']);

Route::get('/product_search', [HomeController::class, 'product_search']);

Route::get('/products', [HomeController::class, 'product']);

Route::get('/search_product', [HomeController::class, 'search_product']);

Route::get('/contact_us', [HomeController::class, 'show_contact']);

Route::post('/contact_mail', [HomeController::class, 'contact_mail_send']);


//add newsletter subscriber email
Route::post('/add-subscriber-email', [HomeController::class, 'storeNewsletterEmail']);


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

Route::get('/search', [AdminController::class, 'search_data']);

Route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf']);

Route::get('/send_email/{id}', [AdminController::class, 'send_email']);

Route::post('/send_user_email/{id}',[AdminController::class, 'send_user_email']);

Route::get('/account_setting', [AdminController::class, 'account_setting']);

Route::post('/add_account_setting', [AdminController::class, 'add_account_setting']);

Route::get('/show_account_details', [AdminController::class, 'show_account_details']);

Route::get('/edit_account_setting/{id}', [AdminController::class, 'edit_account_setting']);

Route::post('/edit_account_confirm/{id}', [AdminController::class, 'edit_account_confirm']);

Route::get('/change_password', [AdminController::class, 'change_password']);

Route::post('/change_password_confirm', [AdminController::class, 'change_password_confirm']);





