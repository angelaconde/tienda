<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pedidos';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'id',
        'usuario_id',
        'envio',
        'email',
        'telefono',
        'name',
        'surname',
        'direccion',
        'cp',
        'poblacion',
        'provincia',
        'fecha',
        'estado',
        'users_id',
    ];
}
