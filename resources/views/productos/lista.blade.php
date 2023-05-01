<style type="text/css">
	th.ordenable{
		cursor: pointer;
	}
	td img{
		width: 100px;
	}
	td{
		vertical-align: middle;
	}
	#filtros{
		cursor: pointer;
	}
	#filtros span{
		transition: all ease-in 0.3s;
		display: inline-block;
	}
	#filtros.abierto span{
		transform: rotate(180deg);
	}
	#panelFiltros{
		overflow: hidden;
		height: 0;
		transition: all ease-in 0.3s;
	}
</style>
<x-layout>

	<main class="container-lg pt-3">
		<h3 id="filtros">Filtros <span>▼</span></h3>
		<div id="panelFiltros">
			<div class="row">
				<div class="col-12 col-sm-4 mb-2">
					<input type="text" class="form-control" placeholder="Nombre" id="filtroNombre">
				</div>
				<div class="col-12 col-sm-4 mb-2">
					<select class="form-select" id="filtroMarca">
						<option>Marca</option>
					</select>
				</div>
				<div class="col-12 col-sm-4 mb-2">
					<select class="form-select" id="filtroCategoria">
						<option>Categoría</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-sm-4 mb-2">
					<input type="text" class="form-control" placeholder="Código" id="filtroCodigo">
				</div>
				<div class="col-12 col-sm-4 mb-2">
					<select class="form-select" id="filtroEstado">
						<option value="1">Activos</option>
						<option value="-1">Inactivos</option>
						<option value="2">Todos</option>
					</select>
				</div>
			</div>
		</div>
		<div class="mt-3">
			<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDescuento">Aplicar descuento a listados</button>
			<a href="{{route('crear-producto')}}" class="btn btn-success">Nuevo Producto</a>
		</div>
		<div class="table-responsive mt-5">
			<table class="table table-hover">
				<thead>
				    <tr>
				      <th scope="col" class="ordenable">Código ▲</th>
				      <th scope="col">Foto</th>
				      <th scope="col">Nombre</th>
				      <th scope="col">Precio</th>
				      <th scope="col">Descuento</th>
				      <th scope="col">Categoría</th>
				      <th scope="col">Marca</th>
				      <th scope="col">Activo</th>
				      <th scope="col">Acciones</th>
				    </tr>
				  </thead>
				  <tbody id="tabla">
				    
				  </tbody>
			</table>
		</div>
	</main>
	<div class="modal fade" tabindex="-1" id="modalDescuento">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mb-3">
                  <label for="descuento" class="form-label">Descuento</label>
                  <div class="row">
                  	<div class="col-9">
                  		<input type="number" class="form-control" id="descuento" placeholder="Cantidad" step="0.01">
                  	</div>
                  	<div class="col-3">
                  		<select id="tipoDescuento" class="form-select col-2"><option val="por">%</option><option val="pre">€</option></select>
                  	</div>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="descuento" class="form-label">Fecha fin</label>
                  <input type="date" class="form-control" name="fecha" id="fecha">
                  <div class="form-text">Fecha de fin (incluida). Sin fecha, el descuento será permanente hasta que se cancele manualmente.</div>
              	</div>
              	<h4>Precio final: XXX</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Aplicar</button>
            </div>
        </div>
      </div>
  </div>
