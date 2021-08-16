<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nueva sección de Checklist
	<a href="/checklist/index/<?= $typelist["id"] ?>" class=" float-right btn btn-sm btn-primary">Listado de secciones Checklists</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar una nueva sección de Checklist</h6>
	<hr>
		<form method="post" action="/checklist/store">
			<div class="form-group">
				<label for="exampleInputtitle">Título</label>
				<input required type="text" class="form-control" name="title" id="exampleInputtitle" >
			</div>
			<div class="form-group">
				<label for="exampleInputrequired">Obligatorio</label>
				<select class="form-control" name="required" id="exampleInputrequired" >
						<option value="1">Obligatorio</option>
						<option value="0">Opcional</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputparent">Depende de:</label>
				<select class="form-control" name="parent" id="exampleInputparent" >
						<option value="">No Depende</option>
						<?php foreach($checksLists as $ch){
							echo "<option value='{$ch["id"]}'>{$ch["title"]}</option>";
						} ?>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputStatus">Estado</label>
				<select class="form-control" name="status" id="exampleInputStatus" >
						<option value="1">Activa</option>
						<option value="0">Inactiva</option>
				</select>
			</div>
			<input name="checklist_type" type="hidden" value="<?= $typelist["id"] ?>" />
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>