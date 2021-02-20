<div class="card">
  <div class="card-body">
    <h4 class="card-title">Editar Reporte diario <span  class="badge badge-primary"><?= $daily["date_report"] ?></span><a href="/daily/index/<?= $daily["report_group"] ?>" class=" float-right btn btn-sm btn-primary">Listado de reportes</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Editar reporte diario registrado </h6>
	<hr>
	<form method="post" action="/daily/update/<?= $daily["id"] ?>">
		<div class="form-group">
	    <label for="exampleInputName">Fecha</label>
	    <input required type="date" value="<?= $daily["date_report"] ?>" class="form-control" name="date_report" id="exampleInputName" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputCity">Empleado</label>
	    <select class="form-control" name="employe" id="exampleInputCity" >
	    	<?php foreach ($employeList as $c) {
				$selected = ($c["id"]==$daily["employe"])?"selected='selected'":"";
	    		echo "<option value='{$c["id"]}'>{$c["name"]}</option>";
	    	} ?>
	    </select>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputCity">Origen</label>
	    <select class="form-control" name="origin" id="exampleInputCity" >
	    	<?php foreach ($ctyList as $c) {
				$selected = ($c["id"]==$daily["origin"])?"selected='selected'":"";
	    		echo "<option {$selected} value='{$c["id"]}'>{$c["name"]}</option>";
	    	} ?>
	    </select>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputCity">Destino</label>
	    <select class="form-control" name="destination" id="exampleInputCity" >
	    	<?php foreach ($ctyList as $c) {
				$selected = ($c["id"]==$daily["destination"])?"selected='selected'":"";
	    		echo "<option {$selected} value='{$c["id"]}'>{$c["name"]}</option>";
	    	} ?>
	    </select>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI1">Hora de inicio AM</label>
	    <input required type="number" step="0.5"  value="<?= $daily["time_start_am"] ?>" class="form-control" name="time_start_am" id="exampleInputDNI" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI2">Hora de fin AM</label>
	    <input required type="number" step="0.5" value="<?= $daily["time_end_am"] ?>" class="form-control" name="time_end_am" id="exampleInputDNI" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI2">Tiempo de almuerzo</label>
	    <input required type="number" step="0.5" class="form-control" value="<?= $daily["lunch_time"] ?>" name="lunch_time" id="exampleInputDNI" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI">Hora de inicio PM</label>
	    <input required type="number" step="0.5" class="form-control" name="time_start_pm" value="<?= $daily["time_start_pm"] ?>" id="exampleInputDNI" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI">Hora de fin PM</label>
	    <input required type="number" step="0.5" class="form-control" name="time_end_pm" value="<?= $daily["time_end_pm"] ?>" id="exampleInputDNI" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI">Horas Trabajadas</label>
	    <input required type="number" step="0.5" class="form-control" name="worked_hours" id="exampleInputDNI" value="<?= $daily["worked_hours"] ?>" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI">Hora de disponibilidad</label>
	    <input required type="number" step="0.5" class="form-control" name="abble_hours" id="exampleInputDNI" value="<?= $daily["abble_hours"] ?>" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI">Kilometros Inicio</label>
	    <input required type="number" step="1" class="form-control" name="km_start" id="exampleInputDNI" value="<?= $daily["km_start"] ?>">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI">Kilometros Final</label>
	    <input required type="number" step="1" class="form-control" name="km_end" id="exampleInputDNI" value="<?= $daily["km_end"] ?>">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI">Cantidad Personas</label>
	    <input required type="number" step="1" class="form-control" name="people" id="exampleInputDNI" value="<?= $daily["people"] ?>">
	  </div>
	  <input type="hidden" class="form-control" name="report_group" value="<?=$daily["report_group"]?>" id="exampleInputDNI" >
	  <button type="submit" class="btn btn-primary">Guardar</button>
	</form>
	</div>
</div>
