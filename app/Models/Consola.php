<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Consola extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'ruta_imagen',
        'money',
    ];

    public function tableros() : BelongsToMany
    {
        return $this->belongsToMany(Tablero::class, 'tableros_consolas', 'consola_id', 'tablero_id');
    }
}
