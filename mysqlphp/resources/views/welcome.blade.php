<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Facturación</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    </head>
    <body>

      <div class="container">
        @if(Session::has('registro'))
        <div class="alert alert-info">{{ Session::get('registro') }}</div>
        @endif
        <form action="registrarVenta" method="POST">
          @csrf
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Código (Consecutivo)</label>
              <input type="text" class="form-control" id="consecutivo" name="consecutivo" placeholder="Código">
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Descripción</label>
              <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción">
            </div>
            <div class="form-group col-md-4">
              <label for="inputState">Cliente</label>
              <select id="cliente" class="form-control" name="cliente">
                <option selected>seleccione un cliente...</option>
                @foreach($clientes as $cliente)
                <option  value="{{ $cliente->idCliente }}">{{ $cliente->nombre }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Producto</label>
                <select id="producto" class="form-control" onchange="getValue(this.value)" name="producto">
                  <option selected>Seleccione un producto...</option>
                  @foreach($productos as $producto)
                  <option  value="{{ $producto->idProducto }}">{{ $producto->descripcion }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="inputEmail4">Valor unitario</label>
                <input type="text" readonly  class="form-control" id="valor" placeholder="Valor">
              </div>
          </div>
          <div class="row">
          <div class="form-group col-md-4">
            <label for="inputEmail4">Cantidad</label>
            <input type="text" class="form-control" id="cantidad" placeholder="Cantidad">
          </div>
          <div class="form-group col-md-4">
            <label for="inputEmail4">descuento</label>
            <input type="text" class="form-control" id="descuento" placeholder="Descuento">
          </div>
          <div class="form-group col-md-4">
            <label for="inputPassword4">IVA</label>
            <input type="text" class="form-control" id="iva" placeholder="IVA">
          </div>
        </div>
          <div class="mb-4">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Valor unitario</th>
                  <th>Cantidad</th>
                  <th>Porcentaje IVA</th>
                  <th>Valor IVA</th>
                  <th>Porcentaje descuento con IVA</th>
                  <th>Valor descuento</th>
                  <th>Total</th>
                <th><button class="btn btn-outline-primary" type="button" onclick="agregar()">+</button</th>
                </tr>
                <tbody id="tablaVenta">

                </tbody>
              </thead>
            </table>
            </div>
            <button type="submit" class="btn btn-outline-primary">Registrar</button>
          </form>
      </div>



        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script type="text/javascript">

          function getValue(id){
            $.get(`getValue/${id}`).done(function(response){
              $('#valor').val(response.valor)
            })
          }

          function agregar(){
            iva=($('#iva').val()/100);
            descuento=($('#descuento').val()/100);
            total=$('#valor').val()*$('#cantidad').val();
          totalIva=total+(total*iva);
          totalDescuento=totalIva-(totalIva*descuento);
            $('#tablaVenta').append(`<tr>
              <td><input type="text" class="form-control" readonly value="`+$('#producto option:selected').text()+`" name="producto[]">
              <input type="hidden" class="form-control" readonly value="`+$('#producto').val()+`" name="idProducto[]"></td>
              <td><input type="text" class="form-control" readonly value="`+$('#valor').val()+`" name="valor[]"></td>
              <td><input type="text" class="form-control" readonly value="`+ $('#cantidad').val()+`" name="cantidad[]"></td>
              <td><input type="text" class="form-control" readonly value="`+ iva +`" name="iva[]"></td>
              <td><input type="text" class="form-control" readonly value="`+ (total*iva) +`" name="ivaValor[]"></td>
              <td><input type="text" class="form-control" readonly value="`+ descuento +`" name="descuento[]"></td>
              <td><input type="text" class="form-control" readonly value="`+ (totalIva*descuento) +`" name="descuentoValor[]"></td>
              <td><input type="text" class="form-control" readonly value="`+ totalDescuento +`" name="total[]">
              <input type="hidden" class="form-control" readonly value="`+ $('#valor').val()*$('#cantidad').val() +`" name="subtotal[]"></td>
              </tr>`);
          }
        </script>
    </body>
</html>
