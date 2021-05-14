<div class="card">
  <div class="card-body">
	<h4 class="card-title">Editar Tipo de Trailer <span  class="badge badge-primary"><?= $customer["name"] ?></span>
		 <a href="/trailertype/index" class=" float-right btn btn-sm btn-primary">Listado de Tipo de Trailers</a> 
	</h4>
	<h6 class="card-subtitle mb-2 text-muted">Editar Tipo de Trailer registrado </h6>
	<hr>
		<form method="post" action="/trailertype/update/<?= $customer["id"] ?>">
			<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName" value="<?= $customer["name"] ?>">
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>