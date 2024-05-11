<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TablerosConsolas extends Model
{
    use HasFactory;

    protected $table = 'tableros_consolas';

    protected $fillable = [
        'tablero_id',
        'consola_id',
        'posicion',
    ];
}
