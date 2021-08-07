<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AfiliadoController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KitController;

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


Route::middleware(['auth'])->group(function () {
    //Inicio
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    //Recursos ABMC
    Route::resources([
        'afiliados' => AfiliadoController::class,
        'asignaciones' => AsignacionController::class,
        'kits' => KitController::class
    ]);
    Route::get('/cargarStock',[KitController::class,'cargarStock'])->name('cargarStock');
    Route::post('/updateStock',[KitController::class,'updateStock'])->name('updateStock');
});

//Graficos
Route::get('/stock', [KitController::class, 'stock'])->name('stock');

Route::get('/kitsEntregados', [KitController::class, 'kitsEntregados'])->name('kitsEntregados');
Route::get('/graficoKitsEntregados', [KitController::class, 'graficoKitsEntregados'])->name('graficoKitsEntregados');

require __DIR__.'/auth.php';
