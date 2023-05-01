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
		<div class="mt-3">
			<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDescuento">Aplicar descuento a listados</button>
			<a href="{{route('crear-producto')}}" class="btn btn-success">Nuevo Producto</a>
		</div>
		<div class="table-responsive mt-5">
			<table class="table table-hover table-striped table-success">
				<thead>
				    <tr>
				      <th scope="col" class="ordenable">Código ▲</th>
				      <th scope="col">Foto</th>
				      <th scope="col">Nombre</th>
				      <th scope="col">Precio</th>
				      <th scope="col">Descuento</th>
				      <th scope="col">Categoría</th>
				      <th scope="col">Marca</th>
				      <th scope="col">Stock</th>
				      <th scope="col">Activo</th>
				      <th scope="col">Acciones</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <td><div>1</div></td>
				      <td><img class="img-thumbnail" src="https://www.abc.com.py/resizer/qBj0sYatlbn_zU30HZwmMotrrVA=/arc-anglerfish-arc2-prod-abccolor/public/A3LD3QJRDFEBTD6LAU4L7ZVLNI.jpg"></td>
				      <td><div>Pan</div></td>
				      <td><div>3 €</div></td>
				      <td><div><button class="btn btn-primary">Aplicar</button></div></td>
				      <td><div>Panes</div></td>
				      <td><div>Nombre de marca muy larga</div></td>
				      <td><div><span class="badge bg-success">50</span></div></td>
				      <td><div><input type="checkbox" class="form-check-control" checked/></div></td>
				      <td>
				      	<div><button class="btn btn-secondary">Editar</button></div>
			      	</td>
				    </tr>
				    <tr>
				      <th scope="row">1</th>
				      <td><img src="https://www.abc.com.py/resizer/qBj0sYatlbn_zU30HZwmMotrrVA=/arc-anglerfish-arc2-prod-abccolor/public/A3LD3QJRDFEBTD6LAU4L7ZVLNI.jpg"></td>
				      <td>Pan</td>
				      <td><div><s>3</s> 2 € <br> Hasta 30/30/3030</div></td>
				      <td><div><button class="btn btn-danger">Quitar</button></div></td>
				      <td>Panes</td>
				      <td>Panista</td>
				      <td><span class="badge bg-warning">25</span></td>
				      <td><div><input type="checkbox" class="form-check-control" checked/></div></td>
				      <td>
				      	<div class="row">
					      	<div class="col">
					      		<button class="btn btn-secondary">Editar</button>
					      	</div>
					      	<div class="col">
					      		<button class="btn btn-danger">Quitar descuento</button>
					      	</div>
					      </div>
			      	</td>
				    </tr>
				    <tr class="table-warning">
				      <th scope="row">1</th>
				      <td><img src="https://www.abc.com.py/resizer/qBj0sYatlbn_zU30HZwmMotrrVA=/arc-anglerfish-arc2-prod-abccolor/public/A3LD3QJRDFEBTD6LAU4L7ZVLNI.jpg"></td>
				      <td>Pan</td>
				      <td>0</td>
				      <td>Panes</td>
				      <td>Panista</td>
				      <td><span class="badge bg-danger">5</span></td>
				      <td><div><input type="checkbox" class="form-check-control" checked/></div></td>
				      <td>
				      	<div class="row">
					      	<div class="col">
					      		<button class="btn btn-secondary">Editar</button>
					      	</div>
					      	<div class="col">
					      		<button class="btn btn-primary">Aplicar descuento</button>
					      	</div>
					      </div>
			      	</td>
				    </tr>
				    <tr class="table-secondary" disabled>
				      <th scope="row">1</th>
				      <td><img src="https://www.abc.com.py/resizer/qBj0sYatlbn_zU30HZwmMotrrVA=/arc-anglerfish-arc2-prod-abccolor/public/A3LD3QJRDFEBTD6LAU4L7ZVLNI.jpg"></td>
				      <td>Pan</td>
				      <td>0</td>
				      <td>Panes</td>
				      <td>Panista</td>
				      <td>-</td>
				      <td><div><input type="checkbox" class="form-check-control"/></div></td>
				      <td>-</td>
				    </tr>
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