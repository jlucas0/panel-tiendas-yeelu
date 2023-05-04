<style type="text/css">
  .form-label{
    font-weight: bold;
  }
</style>
<x-layout>
    <main class="container-lg mt-5">
  		<a href="{{route('productos')}}" class="btn btn-secondary offset-sm-3 mb-5">Volver</a>
      <form class="col-sm-6 offset-sm-3" method="post" action="{{route('modificar-producto')}}">
        @csrf
        <input type="hidden" name="id" value="{{$referencia->id}}">
        <h3>{{$referencia->producto->nombre}} {{$referencia->producto->peso}}{{$referencia->producto->unidad}} - {{$referencia->producto->marca->nombre}}</h3>
        <p>Sólo la información relativa a la venta puede modificarse.</p>
        <div class="mb-3">
          <label for="codigo" class="form-label">Código *</label>
          <input type="text" name="codigo" class="form-control @error('codigo') is-invalid @enderror" id="codigo" maxlength="150" placeholder="Código único para identificar el producto" required value="@if(old('codigo')){{old('codigo')}}@else{{$referencia->codigo}}@endif" />
          <div class="invalid-feedback">
            @error('codigo'){{$message}}@enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="precio" class="form-label">Precio *</label>
          <div class="input-group">
            <input type="number" name="precio" class="form-control @error('precio') is-invalid @enderror" id="precio" min="0.01" step="0.01" required value="@if(old('precio')){{old('precio')}}@else{{$referencia->precio}}@endif" @if($referencia->descuento) readonly @endif />
            <span class="input-group-text">€</span>
          </div>
          
          <div class="invalid-feedback">
            @error('precio'){{$message}}@enderror
          </div>
          <p class="form-text @if($referencia->descuento) text-warning @endif">@if($referencia->descuento){{'El producto tiene un descuento activo, por lo que no se puede modificar el precio base.'}}@else{{'El precio base del artículo. En el listado se podrán aplicar los descuentos temporales.'}}@endif</p>
        </div>
        <div class="mb-3">
          <label class="form-label" for="maximo">Unidades máximas por pedido</label>
          <input type="number" class="form-control @error('maximo') is-invalid @enderror" id="maximo" name="maximo" min="1" step="1" value="@if(old('maximo')){{old('maximo')}}@else{{$referencia->maximo_venta}}@endif">
          <div class="invalid-feedback">
            @error('maximo'){{$message}}@enderror
          </div>
          <p class="form-text">Rellena este campo si deseas restringir el máximo de unidades de este producto por pedido.</p>
        </div>
        <div class="mb-3 text-center">
          <button id="botonBorrar" class="btn btn-danger me-4">Borrar</button>
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
      </form>
    </main>
</x-layout>
<script type="text/javascript">
  botonBorrar.onclick = borrar;
  function borrar(ev){
    ev.preventDefault();
    if(confirm("¿Deseas borrar el producto?")){
      window.location = '{{route('borrar-producto',["id"=>$referencia->id])}}'
    }
  }
</script>