</x-layout>
<script type="text/javascript">
	//Mostrar/ocultar filtros
	filtros.onclick = ()=>{
		let altura = panelFiltros.children[0].offsetHeight + panelFiltros.children[1].offsetHeight;
		if(filtros.classList.contains('abierto')){
			filtros.classList.remove('abierto');
			panelFiltros.style.height = 0;
		}else{
			filtros.classList.add('abierto');
			panelFiltros.classList.add('abierto');
			panelFiltros.style.height = altura+'px';
		}
	}
	//Cargar datos
	let datos = [
		@foreach($referencias as $referencia)
			{"id":{{$referencia->id}},"codigo":"{{$referencia->codigo}}","foto":"@if(count($referencia->producto->fotos)){{$referencia->producto->fotos[0]->direccion}}@endif","nombre":"{{$referencia->producto->nombre}}","precio":{{$referencia->precio}},"descuento":@if($referencia->descuento){{$referencia->descuento}}@else""@endif,"finDescuento":"{{$referencia->fin_descuento}}","categoria":"{{$referencia->producto->subsubcategoria->subcategoria->nombre.' - '.$referencia->producto->subsubcategoria->nombre}}","marca":"{{$referencia->producto->marca->nombre}}","estado":@if($referencia->disponible && $referencia->producto->confirmado){{1}}@elseif($referencia->disponible && !$referencia->producto->confirmado){{-1}}@else{{0}}@endif},
		@endforeach
	];
	let datosVisibles = [];
	//Aplicar filtros
	filtroEstado.onchange = pintarTabla;

	function aplicarFiltros(){
		datosVisibles = [];
		//Nombre, marca, categoría, código
		for(let producto of datos){
			let visible = true;
			//Filtro de estado
			if((filtroEstado.value=='1'&&producto.estado!=1) || (filtroEstado.value=='-1'&&producto.estado==1)){
				visible = false;
			}

			if(visible){
				datosVisibles.push(producto);
			}
		}
	}
	
	//Ordenar tabla

	//Pintar datos
	function pintarTabla(){
		aplicarFiltros();
		tabla.innerHTML = "";
		for(let producto of datosVisibles){
			let fila = document.createElement("tr");
			if(producto.estado == 1){
				fila.classList.add("table-success");
			}else if(producto.estado==-1){
				fila.classList.add("table-dark");
			}else{
				fila.classList.add("table-secondary");
			}
			
			let celdaCodigo = document.createElement("td");
			celdaCodigo.innerText = producto.codigo;
			fila.append(celdaCodigo);

			let celdaFoto = document.createElement("td");
			if(producto.foto){
				let foto = document.createElement("img");
				foto.classList.add("img-thumbnail");
				foto.src = "/storage/"+producto.foto;
				celdaFoto.append(foto);
			}
			fila.append(celdaFoto);

			let celdaNombre = document.createElement("td");
			celdaNombre.innerText = producto.nombre;
      fila.append(celdaNombre);

      let celdaPrecio = document.createElement("td");
      if(producto.descuento){
      	let original = document.createElement("s");
      	original.innerText = producto.precio;
      	celdaPrecio.append(original);
      	celdaPrecio.append(" "+(producto.precio-producto.descuento)+" €");
      	if(producto.finDescuento){
      		let salto = document.createElement("br");
      		celdaPrecio.append(salto);
      		celdaPrecio.append("Hasta "+producto.finDescuento);
      	}
      }else{
      	celdaPrecio.innerText = producto.precio+" €";
      }
      fila.append(celdaPrecio);

      let celdaDescuento = document.createElement("td");
      let botonDescuento = document.createElement("button");
      botonDescuento.classList.add("btn");
      if(producto.descuento){
      	botonDescuento.classList.add("btn-danger");
      	botonDescuento.innerText = "Quitar";
      }else{
      	botonDescuento.classList.add("btn-primary");
      	botonDescuento.innerText = "Aplicar";
      }
      if(producto.estado == 1){
      	celdaDescuento.append(botonDescuento);
      }
      fila.append(celdaDescuento);

      let celdaCategoria = document.createElement("td");
      celdaCategoria.innerText = producto.categoria;
      fila.append(celdaCategoria);

      let celdaMarca = document.createElement("td");
      celdaMarca.innerText = producto.marca;
      fila.append(celdaMarca);


      let celdaEstado = document.createElement("td");
      let checkEstado = document.createElement("input");
      checkEstado.type = "checkbox";
      checkEstado.classList.add("form-check-control");
      if(producto.estado == 1){
				checkEstado.checked = true;
				celdaEstado.append(checkEstado);				
			}else if(producto.estado==-1){
				let badge = document.createElement("span");
				badge.classList.add("badge");
				badge.classList.add("bg-warning");
				badge.innerText = "Pendiente aprobación";
				celdaEstado.append(badge);
			}else{
				celdaEstado.append(checkEstado);				
			}
			fila.append(celdaEstado);

			let celdaAccion = document.createElement("td");
			let botonEditar = document.createElement("button");
			botonEditar.classList.add("btn");
			botonEditar.classList.add("btn-secondary");
			botonEditar.innerText = "Editar";
			celdaAccion.append(botonEditar);
			fila.append(celdaAccion);

			tabla.append(fila);
		}
	}

	pintarTabla();
	//Aplicar descuentos individuales
	//Aplicar descuentos masivos
	//Activar/Desactivar producto
</script>