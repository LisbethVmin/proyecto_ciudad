<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ReporteController;

Route::get('/', function () {
    return view('welcome');
});

// Agrupamos todas las rutas que requieren estar logueado y verificado
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/reportes', [ReporteController::class, 'index']);
    Route::get('/crear-reporte', function () {
        return view('reportes.crear');
    });
    Route::post('/guardar-reporte', [ReporteController::class, 'store']);
    Route::post('/estado', [ReporteController::class, 'updateEstado']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::post('/comentar', [ComentarioController::class, 'store'])->name('comentarios.store');
});

Route::get('/mapa', function () {
    $reportes = DB::table('reporte')
        ->leftJoin('imagen', 'reporte.id_reporte', '=', 'imagen.id_reporte')
        ->select('reporte.*', 'imagen.ruta_imagen')
        ->get();
    return view('mapa', compact('reportes'));
});

require __DIR__.'/auth.php';