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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['id', 'codigo', 'categorias_id', 'imagen', 'anuncio', 'destacado', 'destacado_comienzo', 'destacado_final', 'oculto', 'created_at'];

    /**
     * Calculate the VAT.
     *
     * @return int
     */
    public function getImporteIvaAttribute()
    {
        return round($this->precio * $this->iva / 100.0, 2);
    }

    /**
     * Get price without discounts.
     * 
     * @return int
     */
    public function getPrecioSinDescuentoAttribute()
    {
        return $this->precio + $this->getImporteIvaAttribute();
    }

    /**
     * Get price without VAT.
     * 
     * @return int
     */
    public function getPrecioTotalAttribute()
    {
        $precioConIva = $this->precio + $this->getImporteIvaAttribute();
        return round($precioConIva - ($precioConIva / 100.0 * $this->descuento), 2);
    }
}
