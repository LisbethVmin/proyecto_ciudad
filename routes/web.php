<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ReporteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reportes', [ReporteController::class, 'index'])->middleware('auth');
Route::get('/crear-reporte', function () {
    return view('reportes.crear');
})->middleware('auth');
Route::post('/guardar-reporte', [ReporteController::class, 'store'])->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/mapa', function () {
    $reportes = DB::table('reporte')
        ->leftJoin('imagen', 'reporte.id_reporte', '=', 'imagen.id_reporte')
        ->select('reporte.*', 'imagen.ruta_imagen')
        ->get();

    return view('mapa', compact('reportes'));
});

require __DIR__.'/auth.php';