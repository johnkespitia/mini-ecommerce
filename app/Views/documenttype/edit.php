<div class="card">
	<div class="card-body">
		<h4 class="card-title">Editar Tipo de Documento <span class="badge badge-primary"><?= $rol["name"] ?></span>
			<a href="/documenttype/index" class=" float-right btn btn-sm btn-primary">Listado de Tipos de Documento</a>
		</h4>
		<h6 class="card-subtitle mb-2 text-muted">Editar Tipo de Documento registrado </h6>
		<hr>
		<form method="post" action="/documenttype/update/<?= $rol["id"] ?>">
			<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName" value="<?= $rol["name"] ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputName">Aplica para Carros</label>
				<br />
				<label class="custom-toggle">
					<input type="checkbox" name="car" value="1" <?= $rol["car"] == 1 ? "checked" : "" ?>>
					<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Sí"></span>
				</label>
			</div>
			<div class="form-group">
				<label for="exampleInputName">Aplica para Trailers</label>
				<br />
				<label class="custom-toggle">
					<input type="checkbox" name="trailer" value="1" <?= $rol["trailer"] == 1 ? "checked" : "" ?>>
					<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Sí"></span>
				</label>
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>