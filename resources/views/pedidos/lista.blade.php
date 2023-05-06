<style type="text/css">
	td{
		vertical-align: middle;
	}
	.ordenable{
		cursor: pointer;
		white-space: nowrap;
	}
	.ordenable::after{
		content: ' -';
	}
	.ordenable.asc::after{
		content: ' ▲';
	}
	.ordenable.desc::after{
		content: ' ▼';
	}
	#historial{
		cursor: pointer;
	}
	#historial span{
		transition: all ease-in 0.3s;
		display: inline-block;
	}
	#historial.abierto span{
		transform: rotate(180deg);
	}
	#panelHistorial{
		overflow: hidden;
		height: 0;
		transition: all ease-in 0.3s;
	}
</style>
<x-layout>
	
	<main class="container-lg pt-3">
		<h3>Pedidos pendientes</h3>
		<div class="table-responsive mt-2">
			<table class="table table-hover table-striped">
				<thead>
				    <tr>
				      <th scope="col" class="ordenable" data-campo="numero">Número</th>
				      <th scope="col" class="ordenable" data-campo="fecha">Fecha</th>
				      <th scope="col" class="ordenable" data-campo="precio">Importe</th>
				      <th scope="col" class="ordenable" data-campo="estado">Estado</th>
				      <th scope="col"></th>
				    </tr>
				  </thead>
				  <tbody id="tabla">
				    
				  </tbody>
			</table>
		</div>
		<h3 id="historial" class="mt-5">Historial <span>▼</span></h3>
		<div id="panelHistorial">
			<div class="list-group list-group-flush w-50" id="pedidosHistorial">
				@foreach($terminados as $pedido)
			  		<a href="{{route('pedido',["id"=>$pedido->id])}}" target="_blank" class="list-group-item list-group-item-action">
			    #{{$pedido->id}} {{$pedido->created_at}} 
				    @if($pedido->estado =='completado')
				    <span class="badge bg-success float-end">Completado</span>
				    @else
				    <span class="badge bg-danger float-end">Cancelado</span>
				    @endif
				  </a>
				@endforeach
			</div>
			<button class="btn btn-primary" id="botonCargar">Cargar más</button>
		</div>
	</main>

