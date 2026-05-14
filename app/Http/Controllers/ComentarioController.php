<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validar que el comentario no esté vacío
        $request->validate([
            'contenido' => 'required|max:500',
            'id_reporte' => 'required|exists:reporte,id_reporte'
        ]);

        // 2. Guardar en la base de datos
        Comentario::create([
            'contenido' => $request->contenido,
            'id_reporte' => $request->id_reporte,
            'id_usuario' => Auth::id(), // ID del ciudadano logueado
            'fecha' => now()
        ]);

        // 3. Volver a la página de reportes con un mensaje de éxito
        return back()->with('success', 'Comentario publicado.');
    }
}