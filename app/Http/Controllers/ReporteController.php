<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReporteController extends Controller
{
    public function index()
    {
        $reportes = DB::table('reporte')
            ->join('tipo_problema', 'reporte.id_tipo', '=', 'tipo_problema.id_tipo')
            ->join('estado', 'reporte.id_estado', '=', 'estado.id_estado')
            ->join('usuario', 'reporte.id_usuario', '=', 'usuario.id_usuario')
            ->select('reporte.*', 'tipo_problema.nombre as tipo', 'estado.nombre as estado', 'usuario.nombre as usuario')
            ->orderBy('reporte.fecha', 'desc')
            ->get();

        return view('reportes.index', compact('reportes'));
    }

    public function create()
    {
        $tipos = DB::table('tipo_problema')->get();
        return view('reportes.crear', compact('tipos'));
    }

    public function store(Request $request)
    {
        // Validamos que lleguen todos los datos necesarios
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'id_tipo' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
            'foto' => 'nullable|image'
        ]);

        // INSERT COMPLETO: Aquí incluimos 'id_estado' para que no dé el error 1364
        $id_reporte = DB::table('reporte')->insertGetId([
            'titulo'      => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha'       => now(),
            'id_usuario'  => Auth::id(), // El ID del ciudadano logueado
            'id_tipo'     => $request->id_tipo,
            'id_estado'   => 1, // <--- OBLIGATORIO: 1 es 'Pendiente' en tu tabla estado
            'latitud'     => $request->latitud,
            'longitud'    => $request->longitud,
        ]);

        // Guardar imagen si existe
        if ($request->hasFile('foto')) {
            $ruta = $request->file('foto')->store('reportes', 'public');
            DB::table('imagen')->insert([
                'ruta_imagen' => $ruta,
                'id_reporte'  => $id_reporte
            ]);
        }

        return redirect()->route('reportes.index');
    }

    public function updateEstado(Request $request)
    {
        DB::table('reporte')->where('id_reporte', $request->id_reporte)->update(['id_estado' => $request->id_estado]);
        return back();
    }

    public function storeComentario(Request $request)
    {
        DB::table('comentario')->insert([
            'contenido'  => $request->contenido,
            'id_reporte' => $request->id_reporte,
            'id_usuario' => Auth::id(),
            'fecha'      => now(),
        ]);
        return back();
    }
}