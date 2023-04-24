<x-layout>
    <main class="container-lg mt-5">
      <div class="col-sm-6 offset-sm-3">
        <h2>{{$tienda->nombre}}</h2>
        <p>{{$tienda->direccion}}</p>
        <p>{{$tienda->cp}}</p>
        <p>{{$tienda->provincia->nombre}}</p>
        <hr>
      </div>
      <form class="col-sm-6 offset-sm-3" method="post" action="{{route('datos')}}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="foto" class="form-label">Logo</label>
          <div class="row">
            <div class="col-12 text-center" id="contenedorlogo">
              @if($tienda->logo)
                <img class="img-fluid" src="storage/{{$tienda->logo}}">
              @endif
            </div>
          </div>
          <input type="file" class="form-control mt-1 @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
          <div class="invalid-feedback">
            @error('logo'){{$message}}@enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="foto" class="form-label">Foto</label>
          <div class="row">
            <div class="col-12 text-center" id="contenedorfoto">
              @if($tienda->foto)
                <img class="img-fluid" src="storage/{{$tienda->foto}}">
              @endif
            </div>
          </div>
          <input type="file" class="form-control mt-1 @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*">
          <div class="invalid-feedback">
            @error('foto'){{$message}}@enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="descripcion" class="form-label">Descripción</label>
          <textarea class="form-control" name="descripcion" id="descripcion" rows="3">{{$tienda->descripcion}}</textarea>
        </div>
        <div class="mb-3">
          <label for="envio" class="form-label">Coste del envío</label>
          <div class="input-group">
            <input type="number" name="envio" class="form-control @error('envio') is-invalid @enderror" id="envio" min="0" step="0.01" value="@if(old('envio')){{ old('envio')}}@else{{$tienda->coste_envio}}@endif">
            <span class="input-group-text">€</span>
            <div class="invalid-feedback">
              @error('envio'){{$message}}@enderror
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="gratis" class="form-label">Importe mínimo para envío gratis</label>
          <div class="input-group">
            <input type="number" name="gratis" class="form-control @error('gratis') is-invalid @enderror" id="gratis" min="0" step="0.01" value="@if(old('gratis')){{ old('gratis')}}@else{{$tienda->envio_gratis}}@endif">
            <span class="input-group-text">€</span>
            <div class="invalid-feedback">
              @error('gratis'){{$message}}@enderror
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="tiempo" class="form-label">Tiempo estimado de entrega</label>
          <input type="text" name="tiempo" class="form-control @error('tiempo') is-invalid @enderror" id="tiempo" maxlength="30" placeholder="Ej.: 24-48h" value="@if(old('tiempo')){{ old('tiempo')}}@else{{$tienda->tiempo_envio}}@endif">
          <div class="invalid-feedback">
            @error('tiempo'){{$message}}@enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="foto" class="form-label">Vídeo</label>
          @if($tienda->video)
            <div class="row" id="contenedorVideo">
              <div class="col-10 offset-1 col-sm-7 offset-sm-0">
                <video class="img-fluid" controls>
                  <source src="/storage/{{$tienda->video}}">
                  Your browser does not support the video tag.
                </video>
              </div>
              <div class="col-6 offset-3 mt-1 mt-sm-0 col-sm-4 offset-sm-1 text-center align-self-center">
                <button class="btn btn-danger" id="quitarVideo">Quitar vídeo actual</button>
              </div>
            </div>
          @endif
          <input type="file" class="form-control mt-1 @error('video') is-invalid @enderror" name="video" accept="video/avi,video/mpeg,video/mp4">
          <div class="invalid-feedback">
            @error('video'){{$message}}@enderror
          </div>
          <input type="hidden" id="borraVideo" name="borravideo" value="no">
        </div>
        <div class="mb-3">
          <label for="clave" class="form-label">Nueva contraseña</label>
          <input type="password" name="clave" class="form-control @error('clave') is-invalid @enderror" minlength="8" id="clave">
          <p class="form-text">Debe contener al menos 8 caracteres mezclando letras, números y símbolos</p>
          <div class="invalid-feedback">
            @error('clave'){{$message}}@enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="clave_confirmation" class="form-label">Repite la contraseña</label>
          <input type="password" name="clave_confirmation" class="form-control" minlength="8">
        </div>
        <div class="mb-3 text-center">
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
      </form>
    </main>
</x-layout>
<script type="text/javascript">

  logo.onchange = leerArchivo;
  foto.onchange = leerArchivo;

  function leerArchivo(e) {
    let contenedor = document.getElementById("contenedor"+e.target.id);
    contenedor.innerHTML="";
    var files = e.target.files;
    if (files.length > 0) {
      getBase64(files[0],contenedor);
    }
  };

  function getBase64(file,contenedor) {
     var reader = new FileReader();
     reader.readAsDataURL(file);
     reader.onload = function () {
      let foto = document.createElement('img');
      foto.classList.add('img-fluid');
      foto.src = reader.result;
      contenedor.append(foto);
     };
  }

  @if($tienda->video)
    quitarVideo.onclick = ()=>{
      contenedorVideo.innerHTML="";
      borraVideo.value = "si";
    }
  @endif
</script>