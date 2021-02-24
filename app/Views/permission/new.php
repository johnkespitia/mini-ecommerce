<div class="card">
	<div class="card-body">
		<h4 class="card-title">Nuevo Permiso para el rol <span class="badge badge-primary"><?= $rol["name"] ?></span> <a href="/permission/index/<?= $rol["id"] ?>" class=" float-right btn btn-sm btn-primary">Listado de Permisos</a></h4>
		<h6 class="card-subtitle mb-2 text-muted">Registrar un nuevo permiso </h6>
		<hr>
		<form method="post" action="/permission/store">
			<div class="form-group">
				<label for="exampleInputName">Módulo</label>
				<select class="form-control" name="module" id="exampleInputCity">
					<option value="Roles">Roles</option>
					<option value="Usuarios">Usuarios</option>
					<option value="Ciudades">Ciudades</option>
					<option value="Clientes">Clientes</option>
					<option value="Tipo de Vehículos">Tipo de Vehículos</option>
					<option value="Vehículos">Vehículos</option>
					<option value="Empleados">Empleados</option>
					<option value="Planillas">Planillas</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputName">Permiso</label>
				<select class="form-control" name="permission" id="exampleInputCity">
					<option value="Listar">Listar</option>
					<option value="Crear">Crear</option>
					<option value="Editar">Editar</option>
					<option value="Eliminar">Eliminar</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputName">Estado</label>
				<select class="form-control" name="status" id="exampleInputCity">
					<option value="1">Activo</option>
					<option value="0">Inactivo</option>
				</select>
			</div>
			<input type="hidden" name="rol_id" value="<?=$rol["id"]?>" />
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>