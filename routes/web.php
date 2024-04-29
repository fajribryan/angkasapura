<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\registercontroller;
use App\Http\Controllers\dashboardcontroller;


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


Route::get('/', [dashboardController::class, 'index']);
Route::post('/add/menu/{id}', [dashboardController::class, 'addMenu'])->name('add.menu');
Route::get('/keranjang', [dashboardController::class, 'keranjang']);
Route::post('/keranjang/tambah/{id}', [dashboardController::class, 'tambah'])->name('keranjang.tambah');
Route::post('/keranjang/kurangi/{id}', [dashboardController::class, 'kurangi'])->name('keranjang.kurangi');

Route::get('/pesanan', [dashboardController::class, 'pesanan']);
Route::post('/orders/{order}/complete', [dashboardController::class, 'complete'])->name('orders.complete');
Route::delete('/orders/{order}', [dashboardController::class, 'destroy'])->name('orders.destroy');

Route::post('/checkout', [dashboardController::class, 'checkout'])->name('checkout');

Route::get('/login', [LoginController::class, 'dashboard']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboardadmin', [dashboardController::class, 'dashboardadmin']);

Route::get('/menu', [dashboardController::class, 'menu']);
Route::get('/tambahmenu', [dashboardController::class, 'tambahmenu']);
Route::post('/storemenu',[dashboardController::class, 'storemenu']);
Route::get('/editmenu/{id}',[dashboardController::class, 'editmenu']);
Route::put('/updatemenu/{id}',[dashboardController::class, 'updatemenu']);
Route::delete('/deletemenu/{id}',[dashboardController::class, 'deletemenu']);

Route::get('/listadmin',[dashboardController::class, 'listadmin']);
Route::get('/edituser/{id}',[dashboardController::class, 'edituser']);
Route::put('/updateuser/{id}',[dashboardController::class, 'updateuser']);
Route::delete('/deleteuser/{id}',[dashboardController::class, 'deleteuser']);

Route::get('/history',[dashboardController::class, 'history']);
Route::get('/export-order-history', [DashboardController::class, 'exportOrderHistory'])->name('export.order.history');
