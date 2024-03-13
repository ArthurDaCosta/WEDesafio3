<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarrinhoController;

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
    return view('login.index');
});

Route::get('/lunar/loja', [ProdutosController::class, 'index'])->name('loja.index');
Route::get('/lunar/login', [UserController::class, 'login'])->name('login.index');
Route::post('/lunar/login', [UserController::class, 'login'])->name('login.login');
Route::get('/lunar/logout', [UserController::class, 'logout'])->name('login.logout');
Route::get('/lunar/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::post('/lunar/carrinho', [CarrinhoController::class, 'store'])->name('carrinho.store');
Route::put('/lunar/carrinho', [CarrinhoController::class, 'update'])->name('carrinho.update');
Route::delete('/lunar/carrinho/id', [CarrinhoController::class, 'delete'])->name('carrinho.delete');
Route::get('/lunar/carrinho/clear', [CarrinhoController::class, 'clear'])->name('carrinho.clear'); 