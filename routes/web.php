<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;

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

// Comentario de ejemplo
Route::get('/', function () {
    return view('welcome');
});

// Rutas con recursos

Route::Resources([
    'categoria' => CategoriaController::class,
    'producto' => ProductoController::class,
    'cliente' => ClienteController::class,
    'pedido' => PedidoController::class,
    //'producto' => ProductoController::class,
]);
