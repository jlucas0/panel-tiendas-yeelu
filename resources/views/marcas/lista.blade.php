<style type="text/css">
	td img{
		width: 200px;
	}
	td{
		position: relative;
	}
	td div{
		position: absolute;
	    top: 50%;
	    transform: translateY(-50%);
	}
	#propias tr{
		cursor: pointer;
	}
</style>
<x-layout>

	<main class="container-sm pt-3 px-md-5">
		<a class="my-3 btn btn-success" href="{{route('marca')}}">Nueva Marca</a>
		<h3>Marcas Propias</h3>
		<table id="propias" class="table table-hover table-striped mb-5">
			<thead>
			    <tr>
			      <th scope="col">Foto</th>
			      <th scope="col">Nombre</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <td><img class="img-thumbnail" src="https://www.abc.com.py/resizer/qBj0sYatlbn_zU30HZwmMotrrVA=/arc-anglerfish-arc2-prod-abccolor/public/A3LD3QJRDFEBTD6LAU4L7ZVLNI.jpg"></td>
			      <td><div>Panadera</div></td>
			    </tr>
			    <tr>
			      <td><img src="https://www.abc.com.py/resizer/qBj0sYatlbn_zU30HZwmMotrrVA=/arc-anglerfish-arc2-prod-abccolor/public/A3LD3QJRDFEBTD6LAU4L7ZVLNI.jpg"></td>
			      <td><div>Panadera</div></td>
			    </tr>
			  </tbody>
		</table>
		<h3>Marcas Yeelu</h3>
		<table class="table table-hover table-striped table-warning">
			<thead>
			    <tr>
			      <th scope="col">Foto</th>
			      <th scope="col">Nombre</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <td><img src="https://www.abc.com.py/resizer/qBj0sYatlbn_zU30HZwmMotrrVA=/arc-anglerfish-arc2-prod-abccolor/public/A3LD3QJRDFEBTD6LAU4L7ZVLNI.jpg"></td>
			      <td><div>Panadera</div></td>
			    </tr>
			  </tbody>
		</table>
	</main>

</x-layout>