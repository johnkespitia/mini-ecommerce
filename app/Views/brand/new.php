<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nuevo Marca de Vehículo <a href="/brand/index" class=" float-right btn btn-sm btn-primary">Listado de Marca de Vehículos</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar nueva Marca de Vehículo </h6>
	<hr>
		<form method="post" action="/brand/store">
			<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName" >
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>