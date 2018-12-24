<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Venta;
use App\DetalleVenta;
class ventaController extends Controller
{
    public function index()
    {
      $clientes =DB::table('Cliente')->get();
      $productos =DB::table('Producto')->get();
      return view('welcome', compact('clientes','productos'));

    }

    public function getValue($id)
    {
      $valorProducto=DB::table('Producto')->where('idProducto',$id)->first();
      return response()->json($valorProducto);
    }

    public function store(Request $request)
    {
      $totalNeto=$request['total'];
      $totalNeto=array_sum($totalNeto);
      foreach ($request['idProducto'] as $key => $value) {
        $registroVenta=Venta::Create([
          'consecutivo' => $request['consecutivo'],
          'subtotal' => $request['subtotal'][$key],
          'descuento' => $request['descuentoValor'][$key],
          'IVA' => $request['ivaValor'][$key],
          'totalNeto' => $request['total'][$key],
          'idCliente' => $request['cliente'],
          'cantidad' => $request['cantidad'][$key],
        ]);
          $detalleventa=DetalleVenta::create([
          'descripcion' => $request['descripcion'],
          'valor' =>  $request['valor'][$key],
          'descuento' => $request['descuento'][$key],
          'IVA' => $request['iva'][$key],
          'total' => $totalNeto,
          'idVentas' => $registroVenta->id,
          'idProducto' => $request['idProducto'][$key]
        ]);
      }
      return back()->with('registro','Venta registrada con exito.');
    }
}
