<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/lunar/login', [UserController::class, 'login'])->name('login.login');
Route::get('/lunar/logout', [UserController::class, 'logout'])->name('login.logout');
Route::get('/lunar/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::post('/lunar/carrinho', [CarrinhoController::class, 'store'])->name('carrinho.store');
Route::put('/lunar/carrinho', [CarrinhoController::class, 'update'])->name('carrinho.update');
Route::delete('/lunar/carrinho/id', [CarrinhoController::class, 'delete'])->name('carrinho.delete');
Route::delete('/lunar/carrinho', [CarrinhoController::class, 'clear'])->name('carrinho.clear'); 

