<div class="card">
  <div class="card-body">
	<h4 class="card-title">Editar Tipo de Documento de Empleado <span  class="badge badge-primary"><?= $rol["name"] ?></span>
		 <a href="/employedocumenttype/index" class=" float-right btn btn-sm btn-primary">Listado de Tipos de Documento</a> 
	</h4>
	<h6 class="card-subtitle mb-2 text-muted">Editar Tipo de Documento de Empleado registrado </h6>
	<hr>
		<form method="post" action="/employedocumenttype/update/<?= $rol["id"] ?>">
		<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName" value="<?=$rol["name"]?>" >
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>