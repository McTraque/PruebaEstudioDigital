<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'Ventas';

    protected $fillable = ['consecutivo', 'subtotal', 'descuento', 'IVA', 'totalNeto', 'idCliente', 'fechaVenta', 'cantidad'];

    public $timestamps = false;
}
