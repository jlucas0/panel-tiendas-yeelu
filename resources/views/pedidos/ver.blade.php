<x-layout>
	<main class="container pt-4">
		<div class="row">
			<h2 class="col-9 col-md-11">Pedido #{{$pedido->id}}</h2>
			<div class="col-3 col-md-1">
				@if($pedido->estado == "completado" || $pedido->estado == "cancelado")
					<button class="btn btn-secondary" onclick="window.close()">Cerrar</button>
				@else
					<a class="btn btn-secondary" href="{{route('pedidos')}}">Volver</a>
				@endif
			</div>
		</div>
		<div class="row my-3">
			<div class="col">Fecha de recepción: {{$pedido->created_at->format('d/m/Y H:i')}}</div>
			@php
			$estado = null;
			@endphp
			<div class="text-end col">Estado: 
				@if(count($incidenciasPendientes)>0)
					<span class="badge bg-warning">Incidencia pendiente</span> 
				@elseif($pedido->estado == 'pendiente')
					<span class="badge bg-secondary">Pendiente</span> 
				@elseif($pedido->estado == 'aceptado')
					<span class="badge bg-dark">En preparación</span> 
				@elseif($pedido->estado == 'preparado')
					<span class="badge bg-info">Pendiente recogida</span> 
				@elseif($pedido->estado == 'enviado')
					<span class="badge bg-success">Enviado</span> 
				@elseif($pedido->estado == 'completado')
					<span class="badge bg-success">Enviado</span> 
				@elseif($pedido->estado == 'cancelado')
					<span class="badge bg-danger">Cancelado</span> 
				@endif
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>Código</th>
						<th>Producto</th>
						<th>Marca</th>
						<th>Unidades</th>
						<th>Precio total</th>
						@if($pedido->estado == 'aceptado')
							<th>Preparado</th>
						@endif
					</tr>
				</thead>
				<tbody>
					@foreach($pedido->lineaPedido as $linea)
						<tr>
							<td>{{$linea->referencia->codigo}}</td>
							<td>{{$linea->referencia->producto->nombre}} {{$linea->referencia->producto->peso}}{{$linea->referencia->producto->unidad}}</td>
							<td>{{$linea->referencia->producto->marca->nombre}}</td>
							<td>{{$linea->cantidad}}</td>
							<td>{{$linea->cantidad * $linea->precio_ud - $linea->descuento}} €</td>
							@if($pedido->estado == 'aceptado')
								<td><input type="checkbox" id="check{{$linea->id}}" data-id="{{$linea->id}}" class="form-check-input"></td>
							@endif
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="text-center mt-2">
			@if(count($incidenciasPendientes)>0)
				<div class="alert alert-warning">El pedido no se puede editar hasta que se resuelva la incidencia</div>
			@elseif($pedido->estado == 'pendiente')
				<div class="alert alert-info">Aviso: al aceptar el pedido, se enviará notificación al cliente y debe ser preparado en un plazo adecuado de tiempo</div>
				<a href="{{route('actualizar-pedido',['id'=>$pedido->id])}}" class="btn btn-primary mb-1" title="Acepta el pedido y notifica al cliente">Aceptar y preparar</a>
				<button class="btn btn-danger ms-2 mb-1" data-bs-toggle="modal" data-bs-target="#modalIncidencia">Abrir incidencia</button>
			@elseif($pedido->estado == 'aceptado')
				<div class="alert alert-light">Al solicitar la recogida se generará la etiqueta para el transportista</div>
				<a onclick="borrarSelecciones()" href="{{route('actualizar-pedido',['id'=>$pedido->id])}}" class="btn btn-primary" title="Notifica al transportista para solicitar la recogida">Solicitar recogida</a>
				<button class="btn btn-danger ms-2 mt-sm-1" data-bs-toggle="modal" data-bs-target="#modalIncidencia">Abrir incidencia</button>
			@elseif($pedido->estado == 'preparado')
				<button class="btn btn-success">Imprimir etiqueta</button>
			@endif
			@if(count($pedido->incidencias))
				<br>
				<button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modalHistorialIncidencias">Consultar incidencias</button>
			@endif
			
		</div>
	</main>
	@if($pedido->estado == 'pendiente' || $pedido->estado == 'aceptado')
		<div class="modal" tabindex="-1" id="modalIncidencia">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<div class="modal-header">
	      		<h4>Informar incidencia</h4>
	      	</div>
	      	<div class="modal-body">
	      		<p>El pedido no podrá ser procesado hasta que se resuelva la incidencia</p>
	        	<p>Selecciona el motivo:</p>
	            <ul class="nav nav-tabs mb-3" id="tab" role="tablist">
		          <li class="nav-item" role="presentation">
		            <button onclick="seleccionMotivo('stock')" class="nav-link active" id="falta-stock" data-bs-toggle="tab" data-bs-target="#stock-tab-contenido" type="button" role="tab" aria-controls="stock-tab-contenido" aria-selected="true">Falta de stock</button>
		          </li>
		          <li class="nav-item" role="presentation">
		            <button onclick="seleccionMotivo('otro')" class="nav-link" data-bs-toggle="tab" data-bs-target="#otro-tab-contenido" type="button" role="tab" aria-controls="otro-tab-contenido" aria-selected="false">Otro</button>
		          </li>
		        </ul>
		        <div class="tab-content" id="tabContent">
          		<div class="tab-pane fade show active" id="stock-tab-contenido" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
          			<p>Indica <strong>cuántas unidades faltan</strong> de cada artículo:</p>
          			<table class="table table-striped">
          				<thead>
          					<tr>
          						<th>Código</th>
          						<th>Producto</th>
          						<th>Solicitado</th>
          						<th>Falta</th>
          					</tr>
          				</thead>
          				<tbody>
          					@foreach($pedido->lineaPedido as $linea)
											<tr>
												<td>{{$linea->referencia->codigo}}</td>
												<td>{{$linea->referencia->producto->nombre}} {{$linea->referencia->producto->peso}}{{$linea->referencia->producto->unidad}} - {{$linea->referencia->producto->marca->nombre}}</td>
												<td>{{$linea->cantidad}}</td>
												<td><input class="faltas" data-id="{{$linea->id}}" type="number" value="0"/></td>
											</tr>
										@endforeach
          				</tbody>
          			</table>
          		</div>
          		<div class="tab-pane fade" id="otro-tab-contenido" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
          			<label class="form-label">Indica el motivo:</label>
          			<textarea id="razon" class="form-control"></textarea>
          		</div>
          	</div>
          	<div class="modal-footer">
	            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
	            <button type="button" class="btn btn-danger" id="confirmarIncidencia">Confirmar
	            </button>
	        	</div>
        	</div>
      	</div>
    	</div>
    </div>
    <form id="formIncidencia" method="POST" action="{{route('registrar-incidencia')}}">
    	@csrf
    	<input type="hidden" name="pedido" value="{{$pedido->id}}"/>
    	<input type="hidden" name="motivo" id="motivo" value="stock"/>
    	<input type="hidden" name="informacion" id="informacion" value=""/>
    </form>
    <script type="text/javascript">
			function seleccionMotivo(dato){
				motivo.value = dato;
			}

			confirmarIncidencia.onclick = ()=>{
				if(motivo.value=="otro"){
					informacion.value = razon.value;
				}else{
					for(let falta of document.getElementsByClassName('faltas')){
						if(falta.value>0){
							informacion.value += falta.dataset.id+","+falta.value+";";
						}
					}
				}
				formIncidencia.submit();
			}
		</script>
	@endif
	@if($pedido->estado == 'aceptado')
		<script type="text/javascript">
			var referenciaStorage = "selecciones-{{$pedido->id}}";
			var selecciones = localStorage.getItem(referenciaStorage);
			var checks = document.getElementsByClassName('form-check-input');


			if(selecciones){
				selecciones = JSON.parse(selecciones);
			}else{
				selecciones = [];
			}

			for(let check of checks){
				check.onchange = seleccionProducto;
				if(selecciones.includes(check.dataset.id)){
					check.checked = true;
				}
			}

			function seleccionProducto(ev){
				if(ev.target.checked){
					selecciones.push(ev.target.dataset.id);
				}else{
					selecciones.splice(selecciones.indexOf(ev.target.dataset.id),1);
				}
				localStorage.setItem(referenciaStorage,JSON.stringify(selecciones));
			}

			function borrarSelecciones(){
				localStorage.removeItem(referenciaStorage);
			}
		</script>
	@endif
	@if(count($pedido->incidencias))
		<div class="modal" tabindex="-1" id="modalHistorialIncidencias">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<div class="modal-header">
	      		<h4>Incidencias registradas</h4>
	      	</div>
	      	<div class="modal-body">
	      		<table class="table table-striped">
      				<thead>
      					<tr>
      						<th>Fecha registro</th>
      						<th>Motivo</th>
      						<th>Estado</th>
      						<th>Solución</th>
      					</tr>
      				</thead>
      				<tbody>
      					@foreach($pedido->incidencias as $incidencia)
									<tr>
										<td>{{$incidencia->created_at->format('d/m/Y H:I')}}</td>
										<td>
											@if($incidencia->motivo == "otro")
												{{$incidencia->observaciones}}
											@else
												Falta de stock
											@endif
										</td>
										<td>
											@if($incidencia->estado == "pendiente")
												<span class="badge bg-warning">Pendiente</span> 
											@else
												<span class="badge bg-success">Resuelta</span> el {{$incidencia->updated_at->format("d/m/Y H:i")}}
											@endif
										</td>
										<td>{{$incidencia->solucion}}</td>
									</tr>
								@endforeach
      				</tbody>
      			</table>
        	</div>
      	</div>
    	</div>
    </div>
  @endif
</x-layout>
