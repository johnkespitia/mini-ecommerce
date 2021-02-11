<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nuevo empleado <a href="/employe/index" class=" float-right btn btn-sm btn-primary">Listado de empleados</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar un nuevo empleado </h6>
	<hr>
		<form method="post" action="/employe/store">
			<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" maxlength="150" class="form-control" name="name" id="exampleInputName" >
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Email</label>
				<input required type="email" maxlength="150" class="form-control" name="email" id="exampleInputEmail1" >
			</div>
			<div class="form-group">
				<label for="exampleInputdni1">Cédula</label>
				<input required type="text" maxlength="12" class="form-control" name="dni" id="exampleInputdni1">
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