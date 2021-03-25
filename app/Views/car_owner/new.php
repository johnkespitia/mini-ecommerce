<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nuevo Propietario <a href="/owner/index" class=" float-right btn btn-sm btn-primary">Listado de Propietarios</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar un nuevo propietario </h6>
	<hr>
		<form method="post" action="/owner/store">
			<div class="form-group">
				<label for="exampleInputDNI">Identificación</label>
				<input required type="number" min="0" class="form-control" name="dni" id="exampleInputDNI" >
			</div>
			<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName" >
			</div>
			<div class="form-group">
				<label for="exampleInputEmail">Email</label>
				<input required type="email" class="form-control" name="email" id="exampleInputEmail" >
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>