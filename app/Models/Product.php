<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'articulos';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    protected $fillable = [
        'id',
        'nombre',
        'codigo',
        'categorias_id',
        'precio',
        'descuento',
        'imagen',
        'iva',
        'descripcion',
        'anuncio',
        'stock',
        'destacado',
        'destacado_comienzo',
        'destacado_final',
        'oculto',
        'created_at',
    ];
}
