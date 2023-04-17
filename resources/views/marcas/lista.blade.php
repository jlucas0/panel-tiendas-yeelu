<style type="text/css">
	td img{
		width: 200px;
	}
	td{
		vertical-align: middle;
	}
</style>
<x-layout>

	<main class="container-sm pt-3 px-md-5">
		<a class="my-3 btn btn-success" href="{{route('marca')}}">Nueva Marca</a>
		<h3>Marcas pendientes de aprobación</h3>
		<p>Aquí se listan las marcas que aún no han sido aprobadas por el equipo de Yeelu. Podrán utilizarse con normalidad, y mientras estén aquí, se podrán editar y borrar.</p>
		<table id="propias" class="table table-hover table-striped mb-5">
			<thead>
			    <tr>
			      <th scope="col">Foto</th>
			      <th scope="col">Nombre</th>
			      <th scope="col">Acción</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <td><img class="img-thumbnail" src="https://www.abc.com.py/resizer/qBj0sYatlbn_zU30HZwmMotrrVA=/arc-anglerfish-arc2-prod-abccolor/public/A3LD3QJRDFEBTD6LAU4L7ZVLNI.jpg"></td>
			      <td><div>Panadera</div></td>
			      <td><div><button class="btn btn-secondary">Editar</button></div></td>
			    </tr>
			    <tr>
			      <td><img src="https://www.abc.com.py/resizer/qBj0sYatlbn_zU30HZwmMotrrVA=/arc-anglerfish-arc2-prod-abccolor/public/A3LD3QJRDFEBTD6LAU4L7ZVLNI.jpg"></td>
			      <td><div>Panadera</div></td>
			      <td><div><button class="btn btn-secondary">Editar</button></div></td>
			    </tr>
			  </tbody>
		</table>
		<h3>Marcas disponibles</h3>
		<p>Listado de marcas disponibles para todas las tiendas Yeelu.</p>
		<table class="table table-hover table-striped table-warning">
			<thead>
			    <tr>
			      <th scope="col">Foto</th>
			      <th scope="col">Nombre</th>
			      <th scope="col">Descripción</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <td><img src="https://www.abc.com.py/resizer/qBj0sYatlbn_zU30HZwmMotrrVA=/arc-anglerfish-arc2-prod-abccolor/public/A3LD3QJRDFEBTD6LAU4L7ZVLNI.jpg"></td>
			      <td><div>Panadera</div></td>
			      <td><div>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div></td>
			    </tr>
			  </tbody>
		</table>
	</main>

</x-layout>