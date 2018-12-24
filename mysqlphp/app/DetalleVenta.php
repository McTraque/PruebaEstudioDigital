<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table="Detalle_venta";

    protected $fillable=['descripcion', 'valor', 'descuento', 'IVA', 'total', 'idVentas', 'idProducto'];
    public $timestamps=false;
}
