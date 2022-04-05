<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PdfController;

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

    // Users
    Route::get('/register', function() {
        return view('register');
    })->name('register');

    Route::post('/register', [UsersController::class, 'create'])->name('register');

    Route::get('/userList', [UsersController::class, 'userList'])->name('userList');
    Route::get('/userNotOrderList', [UsersController::class, 'userNotOrderList'])->name('usernotorderlist');
    Route::get('/inactiveList', [UsersController::class, 'inactiveList'])->name('inactivelist');

    Route::get('/setInactive/{id}', [UsersController::class, 'setInactive'])->name('setInactive');
    Route::get('/setActive/{id}', [UsersController::class, 'setActive'])->name('setActive');

    Route::get('/editUser/{id}', [UsersController::class, 'editUser'])->name('editUser');
    Route::post('/updateUser', [UsersController::class, 'updateUser'])->name('updateUser');


    // Products
    Route::get('/products', [ProductsController::class, 'index'])->name('products'); // list of products
    Route::get('/registerproducts', [ProductsController::class, 'register'])->name('registerproducts');
    Route::post('/registerproducts', [ProductsController::class, 'create'])->name('registerproducts');

    Route::get('editProduct/{id}', [ProductsController::class, 'editProduct'])->name('editProduct');
    Route::post('updateProduct', [ProductsController::class, 'updateProduct'])->name('updateProduct');

    // Order
    Route::get('/orderedList', [OrderController::class, 'orderedList'])->name('orderedList');
    Route::get('/showOrdered/{id}', [OrderController::class, 'showOrdered'])->name('showOrdered');


    // PDF
    Route::get('/usersPdf', [PdfController::class, 'userPdf'])->name('usersPdf');
    Route::get('/productsPdf', [PdfController::class, 'productsPdf'])->name('productsPdf');
    Route::get('/orderedReport', [PdfController::class, 'orderedReportPdf'])->name('orderedReportPdf');


    
});

Route::middleware(['auth'])->name('user.')->prefix('user')->group(function () {

    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::post('/order', [OrderController::class, 'create'])->name('order');

    Route::get('/userShowOrdered/{id}', [OrderController::class, 'UserShowOrdered'])->name('userShowOrdered');

});


require __DIR__.'/auth.php';
