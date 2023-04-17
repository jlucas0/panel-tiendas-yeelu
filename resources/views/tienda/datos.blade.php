<x-layout>
    <main class="container-lg mt-5">
        <form class="col-sm-6 offset-sm-3" method="post" action="#">
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre de la tienda *</label>
              <input type="text" name="nombre" class="form-control" id="nombre" maxlength="200" required>
            </div>
            <div class="mb-3">
              <label for="direccion" class="form-label">Dirección *</label>
              <input type="text" name="direccion" class="form-control" id="direccion" maxlength="200" placeholder="Ej.: Calle Mayor, 87" required>
            </div>
            <div class="mb-3">
              <label for="cp" class="form-label">Código Postal *</label>
              <input type="number" name="cp" class="form-control" id="cp" min="1000" max="53000" required>
            </div>
            <div class="mb-3">
              <label for="provincia" class="form-label">Provincia *</label>
              <select class="form-select" name="provincia" id="provincia" required>
                <option></option>
                @foreach($provincias as $provincia)
                  <option value="{{$provincia->codigo}}">{{$provincia->nombre}}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="foto" class="form-label">Logo *</label>
              <div class="row">
                <div class="col-12 text-center">
                  <img class="img-fluid" src="https://edicomgroup.es/dam/jcr:1d5f0f0a-a59b-46a0-88e9-3f653ba3fc3c/mercadona_integration.png">
                </div>
              </div>
              <input type="file" class="form-control mt-1" name="logo" accept="image/*">
            </div>
            <div class="mb-3">
              <label for="foto" class="form-label">Foto *</label>
              <div class="row">
                <div class="col-12">
                  <img class="img-fluid" src="https://upload.wikimedia.org/wikipedia/commons/d/db/Mercadona_Nuevo_Modelo_de_Tienda4.jpg">
                </div>
              </div>
              <input type="file" class="form-control mt-1" name="foto" accept="image/*">
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label">Descripción</label>
              <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label for="envio" class="form-label">Coste del envío</label>
              <div class="input-group">
                <input type="number" name="envio" class="form-control" id="envio" min="0" step="0.01" >
                <span class="input-group-text">€</span>
              </div>
            </div>
            <div class="mb-3">
              <label for="gratis" class="form-label">Importe mínimo para envío gratis</label>
              <div class="input-group">
                <input type="number" name="gratis" class="form-control" id="gratis" min="0" step="0.01" >
                <span class="input-group-text">€</span>
              </div>
            </div>
            <div class="mb-3">
              <label for="tiempo" class="form-label">Tiempo estimado de entrega</label>
              <input type="text" name="tiempo" class="form-control" id="tiempo" maxlength="30" placeholder="Ej.: 24-48h">
            </div>
            <div class="mb-3">
              <label for="foto" class="form-label">Vídeo</label>
              <div class="row">
                <div class="col-10 offset-1 col-sm-7 offset-sm-0">
                  <video class="img-fluid" controls>
                    <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                  </video>
                </div>
                <div class="col-6 offset-3 mt-1 mt-sm-0 col-sm-4 offset-sm-1 text-center align-self-center">
                  <button class="btn btn-danger">Quitar vídeo actual</button>
                </div>
              </div>
              <input type="file" class="form-control mt-1" name="video" accept="video/mp4">
            </div>
            <div class="mb-3">
              <label for="clave" class="form-label">Nueva contraseña</label>
              <input type="password" name="clave" class="form-control" minlength="8" id="clave">
              <p class="form-text">Debe contener al menos 8 caracteres mezclando letras, números y símbolos</p>
            </div>
            <div class="mb-3">
              <label for="confirma" class="form-label">Repite la contraseña</label>
              <input type="password" name="confirma" class="form-control" id="confirma" minlength="8">
            </div>
            <div class="mb-3 text-center">
              <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </main>
</x-layout>