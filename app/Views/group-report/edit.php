<div class="card">
  <div class="card-body">
	<h4 class="card-title">Editar Planilla <span  class="badge badge-primary"># <?= $report["id"] ?></span>
		<a href="/report/index" class=" float-right btn btn-sm btn-primary">Listado de Planillas</a> 
	</h4>
	<h6 class="card-subtitle mb-2 text-muted">Editar Planilla registrada </h6>
	<hr>
		<form method="post" action="/report/update/<?= $report["id"] ?>">
		<div class="form-group">
				<label for="exampleInputName">Fecha</label>
				<input required type="date" class="form-control" name="date_report" value="<?= $report["date_report"] ?>" id="exampleInputName">
			</div>
			<div class="form-group">
				<label for="exampleInputCity">Cliente</label>
				<select class="form-control" name="customer" id="exampleInputCity">
					<?php foreach ($customerList as $c) {
						$selected = ($report["customer"] == $c["id"])?"selected='selected'":"";
						echo "<option {$selected} value='{$c["id"]}'>{$c["name"]}</option>";
					} ?>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputCity">Vehículo</label>
				<select class="form-control" name="car" id="exampleInputCity">
					<?php foreach ($carList as $c) {
						$selected = ($report["car"] == $c["id"])?"selected='selected'":"";
						echo "<option {$selected} value='{$c["id"]}'>{$c["dni"]}</option>";
					} ?>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Tipo de servicio</label>
				<input required type="text" class="form-control" name="service_type" id="exampleInputEmail1" value="<?= $report["service_type"] ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Area</label>
				<input required type="text" class="form-control" name="area" id="exampleInputEmail1" value="<?= $report["area"] ?>">
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>