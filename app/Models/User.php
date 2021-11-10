<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     *
     * Set table name
     *
     */
    protected $table = "usuarioxperfil";

    protected $fillable = [
        'id',
        'usuario_id',
        'leiloeiro_id',
        'administradorjudicial_id',
        'comitente_id',
        'bomvalor_id'
    ];

    public $timestamps = false;
}
