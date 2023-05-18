<style type="text/css">
  img{
    cursor: pointer;
  }
  img.principal{
    border-color: #f2d775;
    box-shadow: 0 0 0 0.25rem rgb(255 199 0 / 34%);
  }
  #autocompletar{
    position: relative;
  }

  .autocomplete-items {
    position: absolute;
    border: 1px solid #d4d4d4;
    border-bottom: none;
    border-top: none;
    z-index: 99;
    /*position the autocomplete items to be the same width as the container:*/
    top: 100%;
    left: 0;
    right: 0;
  }
  .autocomplete-items div {
    padding: 10px;
    cursor: pointer;
    background-color: #fff;
    border-bottom: 1px solid #d4d4d4;
  }
  .autocomplete-items div:hover {
    /*when hovering an item:*/
    background-color: #e9e9e9;
  }
  .autocomplete-active {
    /*when navigating through the items using the arrow keys:*/
    background-color: DodgerBlue !important;
    color: #ffffff;
  }
  .form-label{
    font-weight: bold;
  }
</style>
<x-layout>
    <main class="container-lg mt-5">
  		<a href="{{route('productos')}}" class="btn btn-secondary offset-sm-3 mb-5">Volver</a>
      <form class="col-sm-6 offset-sm-3" method="post" action="{{route('guardar-producto')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="accion" id="accion" value="@if(old('accion')){{old('accion')}}@else{{'buscar'}}@endif">
        <h3>Datos generales</h3>
        <p>Esta información es común para todas las tiendas que vendan este producto.</p>
        <p>Puedes crearlo desde cero o elegir un producto existente.</p>
        <ul class="nav nav-tabs mb-3" id="tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button onclick="elegirAccion('buscar')" class="nav-link @if(!old('accion') || old('accion')=='buscar') active @endif"data-bs-toggle="tab" data-bs-target="#buscar-tab-contenido" type="button" role="tab" aria-controls="buscar-tab-contenido" aria-selected="@if(!old('accion') || old('accion')=='buscar')true@else false @endif">Buscar referencia</button>
          </li>
          <li class="nav-item" role="presentation">
            <button onclick="elegirAccion('crear')" class="nav-link @if(old('accion') && old('accion')=='crear') active @endif" data-bs-toggle="tab" data-bs-target="#crear-tab-contenido" type="button" role="tab" aria-controls="crear-tab-contenido" aria-selected="@if(old('accion') && old('accion')=='crear') true @else false @endif">Crear</button>
          </li>
        </ul>
        <div class="tab-content" id="tabContent">
          <div class="tab-pane fade @if(!old('accion') || old('accion')=='buscar') show active  @endif" id="buscar-tab-contenido" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div id="autocompletar">
              <input type="text" id="buscador" class="form-control @error('seleccionado') is-invalid @enderror" placeholder="Escribe el nombre, marca o referencia" autocomplete="off">
              <input type="hidden" name="seleccionado" id="seleccionado">
              <div class="invalid-feedback">
                @error('seleccionado'){{$message}}@enderror
              </div>
            </div>
          </div>
          <div class="tab-pane fade @if(old('accion') && old('accion')=='crear') show active @endif" id="crear-tab-contenido" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <p class="mb-3">AVISO: Si eliges crear el producto a mano, éste no estará disponible para la venta hasta que el equipo de Yeelu lo revise y confirme.</p>
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre *</label>
              <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre" maxlength="200" @if(old('nombre')) value="{{old('nombre')}}" @endif>
              <div class="invalid-feedback">
                @error('nombre'){{$message}}@enderror
              </div>
              <p class="form-text">Sólo el nombre, no indiques aquí ni peso ni marca. Esta información se adjuntará automáticamente.</p>
            </div>
            <div class="mb-3">
              <label for="categoria" class="form-label">Categoría *</label>
              <select class="form-select @error('categoria') is-invalid @enderror" name="categoria" id="categoria">
                <option></option>
                @foreach($categorias as $categoria)
                  <option value="{{$categoria->id}}" style="font-weight:bold" @if(old('categoria')&& old('categoria') == $categoria->id) selected @endif>{{$categoria->nombre}}</option>
                  @foreach($categoria->categorias as $subcategoria)
                    <option value="{{$subcategoria->id}}" @if(old('categoria')&& old('categoria') == $subcategoria->id) selected @endif>{{$subcategoria->nombre}}</option>
                    @foreach($subcategoria->categorias as $subsubcategoria)
                      <option value="{{$subsubcategoria->id}}" @if(old('categoria')&& old('categoria') == $subsubcategoria->id) selected @endif>- {{$subsubcategoria->nombre}}</option>
                    @endforeach
                  @endforeach
                @endforeach
              </select>
              <div class="invalid-feedback">
                @error('categoria'){{$message}}@enderror
              </div>         
            </div>
            <div class="mb-3">
              <label for="marca" class="form-label">Marca *</label>
              <div class="input-group">
                <select class="form-select @error('marca') is-invalid @enderror" name="marca" id="marca">
                  <option></option>
                  @foreach($marcas as $marca)
                    <option value="{{$marca->id}}" @if(old('marca')&& old('marca') == $marca->id) selected @endif>{{$marca->nombre}}</option>
                  @endforeach
                </select>
                <span class="input-group-text"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalMarca">Registrar nueva</button></span>
                <div class="invalid-feedback">
                  @error('marca'){{$message}}@enderror
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="subeFoto">Cargar fotos</label>
              <input type="file" class="form-control mt-1 @error('fotos.*') is-invalid @enderror" name="fotos[]" id="fotos" accept="image/*" multiple>
              <div class="invalid-feedback">
                @error('fotos.*'){{$message}}@enderror
              </div>
              <input type="hidden" name="fotoPrincipal" id="fotoPrincipal" />
              <div id="contenedorFotos">

              </div>
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label">Descripción</label>
              <textarea name="descripcion" class="form-control" id="descripcion" rows="4" >@if(old('descripcion')){{old('descripcion')}}@endif</textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Peso/Volumen</label>
              <div class="row">
                <div class="col-8">
                  <input type="number" class="form-control @error('peso') is-invalid @enderror" name="peso" min="1" @if(old('peso')) value="{{old('peso')}}" @endif>
                </div>
                <div class="invalid-feedback">
                  @error('peso'){{$message}}@enderror
                </div>
                <div class="col-4">
                  <select class="form-select" name="unidad">
                    <option value="gr" @if(old('unidad') && old('unidad')=="gr") selected @endif>gr</option>
                    <option value="kg" @if(old('unidad') && old('unidad')=="kg") selected @endif>Kg</option>
                    <option value="l" @if(old('unidad') && old('unidad')=="l") selected @endif>L</option>
                    <option value="ml" @if(old('unidad') && old('unidad')=="ml") selected @endif>ml</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="ingredientes" class="form-label">Ingredientes</label>
              <textarea name="ingredientes" class="form-control" id="ingredientes" rows="4">@if(old('ingredientes')){{old('ingredientes')}}@endif</textarea>
            </div>
            <div class="mb-3">
              <label for="valores" class="form-label">Valores nutricionales (por cada 100 gr/ml de producto)</label>
              <table>
                <tbody>
                  <tr>
                    <td>KCAL</td>
                    <td>
                      <input type="number" class="form-control @error('kcal') is-invalid @enderror" name="kcal" min="0" step="1" @if(old('kcal')) value="{{old('kcal')}}"@endif>
                      <div class="invalid-feedback">
                        @error('kcal'){{$message}}@enderror
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Grasas</td>
                    <td>
                      <input type="number" class="form-control @error('grasas') is-invalid @enderror" name="grasas" min="0" step="0.01" @if(old('grasas')) value="{{old('grasas')}}"@endif>
                      <div class="invalid-feedback">
                        @error('grasas'){{$message}}@enderror
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Grasas saturadas</td>
                    <td>
                      <input type="number" class="form-control @error('saturadas') is-invalid @enderror" name="saturadas" min="0" step="0.01" @if(old('saturadas')) value="{{old('saturadas')}}"@endif>
                      <div class="invalid-feedback">
                        @error('saturadas'){{$message}}@enderror
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Hidratos de carbono</td>
                    <td>
                      <input type="number" class="form-control @error('hidratos') is-invalid @enderror" name="hidratos" min="0" step="0.01" @if(old('hidratos')) value="{{old('hidratos')}}"@endif>
                      <div class="invalid-feedback">
                        @error('hidratos'){{$message}}@enderror
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Azúcares</td>
                    <td>
                      <input type="number" class="form-control @error('azucar') is-invalid @enderror" name="azucar" min="0" step="0.01" @if(old('azucar')) value="{{old('azucar')}}"@endif>
                      <div class="invalid-feedback">
                        @error('azucar'){{$message}}@enderror
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Proteínas</td>
                    <td>
                      <input type="number" class="form-control @error('proteinas') is-invalid @enderror" name="proteinas" min="0" step="0.01" @if(old('proteinas')) value="{{old('proteinas')}}"@endif>
                      <div class="invalid-feedback">
                        @error('proteinas'){{$message}}@enderror
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Sal</td>
                    <td>
                      <input type="number" class="form-control @error('sal') is-invalid @enderror" name="sal" min="0" step="0.01" @if(old('sal')) value="{{old('sal')}}"@endif>
                      <div class="invalid-feedback">
                        @error('sal'){{$message}}@enderror
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="mb-3">
              <label class="form-label">Etiquetas</label>
              @error('etiquetas.*')
                <div class="text-danger">
                  {{$message}}
                </div>
              @endif
              <div class="row">
                @foreach($etiquetas as $grupo)
                  <div class="col">
                    <table class="table">
                      <thead>
                        <th>{{$grupo->nombre}}</th>
                      </thead>
                      <tbody>
                        @foreach($grupo->etiquetas as $etiqueta)
                          <tr>
                            <td>
                              <input class="form-check-input" name="etiquetas[]" type="checkbox" value="{{$etiqueta->id}}" id="etiqueta{{$etiqueta->id}}" @if(old('etiquetas') && in_array($etiqueta->id,old('etiquetas'))) checked @endif>
                              <label class="form-check-label" for="etiqueta{{$etiqueta->id}}">
                                {{$etiqueta->nombre}}
                              </label>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <hr>
        <h3>Datos propios</h3>
        <p>Esta información es específica para tu tienda.</p>
        <div class="mb-3">
          <label for="codigo" class="form-label">Código *</label>
          <input type="text" name="codigo" class="form-control @error('codigo') is-invalid @enderror" id="codigo" maxlength="150" placeholder="Código único para identificar el producto" required @if(old('codigo')) value="{{old('codigo')}}" @endif>
          <div class="invalid-feedback">
            @error('codigo'){{$message}}@enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="precio" class="form-label">Precio *</label>
          <div class="input-group">
            <input type="number" name="precio" class="form-control @error('precio') is-invalid @enderror" id="precio" min="0.01" step="0.01" required @if(old('precio')) value="{{old('precio')}}" @endif>
            <span class="input-group-text">€</span>
          </div>
          <div class="invalid-feedback">
            @error('precio'){{$message}}@enderror
          </div>
          <p class="form-text">El precio base del artículo. En el listado se podrán aplicar los descuentos temporales.</p>
        </div>
        <div class="mb-3">
          <label class="form-label" for="maximo">Unidades máximas por pedido</label>
          <input type="number" class="form-control @error('maximo') is-invalid @enderror" id="maximo" name="maximo" min="1" step="1" @if(old('maximo')) value="{{old('maximo')}}" @endif>
          <div class="invalid-feedback">
            @error('maximo'){{$message}}@enderror
          </div>
          <p class="form-text">Rellena este campo si deseas restringir el máximo de unidades de este producto por pedido.</p>
        </div>
        <div class="mb-3 text-center">
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </main>
    <div class="modal" tabindex="-1" id="modalMarca">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <p>Aquí puedes registrar una marca que no exista en Yeelu para poder asignarla a tus productos. Esta información se revisará junto a los demás datos.</p>
            </div>
            <div class="modal-body">
              <div class="alert alert-danger" style="display:none" id="errorMarca"></div>
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la marca *</label>
                <input type="text" class="form-control" id="nombreMarca">
              </div>
              <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control mt-1" accept="image/*" id="fotoMarca">
              </div>
              <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcionMarca" rows="4"></textarea>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="cerrarModalMarca" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button onclick="crearMarca()" id="botonCrearMarca" type="button" class="btn btn-primary">Crear y seleccionar</button>
            </div>
        </div>
      </div>
    </div>
</x-layout>

<script type="text/javascript">
  /*Autocompletar referencia*/
  var productos = [
    @foreach($productos as $producto)
    {"id":{{$producto->id}},"nombre":"{{$producto->codigo}} - {{$producto->nombre}} {{$producto->peso}} {{$producto->unidad}} - {{$producto->marca->nombre}}"},
    @endforeach
  ];
  autocomplete(document.getElementById("buscador"), productos);
  
  function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;

    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
      var contenedor, resultado, nombre, texto, busqueda, i, val = this.value;
      seleccionado.value = "";
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      contenedor = document.createElement("DIV");
      contenedor.setAttribute("id", this.id + "autocomplete-list");
      contenedor.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(contenedor);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        
        //Se busca si contiene el texto
        nombre = arr[i].nombre.toUpperCase();
        busqueda = val.toUpperCase();
        //En el caso de que escribas directamente el nombre entero se autoselecciona
        if(nombre == busqueda){
          seleccionado.value = arr[i].id;
          buscador.classList.remove('is-invalid');
        }
        else if(nombre.search(busqueda)>-1){
          //Se pinta en negrita la parte encontrada
          texto = nombre.substr(0,nombre.search(busqueda));
          texto += "<strong>";
          texto += nombre.substr(nombre.search(busqueda),busqueda.length);
          texto += "</strong>";
          //Ver si hay más partes
          let resto = nombre.substr(nombre.search(busqueda)+busqueda.length);
          while(resto.search(busqueda)>-1){
            texto += resto.substr(0,resto.search(busqueda));
            texto += "<strong>";
            texto += resto.substr(resto.search(busqueda),busqueda.length);
            texto += "</strong>";
            resto = resto.substr(resto.search(busqueda)+busqueda.length);
          }
          texto += resto;
          /*create a DIV element for each matching element:*/
          resultado = document.createElement("DIV");
          resultado.innerHTML = texto;
          resultado.innerHTML += "<input type='hidden' value='" + i + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          resultado.addEventListener("click", function(e) {
            /*insert the value for the autocomplete text field:*/
            inp.value = arr[this.getElementsByTagName("input")[0].value].nombre;
            seleccionado.value = arr[this.getElementsByTagName("input")[0].value].id;
            buscador.classList.remove('is-invalid');
            /*close the list of autocompleted values,
            (or any other open lists of autocompleted values:*/
            closeAllLists();
          });
          contenedor.appendChild(resultado);
        }
      }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
          /*If the arrow DOWN key is pressed,
          increase the currentFocus variable:*/
          currentFocus++;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 38) { //up
          /*If the arrow UP key is pressed,
          decrease the currentFocus variable:*/
          currentFocus--;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 13) {
          /*If the ENTER key is pressed, prevent the form from being submitted,*/
          e.preventDefault();
          if (currentFocus > -1) {
            /*and simulate a click on the "active" item:*/
            if (x) x[currentFocus].click();
          }
        }
    });
    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }
    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
        }
      }
    }
  /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
  }
  buscador.onchange = ()=>{
    if(buscador.value && !seleccionado.value){
      buscador.classList.add('is-invalid');
    }else{
      buscador.classList.remove('is-invalid');
    }
  }

  /*Cambio de pestaña*/
  function elegirAccion(seleccion){
    accion.value = seleccion;
  }

  /*Crear marca*/
  function crearMarca(){
    //Bloquear el modal
    botonCrearMarca.disabled = true;
    cerrarModalMarca.disabled = true;
    postData().then((data)=>{
      botonCrearMarca.disabled = false;
      cerrarModalMarca.disabled = false;
      //Si es OK, cerrar el modal y borrar los datos
      if(data.resultado){
        //Añadir la marca al selector y elegirlo
        let option = document.createElement("option");
        option.value = data.mensaje;
        option.innerText = nombreMarca.value;
        option.selected = true;
        marca.append(option);
        //Restablecer el formulario
        nombreMarca.value = "";
        descripcionMarca.value = "";
        fotoMarca.value = "";
        cerrarModalMarca.click();
      }
      //Si no, pintar alert de error
      else{
        errorMarca.style.display = "block";
        errorMarca.innerHTML = data.mensaje;
      }

    });
  }
  async function postData(){
    //Leer los datos
    var formData = new FormData();
    formData.append('nombre', nombreMarca.value);
    if(fotoMarca.files.length>0){
      formData.append('foto', fotoMarca.files[0]);
    }
    formData.append('descripcion', descripcionMarca.value);
    formData.append('_token', '{{csrf_token()}}');
    //Enviar el post
    const response = await fetch('{{route('crear-marca')}}', {
      method: "POST", // *GET, POST, PUT, DELETE, etc.
      body: formData, // body data type must match "Content-Type" header
    });
    return response.json();
  }

  /*Cargador de fotos*/
  fotos.onchange = leerArchivos;

  function leerArchivos() {
    contenedorFotos.innerHTML="";
    fotoPrincipal.value = "";
    let label = document.createElement("label");
    label.classList.add("form-label");
    label.classList.add("my-2");
    label.innerText = "Fotos seleccionadas";
    contenedorFotos.append(label);

    let p = document.createElement("p");
    p.innerText = "Pulsa en la que quieras marcar como foto principal";
    contenedorFotos.append(p);

    let row = document.createElement("div");
    row.classList.add("row");
    contenedorFotos.append(row);

    var files = fotos.files;
    for (let i = 0; i<files.length; i++) {
      getBase64(files[i],row,i);
      primera=false;
    }
  };

  function getBase64(file,contenedor,indice) {
     var reader = new FileReader();
     reader.readAsDataURL(file);

     let col = document.createElement("div");
     col.classList.add("col-6");
     col.classList.add("col-sm-4");
     col.classList.add("col-md-3");
     col.classList.add("mb-1");
     
     contenedor.appendChild(col);

     reader.onload = function () {
      let foto = document.createElement('img');
      foto.classList.add('img-thumbnail');
      foto.src = reader.result;
      if(indice==0){
        fotoPrincipal.value = 0;
        foto.classList.add("principal");
      }
      foto.onclick = ()=>{seleccionarFoto(indice)};
      col.append(foto);
     };
  }

  function seleccionarFoto(indice){
    fotoPrincipal.value=indice;
    document.getElementsByClassName('principal')[0].classList.remove('principal');
    contenedorFotos.children[2].children[indice].children[0].classList.add('principal');
  }
</script>