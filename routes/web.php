<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/admin', function () {
    return view('inicio');
});

Route::get("/admin/categoria/{id}/productos", [CategoriaController::class, 'categoria_por_producto'])->name("mostrar_productos");
// Rutas con recursos

Route::Resources([
    'categoria' => CategoriaController::class,
    'producto' => ProductoController::class,
    'cliente' => ClienteController::class,
    'pedido' => PedidoController::class,
    //'producto' => ProductoController::class,
]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
