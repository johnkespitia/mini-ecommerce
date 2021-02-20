<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nuevo Reporte <a href="/daily/index" class=" float-right btn btn-sm btn-primary">Listado de Reportes Diarios</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar un reporte diario </h6>
	<hr>
	<form method="post" action="/daily/store">
	  <div class="form-group">
	    <label for="exampleInputName">Fecha</label>
	    <input required type="date" class="form-control" name="date_report" id="exampleInputName" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputCity">Empleado</label>
	    <select class="form-control" name="employe" id="exampleInputCity" >
	    	<?php foreach ($employeList as $c) {
	    		echo "<option value='{$c["id"]}'>{$c["name"]}</option>";
	    	} ?>
	    </select>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputCity">Origen</label>
	    <select class="form-control" name="origin" id="exampleInputCity" >
	    	<?php foreach ($ctyList as $c) {
	    		echo "<option value='{$c["id"]}'>{$c["name"]}</option>";
	    	} ?>
	    </select>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputCity">Destino</label>
	    <select class="form-control" name="destination" id="exampleInputCity" >
	    	<?php foreach ($ctyList as $c) {
	    		echo "<option value='{$c["id"]}'>{$c["name"]}</option>";
	    	} ?>
	    </select>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI1">Hora de inicio AM</label>
	    <input required type="number" step="0.5" class="form-control" name="time_start_am" id="exampleInputDNI" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI2">Hora de fin AM</label>
	    <input required type="number" step="0.5" class="form-control" name="time_end_am" id="exampleInputDNI" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI2">Tiempo de almuerzo</label>
	    <input required type="number" step="0.5" class="form-control" name="lunch_time" id="exampleInputDNI" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI">Hora de inicio PM</label>
	    <input required type="number" step="0.5" class="form-control" name="time_start_pm" id="exampleInputDNI" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI">Hora de fin PM</label>
	    <input required type="number" step="0.5" class="form-control" name="time_end_pm" id="exampleInputDNI" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI">Horas Trabajadas</label>
	    <input required type="number" step="0.5" class="form-control" name="worked_hours" id="exampleInputDNI" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI">Hora de disponibilidad</label>
	    <input required type="number" step="0.5" class="form-control" name="abble_hours" id="exampleInputDNI" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI">Kilometros Inicio</label>
	    <input required type="number" step="1" class="form-control" name="km_start" id="exampleInputDNI" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI">Kilometros Final</label>
	    <input required type="number" step="1" class="form-control" name="km_end" id="exampleInputDNI" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI">Cantidad Personas</label>
	    <input required type="number" step="1" class="form-control" name="people" id="exampleInputDNI" >
	  </div>
	  <input type="hidden" class="form-control" name="report_group" value="<?=$group["id"]?>" id="exampleInputDNI" >
	  <button type="submit" class="btn btn-primary">Guardar</button>
	</form>
	</div>
</div>