<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nuevo Tipo de Vehículo <a href="/cartype/index" class=" float-right btn btn-sm btn-primary">Listado de Tipos de Vehículos</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar un nuevo tipo de vehículo </h6>
	<hr>
		<form method="post" action="/cartype/store">
			<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName" >
			</div>
			<div class="form-group">
				<label for="exampleInputStatus">Estado</label>
				<select class="form-control" name="status" id="exampleInputStatus" >
					<option value='1'>Activo</option>
					<option value='2'>Inactivo</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>