<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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
    return view('welcome');
});

Route::middleware(['auth'])->name('admin.')->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        if(Auth::user()->role == 'admin')
            return view('dashboard');
        else
            return view('dashboard-user');
    })->name('dashboard');

    Route::get('/register', function() {
        return view('register');
    })->name('register');

    Route::post('/register', [UsersController::class, 'create'])->name('register');

    Route::get('/userList', [UsersController::class, 'userList'])->name('userList');

    Route::get('/products', [ProductsController::class, 'index'])->name('products');


});


// Auth::routes(['register' => false]);


require __DIR__.'/auth.php';
