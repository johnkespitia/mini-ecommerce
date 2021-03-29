<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nueva Aliado <a href="/companyagreement/index" class=" float-right btn btn-sm btn-primary">Listado de Aliados</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar una nueva Aliado </h6>
	<hr>
		<form method="post" action="/companyagreement/store">
			<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName" >
			</div>
			<div class="form-group">
				<label for="exampleInputDNI">Identificación (NIT)</label>
				<input required type="text" class="form-control" name="dni" id="exampleInputDNI" >
			</div>
			<div class="form-group">
				<label for="exampleInputEmail">Email</label>
				<input required type="email" class="form-control" name="email" id="exampleInputEmail" >
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>