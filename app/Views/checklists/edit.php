<div class="card">
  <div class="card-body">
    <h4 class="card-title">Editar Checklist
	<a href="/checklist/index/<?= $checklist["checklist_type"] ?>" class=" float-right btn btn-sm btn-primary">Listado de Checklists</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Editar Checklist</h6>
	<hr>
		<form method="post"	 action="/checklist/update/<?= $checklist["id"] ?>">
			<div class="form-group">
				<label for="exampleInputtitle">Título</label>
				<input required type="text" class="form-control" name="title" id="exampleInputtitle" value="<?= $checklist["title"] ?>"  >
			</div>
			<div class="form-group">
				<label for="exampleInputrequired">Obligatorio</label>
				<select class="form-control" name="required" id="exampleInputrequired" >
						<option value="1" <?= ($checklist["required"]=="0")??"selected" ?> >Obligatorio</option>
						<option value="0" <?= ($checklist["required"]=="1")??"selected" ?>>Opcional</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputparent">Depende de:</label>
				<select class="form-control" name="parent" id="exampleInputparent" >
						<option value="">No Depende</option>
						<?php foreach($checksLists as $ch){
							if($ch['id']!= $checklist["id"]){
								$selected = ($ch["id"]==$checklist["parent"])?"selected":"";
								echo "<option {$selected} value='{$ch["id"]}'>{$ch["title"]}</option>";
							}
						} ?>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputStatus">Estado</label>
				<select class="form-control" name="status" id="exampleInputStatus" >
						<option value="1" <?= ($checklist["status"]=="1")?"selected":"" ?> >Activa</option>
						<option value="0" <?= ($checklist["status"]=="0")?"selected":"" ?> >Inactiva</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>