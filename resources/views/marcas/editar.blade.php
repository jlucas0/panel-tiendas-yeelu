<x-layout>
    <main class="container-lg mt-5">
		<a href="{{route('marcas')}}" class="btn btn-secondary offset-sm-3 mb-5">Volver</a>
        <form class="col-sm-6 offset-sm-3" method="post" action="#">
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre de la marca *</label>
              <input type="text" name="nombre" class="form-control" id="nombre" maxlength="150" required>
            </div>
            <div class="mb-3">
              <label for="foto" class="form-label">Foto</label>
              <div class="row">
                <div class="col-10 offset-1 col-sm-7 offset-sm-0">
                	<img class="img-fluid" src="https://upload.wikimedia.org/wikipedia/commons/d/db/Mercadona_Nuevo_Modelo_de_Tienda4.jpg">
                </div>
                <div class="col-6 offset-3 mt-1 mt-sm-0 col-sm-4 offset-sm-1 text-center align-self-center">
                	<button class="btn btn-danger">Quitar foto actual</button>
                </div>
              </div>
              <input type="file" class="form-control mt-1" name="foto" accept="image/*">
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label">Descripción</label>
              <textarea name="descripcion" class="form-control" id="descripcion" rows="4"></textarea>
            </div>
            <div class="mb-3 text-center">
              <button class="btn btn-danger me-4">Borrar</button>
              <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </main>
</x-layout>