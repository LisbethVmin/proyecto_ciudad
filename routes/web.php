<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReporteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () { return view('welcome'); });

Route::middleware(['auth', 'verified'])->group(function () {
    
    // DASHBOARD
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    // ESTA ES LA RUTA CRÍTICA - Asegúrate que no haya otra repetida abajo
    Route::get('/crear-reporte', [ReporteController::class, 'create'])->name('reportes.create');
    
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::post('/guardar-reporte', [ReporteController::class, 'store'])->name('reportes.store');
    Route::post('/estado', [ReporteController::class, 'updateEstado'])->name('reportes.estado');
    Route::post('/comentar', [ReporteController::class, 'storeComentario'])->name('comentarios.store');

    // PERFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';