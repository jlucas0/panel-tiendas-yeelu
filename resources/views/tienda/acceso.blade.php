<x-layout>
    <main class="container-lg mt-5">
        <form class="col-sm-6 offset-sm-3" method="post" action="{{route('acceder')}}">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Clave</label>
              <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="mb-3">
              <input type="checkbox" class="form-check-input" name="recordar" id="recordar">
              <label for="recordar" class="form-check-label">Mantener sesión iniciada</label>
            </div>
            <div class="mb-3 text-center">
              <button type="submit" class="btn btn-primary">Acceder</button>
            </div>
            <div class="text-center">
                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalRecuperar">Recuperar contraseña</a>
            </div>
        </form>
    </main>
    <div class="modal" tabindex="-1" id="modalRecuperar">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="alert d-none" id="alertModal" role="alert">
                <span id="textoAlert"></span>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                  <label for="emailRecuperar" class="form-label">Email</label>
                  <input type="email" class="form-control" id="emailRecuperar" placeholder="Escribe tu email de acceso">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="botonSolicitar">Solicitar</button>
            </div>
        </div>
      </div>
    </div>
</x-layout>
<script type="text/javascript">
    botonSolicitar.onclick = ()=>{
        if(emailRecuperar.value){
            botonSolicitar.disabled = true;
            const datos = new FormData();
            datos.append('email', emailRecuperar.value);
            datos.append('_token', '{{csrf_token()}}');
            postData('{{route('recuperar-clave')}}', datos).then((data) => {
              alertModal.classList.remove('d-none');
              alertModal.classList.remove('alert-warning');
              alertModal.classList.remove('alert-success');
              alertModal.classList.remove('alert-danger');
              if(data.resultado == 2){
                alertModal.classList.add('alert-warning');
              }else if(data.resultado == 3){
                alertModal.classList.add('alert-danger');
              }else{
                alertModal.classList.add('alert-success');
              }
              textoAlert.innerText = data.mensaje;
              botonSolicitar.disabled = false;
            });
        }else{
            alertModal.classList.remove('d-none');
            alertModal.classList.add('alert-warning');
            textoAlert.innerText = "Escribe el correo";
        }
    };

    //https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch
    async function postData(url = "", data = {}) {
      // Default options are marked with *
      const response = await fetch(url, {
        method: "POST", // *GET, POST, PUT, DELETE, etc.
        body: data, // body data type must match "Content-Type" header
      });
      return response.json(); // parses JSON response into native JavaScript objects
    }
</script>