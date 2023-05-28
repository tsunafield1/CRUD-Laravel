<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::post('/product/add', [ProductController::class, 'add'])->name('addProduct');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit']);
    Route::post('/product/update', [ProductController::class, 'update'])->name('updateProduct');
    Route::get('/product/delete/{id}', [ProductController::class, 'delete']);
});
