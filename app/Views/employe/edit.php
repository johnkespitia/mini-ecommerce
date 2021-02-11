<div class="card">
  <div class="card-body">
	<h4 class="card-title">Editar Empleado <span  class="badge badge-primary"><?= $customer["name"] ?></span>
		<a href="/employe/index" class=" float-right btn btn-sm btn-primary">Listado de Empleados</a> 
	</h4>
	<h6 class="card-subtitle mb-2 text-muted">Editar Empleado registrado </h6>
	<hr>
		<form method="post" action="/employe/update/<?= $customer["id"] ?>">
			<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" class="form-control" name="name" maxlength="150" id="exampleInputName" value="<?= $customer["name"] ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Email</label>
				<input required type="email" class="form-control" name="email" maxlength="150" id="exampleInputEmail1" value="<?= $customer["email"] ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputdni1">Cédula</label>
				<input required type="text" maxlength="12" class="form-control" name="dni" id="exampleInputdni1" value="<?= $customer["dni"] ?>">
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