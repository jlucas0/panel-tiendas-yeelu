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
		@if(count($marcasTienda))
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
				  	@foreach($marcasTienda as $marca)
					    <tr>
					      <td><img class="img-thumbnail" src="/storage/{{$marca->foto}}"></td>
					      <td>{{$marca->nombre}}</td>
					      <td><a class="btn btn-secondary" href="{{route('marca',['id'=>$marca->id])}}">Editar</a></td>
					    </tr>
				    @endforeach
				  </tbody>
			</table>
		@endif
		@if(count($marcasYeelu))
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
				  	@foreach($marcasYeelu as $marca)
					    <tr>
					      <td><img src="/storage/{{$marca->foto}}"></td>
					      <td>{{$marca->nombre}}</td>
					      <td>{{$marca->descripcion}}</td>
					    </tr>
					@endforeach
				  </tbody>
			</table>
		@endif
	</main>

</x-layout>