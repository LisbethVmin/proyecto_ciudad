<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index()
    {
        $reportes = DB::table('reporte')
            ->join('usuario', 'reporte.id_usuario', '=', 'usuario.id_usuario')
            ->join('estado', 'reporte.id_estado', '=', 'estado.id_estado')
            ->join('tipo_problema', 'reporte.id_tipo', '=', 'tipo_problema.id_tipo')
            ->select(
                'reporte.*',
                'usuario.nombre as usuario',
                'estado.nombre as estado',
                'tipo_problema.nombre as tipo'
            )
            ->get();

        return view('reportes.index', compact('reportes'));
    }

    public function store()
{
    $rutaImagen = null;

    if (request()->hasFile('imagen')) {
        $archivo = request()->file('imagen');
        $nombre = time() . "_" . $archivo->getClientOriginalName();
        $archivo->move(public_path('imagenes'), $nombre);
        $rutaImagen = $nombre;
    }

    DB::table('reporte')->insert([
    'titulo' => request('titulo'),
    'descripcion' => request('descripcion'),
    'id_usuario' => auth()->user()->id_usuario,
    'id_estado' => 1,
    'id_tipo' => request('id_tipo'),
    'fecha' => now()
]);

    $idReporte = DB::getPdo()->lastInsertId();

    if ($rutaImagen) {
        DB::table('imagen')->insert([
            'ruta_imagen' => $rutaImagen,
            'id_reporte' => $idReporte
        ]);
    }

    return redirect('/reportes');
}
}