<div class="card">
	<div class="card-body">
		<h4 class="card-title">Editar Cesantia <span class="badge badge-primary"><?= $city["name"] ?></span>
			<a href="/cesantia/index" class=" float-right btn btn-sm btn-primary">Listado de Cesantias</a>
		</h4>
		<h6 class="card-subtitle mb-2 text-muted">Editar Cesantia registrado </h6>
		<hr>
		<form method="post" action="/cesantia/update/<?= $city["id"] ?>">
			<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName" value="<?= $city["name"] ?>">
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>