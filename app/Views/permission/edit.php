<div class="card">
	<div class="card-body">
		<h4 class="card-title">Editar Permiso de <span class="badge badge-primary"><?= $permission["permission"] ?> <?= $permission["module"] ?> </span> para <span class="badge badge-primary"><?= $rol["name"] ?></span>
			<a href="/permission/index/<?= $rol["id"] ?>" class=" float-right btn btn-sm btn-primary">Listado de Roles</a>
		</h4>
		<h6 class="card-subtitle mb-2 text-muted">Editar Rol registrado </h6>
		<hr>
		<form method="post" action="/permission/update/<?= $rol["id"] ?>">
			<div class="form-group">
				<label for="exampleInputName">Módulo</label>
				<select class="form-control" name="module" id="exampleInputCity">
					<option <?=($permission["module"] == "Roles")?"selected":"" ?> value="Roles">Roles</option>
					<option <?=($permission["module"] == "Usuarios")?"selected":"" ?> value="Usuarios">Usuarios</option>
					<option <?=($permission["module"] == "Ciudades")?"selected":"" ?> value="Ciudades">Ciudades</option>
					<option <?=($permission["module"] == "Clientes")?"selected":"" ?> value="Clientes">Clientes</option>
					<option <?=($permission["module"] == "Tipo de Vehículos")?"selected":"" ?> value="Tipo de Vehículos">Tipo de Vehículos</option>
					<option <?=($permission["module"] == "Vehículos")?"selected":"" ?> value="Vehículos">Vehículos</option>
					<option <?=($permission["module"] == "Empleados")?"selected":"" ?> value="Empleados">Empleados</option>
					<option <?=($permission["module"] == "Planillas")?"selected":"" ?> value="Planillas">Planillas</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputName">Permiso</label>
				<select class="form-control" name="permission" id="exampleInputCity">
					<option <?=($permission["permission"] == "Listar")?"selected":"" ?> value="Listar">Listar</option>
					<option <?=($permission["permission"] == "Crear")?"selected":"" ?> value="Crear">Crear</option>
					<option <?=($permission["permission"] == "Editar")?"selected":"" ?> value="Editar">Editar</option>
					<option <?=($permission["permission"] == "Eliminar")?"selected":"" ?> value="Eliminar">Eliminar</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputName">Estado</label>
				<select class="form-control" name="status" id="exampleInputCity">
					<option <?=($permission["status"] == "1")?"selected":"" ?> value="1">Activo</option>
					<option <?=($permission["status"] == "0")?"selected":"" ?> value="0">Inactivo</option>
				</select>
			</div>
			<input type="hidden" name="rol_id" value="<?= $rol["id"] ?>" />
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>