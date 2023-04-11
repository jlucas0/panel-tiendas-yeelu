<x-layout>
    <main class="container-lg mt-5">
        <form class="col-sm-6 offset-sm-3" method="post" action="#">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Clave</label>
              <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="mb-3 text-center">
              <button type="submir" class="btn btn-primary">Acceder</button>
            </div>
            <div class="text-center">
                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalRecuperar">Recuperar contraseña</a>
            </div>
        </form>
    </main>
    <div class="modal" tabindex="-1" id="modalRecuperar">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mb-3">
                  <label for="emailRecuperar" class="form-label">Email</label>
                  <input type="email" class="form-control" id="emailRecuperar" placeholder="Escribe tu email de acceso">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Solicitar</button>
            </div>
        </div>
      </div>
    </div>
</x-layout>