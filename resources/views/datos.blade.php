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
              <label for="foto" class="form-label">Foto</label>
              <div class="d-flex align-items-center justify-content-around my-2">
                <img width="300" class="d-block" src="https://upload.wikimedia.org/wikipedia/commons/d/db/Mercadona_Nuevo_Modelo_de_Tienda4.jpg">
                <button class="btn btn-danger">Quitar foto actual</button>
              </div>
              <input type="file" class="form-control" name="foto" accept="image/*">
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
            <div class="mb-3 text-center">
              <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </main>
</x-layout>