<div class="card">
  <div class="card-body">
	<h4 class="card-title">Editar Ciudad <span  class="badge badge-primary"><?= $city["name"] ?></span>
		 <a href="/city/index" class=" float-right btn btn-sm btn-primary">Listado de Ciudades</a> 
	</h4>
	<h6 class="card-subtitle mb-2 text-muted">Editar Vehículo registrado </h6>
	<hr>
		<form method="post" action="/city/update/<?= $city["id"] ?>">
		<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName" value="<?=$city["name"]?>" >
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>