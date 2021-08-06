<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nuevo Checklist<a href="/checklist/index" class=" float-right btn btn-sm btn-primary">Listado de Checklists</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar un nuevo Checklist</h6>
	<hr>
		<form method="post" action="/checklist/store">
			<div class="form-group">
				<label for="exampleInputtitle">Título</label>
				<input required type="text" class="form-control" name="title" id="exampleInputtitle" >
			</div>
			<div class="form-group">
				<label for="exampleInputStatus">Estado</label>
				<select class="form-control" name="status" id="exampleInputStatus" >
						<option value="1">Activa</option>
						<option value="0">Inactiva</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>