<div class="card">
	<div class="card-body">
		<h4 class="card-title">Nuevo Tipo de Documento <a href="/documenttype/index" class=" float-right btn btn-sm btn-primary">Listado de Tipos de Documentos</a></h4>
		<h6 class="card-subtitle mb-2 text-muted">Registrar nueva Tipo de Documento </h6>
		<hr>
		<form method="post" action="/documenttype/store">
			<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName">
			</div>
			<div class="form-group">
				<label for="exampleInputName">Aplica para Carros</label>
				<br />
				<label class="custom-toggle">
					<input type="checkbox" name="car" value="1">
					<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Sí"></span>
				</label>
			</div>
			<div class="form-group">
				<label for="exampleInputName">Aplica para Trailers</label>
				<br />
				<label class="custom-toggle">
					<input type="checkbox" name="trailer" value="1">
					<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Sí"></span>
				</label>
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>