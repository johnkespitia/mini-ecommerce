<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nuevo Rol <a href="/rol/index" class=" float-right btn btn-sm btn-primary">Listado de roles</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar una nuevo Rol </h6>
	<hr>
		<form method="post" action="/rol/store">
			<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName" >
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>