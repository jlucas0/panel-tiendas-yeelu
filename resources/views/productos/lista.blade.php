<style type="text/css">
	tbody tr, th.ordenable{
		cursor: pointer;
	}
	td img{
		width: 100px;
	}
	td{
		position: relative;
	}
	td div{
		position: absolute;
	    top: 50%;
	    transform: translateY(-50%);
	}
</style>
<x-layout>

	<main class="container-lg pt-3">
		<h3>Filtros ▼</h3>
		<div class="row">
			<div class="col-12 col-sm-4 mb-2">
				<input type="text" class="form-control" placeholder="Nombre">
			</div>
			<div class="col-12 col-sm-4 mb-2">
				<select class="form-select">
					<option>Marca</option>
				</select>
			</div>
			<div class="col-12 col-sm-4 mb-2">
				<select class="form-select">
					<option>Categoría</option>
				</select>
			</div>
			
		</div>
		<div class="row">
			<div class="col-12 col-sm-4 mb-2">
				<input type="text" class="form-control" placeholder="Código">
			</div>
			<div class="col-12 col-sm-4 mb-2">
				<select class="form-select">
					<option val="1">Activos</option>
					<option val="-1">Inactivos</option>
					<option val="2">Todos</option>
				</select>
			</div>
			<div class="col-12 col-sm-4">
				<div class="form-check">
				  <input class="form-check-input" type="checkbox" value="" id="checkStock">
				  <label class="form-check-label" for="checkStock">
				    Stock bajo
				  </label>
				</div>
			</div>
		</div>
		<button class="mt-3 btn btn-success">Nuevo Producto</button>
		<div class="table-responsive mt-5">
			<table class="table table-hover table-striped table-success">
				<thead>
				    <tr>
				      <th scope="col" class="ordenable">Código ▲</th>
				      <th scope="col">Foto</th>
				      <th scope="col">Nombre</th>
				      <th scope="col">Categoría</th>
				      <th scope="col">Marca</th>
				      <th scope="col">Stock</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <td><div>1</div></td>
				      <td><img class="img-thumbnail" src="https://www.abc.com.py/resizer/qBj0sYatlbn_zU30HZwmMotrrVA=/arc-anglerfish-arc2-prod-abccolor/public/A3LD3QJRDFEBTD6LAU4L7ZVLNI.jpg"></td>
				      <td><div>Pan</div></td>
				      <td><div>Panes</div></td>
				      <td><div>Panista</div></td>
				      <td><div><span class="badge bg-success">50</span></div></td>
				    </tr>
				    <tr>
				      <th scope="row">1</th>
				      <td><img src="https://www.abc.com.py/resizer/qBj0sYatlbn_zU30HZwmMotrrVA=/arc-anglerfish-arc2-prod-abccolor/public/A3LD3QJRDFEBTD6LAU4L7ZVLNI.jpg"></td>
				      <td>Pan</td>
				      <td>Panes</td>
				      <td>Panista</td>
				      <td><span class="badge bg-warning">25</span></td>
				    </tr>
				    <tr class="table-warning">
				      <th scope="row">1</th>
				      <td><img src="https://www.abc.com.py/resizer/qBj0sYatlbn_zU30HZwmMotrrVA=/arc-anglerfish-arc2-prod-abccolor/public/A3LD3QJRDFEBTD6LAU4L7ZVLNI.jpg"></td>
				      <td>Pan</td>
				      <td>Panes</td>
				      <td>Panista</td>
				      <td><span class="badge bg-danger">5</span></td>
				    </tr>
				    <tr class="table-secondary" disabled>
				      <th scope="row">1</th>
				      <td><img src="https://www.abc.com.py/resizer/qBj0sYatlbn_zU30HZwmMotrrVA=/arc-anglerfish-arc2-prod-abccolor/public/A3LD3QJRDFEBTD6LAU4L7ZVLNI.jpg"></td>
				      <td>Pan</td>
				      <td>Panes</td>
				      <td>Panista</td>
				      <td>-</td>
				    </tr>
				  </tbody>
			</table>
		</div>
	</main>

</x-layout>