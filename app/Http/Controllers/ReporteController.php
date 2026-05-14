<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            ->orderBy('reporte.fecha', 'desc')
            ->get();

        return view('reportes.index', compact('reportes'));
    }

    // GUARDAR REPORTE USANDO STORAGE
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:150',
            'descripcion' => 'required',
            'imagen' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'id_tipo' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
        ]);

        $path = null;

        // 📸 GUARDAR IMAGEN EN STORAGE/APP/PUBLIC/REPORTES
        if ($request->hasFile('imagen')) {
            // Se guarda en el disco 'public' y se genera un nombre único automáticamente
            $path = $request->file('imagen')->store('reportes', 'public');
        }

        // 🧠 GUARDAR REPORTE EN LA BD
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

        // 🖼️ GUARDAR LA RUTA (URL RELATIVA) EN LA TABLA IMAGEN
        DB::table('imagen')->insert([
            'ruta_imagen' => $path, // Ejemplo: "reportes/archivo.jpg"
            'id_reporte' => $idReporte
        ]);

        return redirect('/reportes')->with('success', 'Reporte creado y evidencia guardada en storage.');
    }

    // ACTUALIZAR ESTADO (PARA ADMIN)
    public function updateEstado(Request $request)
    {
        if (auth()->user()->rol !== 'admin') {
            return back()->with('error', 'Acceso denegado.');
        }

        DB::table('reporte')
            ->where('id_reporte', $request->id_reporte)
            ->update(['id_estado' => $request->id_estado]);

        return back()->with('success', 'Estado del reporte actualizado.');
    }
}