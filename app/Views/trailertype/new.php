<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nuevo Tipo de Trailer <a href="/trailertype/index" class=" float-right btn btn-sm btn-primary">Listado de Tipos de Trailers</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar un nuevo tipo de Trailer </h6>
	<hr>
		<form method="post" action="/trailertype/store">
			<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName" >
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>