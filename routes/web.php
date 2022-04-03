<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrderController;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->name('admin.')->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
            return view('dashboard');
    })->name('dashboard');

    Route::get('/register', function() {
        return view('register');
    })->name('register');

    Route::post('/register', [UsersController::class, 'create'])->name('register');

    Route::get('/userList', [UsersController::class, 'userList'])->name('userList');
    Route::get('/userNotOrderList', [UsersController::class, 'userNotOrderList'])->name('usernotorderlist');
    Route::get('/inactiveList', [UsersController::class, 'inactiveList'])->name('inactivelist');

    Route::get('/setInactive/{id}', [UsersController::class, 'setInactive'])->name('setInactive');
    Route::get('/setActive/{id}', [UsersController::class, 'setActive'])->name('setActive');

    Route::get('/products', [ProductsController::class, 'index'])->name('products'); // list of products
    Route::get('/registerproducts', [ProductsController::class, 'register'])->name('registerproducts');
    Route::post('/registerproducts', [ProductsController::class, 'create'])->name('registerproducts');

    // Order
    Route::get('/orderedList', [OrderController::class, 'orderedList'])->name('orderedList');
    Route::get('/showOrdered/{id}', [OrderController::class, 'showOrdered'])->name('showOrdered');


    // PDF
    Route::get('/usersPdf', [UsersController::class, 'userPdf'])->name('usersPdf');
    Route::get('/productsPdf', [ProductsController::class, 'productsPdf'])->name('productsPdf');


    
});

Route::middleware(['auth'])->name('user.')->prefix('user')->group(function () {

    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::post('/order', [OrderController::class, 'create'])->name('order');

});


require __DIR__.'/auth.php';
