<x-layout>
	
	<main class="container-lg pt-3">
		<h3>Pedidos pendientes</h3>
		<div class="table-responsive mt-2">
			<table class="table table-hover table-striped">
				<thead>
				    <tr>
				      <th scope="col" class="ordenable">Número ▲</th>
				      <th scope="col">Fecha</th>
				      <th scope="col">Importe</th>
				      <th scope="col">Estado</th>
				      <th scope="col"></th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <td>28</td>
				      <td>26/04/2023 18:08</td>
				      <td>80 €</td>
				      <td><span class="badge bg-secondary">Pendiente</span></td>
				      <td><button class="btn btn-info">Revisar</button></td>
				    </tr>
				    <tr>
				      <td>28</td>
				      <td>26/04/2023 18:08</td>
				      <td>80 €</td>
				      <td><span class="badge bg-dark">En preparación</span></td>
				      <td><button class="btn btn-info">Revisar</button></td>
				    </tr>
				    <tr>
				      <td>28</td>
				      <td>26/04/2023 18:08</td>
				      <td>80 €</td>
				      <td><span class="badge bg-info">Pendiente recogida</span></td>
				      <td><button class="btn btn-info">Revisar</button></td>
				    </tr>
				    <tr>
				      <td>28</td>
				      <td>26/04/2023 18:08</td>
				      <td>80 €</td>
				      <td><span class="badge bg-warning">Incidencia pendiente</span></td>
				      <td><button class="btn btn-info">Revisar</button></td>
				    </tr>
				  </tbody>
			</table>
		</div>
		<h3 class="mt-5">Historial ▼</h3>
		<div class="list-group list-group-flush w-50">
		  <a href="#" class="list-group-item list-group-item-action">
		    #10 20/04/2023 <span class="badge bg-success float-end">Completado</span>
		  </a>
		  <a href="#" class="list-group-item list-group-item-action">
		    #10 20/04/2023 <span class="badge bg-danger float-end">Cancelado</span>
		  </a>
		</div>
		<button class="btn btn-primary">Cargar más</button>
	</main>

</x-layout>