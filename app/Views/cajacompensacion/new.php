<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nueva Caja de Compensación <a href="/cajacompensacion/index" class=" float-right btn btn-sm btn-primary">Listado de Caja de Compensación</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar un nuevo Caja de Compensación </h6>
	<hr>
		<form method="post" action="/cajacompensacion/store">
			<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName" >
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>