</x-layout>
<script type="text/javascript">
	//Cargar datos
		let datos = [
			@foreach($pendientes as $pedido)
				{
					"numero":{{$pedido->id}},
					"fecha":"{{$pedido->created_at}}",
					"estado":@if($pedido->incidencias>0) -1 @elseif($pedido->estado == 'pendiente') 0 @elseif($pedido->estado == 'aceptado') 1 @elseif($pedido->estado == 'preparado') 2 @elseif($pedido->estado == 'enviado') 3 @endif,
					"precio":{{$pedido->precio}}
				},
			@endforeach
		];

	//Ordenar tabla

		var campoOrdenar, direccionOrdenar;

		for(let header of document.getElementsByClassName('ordenable')){
			header.onclick = ordenarTabla;
		}

		function ordenarTabla(evento){
			direccionOrdenar = 1;
			//Si está descendente, ponerlo ascendente
			if(evento.target.classList.contains('desc')){
				evento.target.classList.remove('desc');
				evento.target.classList.add('asc');
				direccionOrdenar = -1;
				campoOrdenar = evento.target.dataset.campo;
			}
			//Si está ascendente, quitar el orden
			else if(evento.target.classList.contains('asc')){
				evento.target.classList.remove('asc');
				campoOrdenar = 'id';
			}
			//Si está sin ordenar, ponerlo descendente
			else{
				//Quitar las clases de las demás
				for(let header of document.getElementsByClassName('ordenable')){
					header.classList.remove('asc');
					header.classList.remove('desc');
				}
				evento.target.classList.add('desc');
				campoOrdenar = evento.target.dataset.campo;
			}
			
			datos.sort(comparador);
			pintarTabla();
		}

		function comparador( el1, el2 ) {
			let resultado = 0;
			let dato1 = el1[campoOrdenar];
			let dato2 = el2[campoOrdenar];
			if(typeof dato1 == "string"){
				dato1 = dato1.toUpperCase();
				dato2 = dato2.toUpperCase();
			}
		  if ( dato1 < dato2 ){
		    resultado = -1 * direccionOrdenar;
		  }
		  else if ( dato1 > dato2 ){
		    resultado = 1 * direccionOrdenar;
		  }
		  return resultado;
		}

	//Pintar datos
		function pintarTabla(){
			tabla.innerHTML = "";
			for(let pedido of datos){

				let fila = document.createElement("tr");

				let celdaCodigo = document.createElement("td");
				celdaCodigo.innerText = pedido.numero;
				fila.append(celdaCodigo);

				let celdaFecha = document.createElement("td");
				celdaFecha.innerText = pedido.fecha;
	      		fila.append(celdaFecha);

	      		let celdaPrecio = document.createElement("td");
				celdaPrecio.innerText = pedido.precio+" €";
	      		fila.append(celdaPrecio);

	      		let celdaEstado = document.createElement("td");
				let etiquetaEstado = document.createElement("span");
				etiquetaEstado.classList.add('badge');
				switch(pedido.estado){
					case -1:
						etiquetaEstado.classList.add('bg-warning');
						etiquetaEstado.innerText = "Incidencia pendiente";
						break;
					case 0:
						etiquetaEstado.classList.add('bg-secondary');
						etiquetaEstado.innerText = "Pendiente";
						break;
					case 1:
						etiquetaEstado.classList.add('bg-dark');
						etiquetaEstado.innerText = "En preparación";
						break;
					case 2:
						etiquetaEstado.classList.add('bg-info');
						etiquetaEstado.innerText = "Pendiente recogida";
						break;
					case 3:
						etiquetaEstado.classList.add('bg-success');
						etiquetaEstado.innerText = "Enviado";
						break;
				}

				celdaEstado.append(etiquetaEstado);
	      		fila.append(celdaEstado);

	      		let celdaAccion = document.createElement("td");
				let botonEditar = document.createElement("a");
				botonEditar.classList.add("btn");
				botonEditar.classList.add("btn-secondary");
				botonEditar.innerText = "Editar";
				botonEditar.href = '{{route('pedido',["id"=>"fake"])}}'.replace("fake",pedido.numero);
				celdaAccion.append(botonEditar);
				fila.append(celdaAccion);

				tabla.append(fila);

				
			}
		}

		pintarTabla();

	//Ver historial
		let cargados = 20;
		historial.onclick = ()=>{
			let altura = 0;
			for(let child of panelHistorial.children){
				altura += child.offsetHeight;
			}
			if(historial.classList.contains('abierto')){
				historial.classList.remove('abierto');
				panelHistorial.style.height = 0;
			}else{
				historial.classList.add('abierto');
				panelHistorial.classList.add('abierto');
				panelHistorial.style.height = altura+'px';
			}
		}
		botonCargar.onclick = ()=>{
			getData().then((data)=>{
		      //Si es OK pintar los datos
		      if(data){
		        for(let pedido of data){
		        	let enlace = document.createElement("a");
		        	enlace.href = "{{route('pedido',["id"=>'fake'])}}".replace("fake",pedido.id);
		        	enlace.target = "_blank";
		        	enlace.classList.add('list-group-item');
		        	enlace.classList.add('list-group-item-action');
		        	enlace.innerText = `#${pedido.id} `+pedido.created_at.substr(0,19).replace("T","");
		        	let estado = document.createElement("span");
		        	estado.classList.add("badge");
		        	estado.classList.add("float-end");
		        	if(pedido.estado=='completado'){
		        		estado.classList.add("bg-success");
		        		estado.innerText = "Completado";
		        	}
		        	else{
		        		estado.classList.add("bg-danger");
		        		estado.innerText = "Cancelado";
		        	}
		        	enlace.append(estado);
		        	pedidosHistorial.append(enlace);
		        	cargados++;
		        }
		        //Si la respuesta ya da menos de 20 ocultar el botón
		        if(data.length<20){
		        	botonCargar.remove();
		        }
		        let altura = 0;
				for(let child of panelHistorial.children){
					altura += child.offsetHeight;
				}
		        panelHistorial.style.height = altura+'px';
		      }
		      //Si no, pintar alert de error
		      else{
		        alert("Se ha producido un error");
		      }

		    });
		}

	

	//Función AJAX
		async function getData(inicio){
		    //Enviar el post
		    const response = await fetch('{{route('cargar-pedidos')}}'+`?inicio=${cargados}`);
		    return response.json();
		}

</script>