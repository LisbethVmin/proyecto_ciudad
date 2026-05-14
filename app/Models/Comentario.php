<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentario';
    protected $primaryKey = 'id_comentario';
    public $timestamps = false; // Tu tabla no tiene created_at/updated_at

    protected $fillable = [
        'contenido',
        'id_usuario',
        'id_reporte',
        'fecha'
    ];
}