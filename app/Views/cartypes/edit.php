<div class="card">
  <div class="card-body">
	<h4 class="card-title">Editar Tipo de Vehículo <span  class="badge badge-primary"><?= $customer["name"] ?></span>
		 <a href="/cartype/index" class=" float-right btn btn-sm btn-primary">Listado de Tipo de Vehículos</a> 
	</h4>
	<h6 class="card-subtitle mb-2 text-muted">Editar Tipo de Vehículo registrado </h6>
	<hr>
		<form method="post" action="/cartype/update/<?= $customer["id"] ?>">
			<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName" value="<?= $customer["name"] ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputStatus">Estado</label>
				<select class="form-control" name="status" id="exampleInputStatus" >
					<option <?= ($customer["status"]=="1")?"selected":"" ?> value='1'>Activo</option>
					<option <?= ($customer["status"]=="2")?"selected":"" ?> value='2'>Inactivo</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>