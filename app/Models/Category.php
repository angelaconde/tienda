<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categorias';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'anuncio',
        'codigo',
        'oculto',
    ];
}
