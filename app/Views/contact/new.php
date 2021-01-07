<link rel="stylesheet" type="text/css" href="/libs/datetimepicker/jquery.datetimepicker.css"/>
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nuevo Evento <a href="/contact/index" class=" float-right btn btn-sm btn-primary">Agenda</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar un nuevo Evento </h6>
	<hr>
	<form method="post" action="/contact/store">
	  <div class="form-group">
	    <label for="exampleInputtitle">Título del evento</label>
	    <input required type="text" class="form-control" name="title" id="exampleInputtitle" value="<?=$paramsEvent[2]?>" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputCustomer">Cliente</label>
	    <select class="form-control" name="customer_id" id="exampleInputCustomer" >
	    	<?php foreach ($customerList as $customer) {
	    		echo "<option value='{$customer["id"]}'>{$customer["name"]}</option>";
	    	} ?>
	    </select>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputType">Tipo de evento</label>
	    <select class="form-control" name="type" id="exampleInputType" >
	    	<option value='Preventa'>Preventa</option>
	    	<option value='Postventa'>Postventa</option>
	    </select>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDescription">Descripción</label>
	    <textarea id="exampleInputDescription" name="description" class="form-control" ></textarea>
	  </div>
	  <div class="form-group">
	    <label for="order_id">Número de pedido (Solo Postventa)</label>
	    <input type="number" min="1" class="form-control" name="order_id" id="order_id"  >
	  </div>
	  <div class="form-group">
	    <label for="datetime_start">Fecha de Inicio</label>
	    <input required type="text" class="form-control" name="datetime_start" id="datetime_start"  value="<?=$paramsEvent[3]?>" >
	  
	    <label for="datetime_end">Fecha de Fin</label>
	    <input required type="text" class="form-control" name="datetime_end" id="datetime_end"  value="<?=$paramsEvent[4]?>">
	  </div>
	  <button type="submit" class="btn btn-primary">Guardar</button>
	</form>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('#datetime_start').datetimepicker({
			i18n:{
				es:{
					months:[
						'Enero','Febrero','Marzo','Abril',
						'Mayo','Junio','Julio','Agosto',
						'Septiembre','Octubre','Noviembre','Diciembre',
					],
					dayOfWeek:[
						"Domingo", "Lunes", "Martes", "Miercoles", 
						"Jueves", "Viernes", "Sábado",
					]
				}
			},
			format:'Y-m-d H:i',
			inline:true,
			minDate:'0'
		});

		$('#datetime_end').datetimepicker({
			format:'Y-m-d H:i',
			inline:true,
			lang:'es',
			validateOnBlur:true,
			minDate: $('#datetime_start').val(),
		});
	});
</script>