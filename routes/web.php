<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JogosController;
use App\Http\Controllers\JogadoresController;
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

Route::get('/',[JogosController::class, 'index']);

Route::post('/jogos/create', [JogosController::class, 'create']);

Route::get('/jogos/detail/{id}', [JogosController::class,'detail']);

Route::get('/jogos/delete/{id}', [JogosController::class, 'delete']);

Route::get('/jogos/deleteConfirmation/{id}', [JogosController::class, 'deleteConfirmation']);

Route::post('/jogos/confirmPresence', [JogosController::class, 'confirmPresence']);

Route::post('/jogos/sort', [JogosController::class, 'sort']);

Route::get('/jogadores',[JogadoresController::class, 'index']);

Route::get('/jogadores/find/{id}',[JogadoresController::class, 'find']);

Route::post('/jogadores/edit',[JogadoresController::class, 'edit']);

Route::post('/jogadores/create', [JogadoresController::class, 'create']);

Route::get('/jogadores/delete/{id}', [JogadoresController::class, 'delete']);