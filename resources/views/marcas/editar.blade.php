<x-layout>
    <main class="container-lg mt-5">
		<a href="{{route('marcas')}}" class="btn btn-secondary offset-sm-3 mb-5">Volver</a>
        <form class="col-sm-6 offset-sm-3" method="post" action="{{route('guardar-marca')}}" enctype="multipart/form-data">
          @csrf
          @if($marca)
            <input type="hidden" name="id" value="{{$marca->id}}">
          @endif
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la marca *</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre" maxlength="150" required value="@if(old('nombre')){{ old('nombre')}}@elseif($marca){{$marca->nombre}}@endif">
            <div class="invalid-feedback">
              @error('nombre'){{$message}}@enderror
            </div>
          </div>
          <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <div class="row" id="contenedorFoto">
              @if($marca && $marca->foto)
                <img class="img-fluid" src="/storage/{{$marca->foto}}"/>
              @endif
              <!--
              <div class="col-10 offset-1 col-sm-7 offset-sm-0" >
              	
              </div>
              <div class="col-6 offset-3 mt-1 mt-sm-0 col-sm-4 offset-sm-1 text-center align-self-center">
              	<button class="btn btn-danger">Quitar foto actual</button>
              </div>-->
            </div>
            <input type="file" class="form-control mt-1 @error('foto') is-invalid @enderror" name="foto" accept="image/*" id="foto">
            <div class="invalid-feedback">
              @error('foto'){{$message}}@enderror
            </div>
          </div>
          <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" id="descripcion" rows="4">@if($marca){{$marca->descripcion}}@endif</textarea>
          </div>
          <div class="mb-3 text-center">
            @if($marca)
              <a id="botonBorrar" class="btn btn-danger me-4" href="{{route('borrar-marca',['id'=>$marca->id])}}">Borrar</a>
            @endif
            <button type="submit" class="btn btn-primary">Actualizar</button>
          </div>
        </form>
    </main>
</x-layout>
<script type="text/javascript">

  foto.onchange = leerArchivo;
  botonBorrar.onclick = (e)=>{
    if(!confirm("¿Seguro que deseas borrar la marca?")){
      e.preventDefault();
    }
  };

  function leerArchivo() {
    contenedorFoto.innerHTML="";
    var files = foto.files;
    if (files.length > 0) {
      getBase64(files[0]);
    }
  };

  function getBase64(file) {
     var reader = new FileReader();
     reader.readAsDataURL(file);
     reader.onload = function () {
      let foto = document.createElement('img');
      foto.classList.add('img-fluid');
      foto.src = reader.result;
      contenedorFoto.append(foto);
     };
  }
</script>