<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'correo_electronico',
        'contrasena',
        'rol'
    ];

    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    // Indica a Laravel cuál es la columna de la contraseña
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    // ESTO CORRIGE EL ERROR DE "ENTRA Y SALE"
    // Laravel necesita el ID numérico para mantener la sesión activa
    public function getAuthIdentifierName()
    {
        return 'id_usuario';
    }

    public function username()
    {
        return 'correo_electronico';
    }
}