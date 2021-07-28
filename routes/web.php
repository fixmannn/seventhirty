<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PaymentsController;

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


require __DIR__ . '/auth.php';


// Pages Controller
Route::get('/', [PagesController::class, 'home']);
Route::get('/shop', [PagesController::class, 'shop']);
Route::get('gallery', [PagesController::class, 'gallery']);
Route::get('about', [PagesController::class, 'about']);
Route::get('account-details', [PagesController::class, 'accountDetails']);
Route::get('change-password', [PagesController::class, 'changePassword']);
Route::get('orders', [PagesController::class, 'orders']);
Route::get('test', [PagesController::class, 'test']);

// Products Controller 
Route::get('/products/friendship/{id}', [ProductsController::class, 'friendship']);
Route::get('/products/anxiety/{id}', [ProductsController::class, 'anxiety']);
Route::get('/products/forgiving/{id}', [ProductsController::class, 'forgiving']);
Route::get('/products/paramore/{id}', [ProductsController::class, 'paramore']);
Route::get('/products/beerbongs/{id}', [ProductsController::class, 'beerbongs']);
Route::post('/products/beerbongs/{id}', [ProductsController::class, 'beerbongs']);
Route::get('/products/blackpink/{id}', [ProductsController::class, 'blackpink']);
Route::get('/products/drake/{id}', [ProductsController::class, 'drake']);
Route::get('/products/dualipa/{id}', [ProductsController::class, 'dualipa']);
Route::get('/products/dynamite/{id}', [ProductsController::class, 'dynamite']);
Route::get('/products/hayley/{id}', [ProductsController::class, 'hayley']);
Route::get('/products/hollywoods/{id}', [ProductsController::class, 'hollywoods']);
Route::get('/products/lookmom/{id}', [ProductsController::class, 'lookmom']);
Route::get('/products/modernity/{id}', [ProductsController::class, 'modernity']);
Route::get('/products/neckdeep/{id}', [ProductsController::class, 'neckdeep']);
Route::get('/products/purpose/{id}', [ProductsController::class, 'purpose']);
Route::get('/products/starboy/{id}', [ProductsController::class, 'starboy']);
Route::get('/products/travis/{id}', [ProductsController::class, 'travis']);
Route::get('/products/zayn/{id}', [ProductsController::class, 'zayn']);

// Checkout Routes
Route::get('checkout', [CheckoutController::class, 'index']);
Route::get('/province/{id}', [CheckoutController::class, 'getCities']);
Route::get('/shipping/{id}', [CheckoutController::class, 'shipping']);
Route::post('checkout', [UsersController::class, 'show']);

// Payment Routes
Route::post('payment', [UsersController::class, 'store']);
Route::patch('payment', [UsersController::class, 'update']);
Route::get('payment', [PaymentsController::class, 'index']);
Route::get('payment-success', [PaymentsController::class, 'status']);

// Cart Routes
Route::post('add-to-cart/{id}', [CartsController::class, 'addToCart']);
Route::get('cart', [CartsController::class, 'index']);
Route::delete('cart', [CartsController::class, 'remove']);

// Account Details Routes
Route::post('account-details', [UsersController::class, 'edit']);
Route::post('change-password', [UsersController::class, 'change']);
