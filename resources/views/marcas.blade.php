<style type="text/css">
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
	#propias tr{
		cursor: pointer;
	}
</style>
<x-layout>

	<main class="container-lg pt-3">
		<button class="my-3 btn btn-success">Nueva Marca</button>
		<h3>Marcas Propias</h3>
		<div class="table-responsive mb-5">
			<table id="propias" class="table table-hover table-striped">
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
				    <tr>
				      <td><img src="https://www.abc.com.py/resizer/qBj0sYatlbn_zU30HZwmMotrrVA=/arc-anglerfish-arc2-prod-abccolor/public/A3LD3QJRDFEBTD6LAU4L7ZVLNI.jpg"></td>
				      <td><div>Panadera</div></td>
				    </tr>
				  </tbody>
			</table>
		</div>
		<h3>Marcas Yeelu</h3>
		<div class="table-responsive mb-5">
			<table class="table table-hover table-striped">
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
		</div>
	</main>

</x-layout>