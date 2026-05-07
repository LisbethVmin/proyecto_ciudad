<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    // LISTAR REPORTES
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

    // GUARDAR REPORTE
   public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        'id_tipo' => 'required',
        'latitud' => 'required',
        'longitud' => 'required',
    ]);

    $rutaImagen = null;

    // 📸 GUARDAR IMAGEN
    if ($request->hasFile('imagen')) {
        $archivo = $request->file('imagen');
        $nombre = time() . "_" . $archivo->getClientOriginalName();
        $archivo->move(public_path('img'), $nombre);
        $rutaImagen = $nombre;
    }

    // 🧠 GUARDAR REPORTE
    $idReporte = DB::table('reporte')->insertGetId([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'id_usuario' => auth()->user()->id_usuario,
        'id_estado' => 1,
        'id_tipo' => $request->id_tipo,
        'fecha' => now(),
        'latitud' => $request->latitud,
        'longitud' => $request->longitud,
    ]);

    // 🖼️ GUARDAR IMAGEN EN TABLA
    DB::table('imagen')->insert([
        'ruta_imagen' => $rutaImagen,
        'id_reporte' => $idReporte
    ]);

    return redirect('/reportes')->with('success', 'Reporte creado correctamente');
}
}