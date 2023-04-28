<x-layout>
	<main class="container pt-4">
		<div class="row">
			<h2 class="col-9 col-md-11">Pedido #5496156</h2>
			<div class="col-3 col-md-1">
				<a class="btn btn-secondary" href="{{route('pedidos')}}">Volver</a>
			</div>
		</div>
		<div class="row my-3">
			<div class="col">Fecha de recepción: 28/04/2023 19:06</div>
			<div class="text-end col">Estado: <span class="badge bg-secondary">Pendiente</span></div>
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
						<th>Preparado</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>12345</td>
						<td>Patatas 400gr</td>
						<td>Patatero</td>
						<td>2</td>
						<td>8 €</td>
						<td><input type="checkbox" class="form-check-input"></td>
					</tr>
					<tr>
						<td>54321</td>
						<td>Garbanzos 500gr</td>
						<td>La Huerta</td>
						<td>3</td>
						<td>6 €</td>
						<td><input type="checkbox" class="form-check-input"></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="text-center mt-2">
			<button class="btn btn-primary">Aceptar y preparar</button>
			<button class="btn btn-danger ms-2 mt-sm-1" data-bs-toggle="modal" data-bs-target="#modalIncidencia">Abrir incidencia</button>
		</div>
	</main>
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
		            <button onclick="" class="nav-link active" id="falta-stock" data-bs-toggle="tab" data-bs-target="#stock-tab-contenido" type="button" role="tab" aria-controls="stock-tab-contenido" aria-selected="true">Falta de stock</button>
		          </li>
		          <li class="nav-item" role="presentation">
		            <button onclick="" class="nav-link" data-bs-toggle="tab" data-bs-target="#otro-tab-contenido" type="button" role="tab" aria-controls="otro-tab-contenido" aria-selected="false">Otro</button>
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
	          					<tbody>
									<tr>
										<td>12345</td>
										<td>Patatas 400gr - Patatero</td>
										<td>2</td>
										<td><input type="number" value="0"/></td>
									</tr>
									<tr>
										<td>54321</td>
										<td>Garbanzos 500gr - La Huerta</td>
										<td>3</td>
										<td><input type="number" value="0"/></td>
									</tr>
								</tbody>
	          				</tbody>
	          			</table>
	          		</div>
	          		<div class="tab-pane fade" id="otro-tab-contenido" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
	          			<label class="form-label">Indica el motivo:</label>
	          			<textarea id="razon" class="form-control"></textarea>
	          		</div>
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
</x-layout>
