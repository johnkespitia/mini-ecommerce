<link rel="stylesheet" type="text/css" href="/libs/datetimepicker/jquery.datetimepicker.css"/>
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Editar Evento <a href="/contact/index" class=" float-right btn btn-sm btn-primary">Agenda</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Editar el Evento </h6>
	<hr>
	<form method="post" action="/contact/update/<?=$contact["id"]?>">
	  <div class="form-group">
	    <label for="exampleInputtitle">Título del evento</label>
	    <input required type="text" class="form-control" name="title" id="exampleInputtitle" value="<?=$contact["title"]?>" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputCustomer">Cliente</label>
	    <select class="form-control" name="customer_id" id="exampleInputCustomer" >
	    	<?php foreach ($customerList as $customer) {
				$selected = ($contact["customer_id"]==$customer["id"])?"selected":"";
	    		echo "<option value='{$customer["id"]}' {$selected}>{$customer["name"]}</option>";
	    	} ?>
	    </select>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputType">Tipo de evento</label>
	    <select class="form-control" name="type" id="exampleInputType" >
	    	<option value='Preventa' <?= ($contact["type"]=="Preventa")?"selected":"" ?>>Preventa</option>
	    	<option value='Postventa' <?= ($contact["type"]=="Postventa")?"selected":"" ?>>Postventa</option>
	    </select>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDescription">Descripción</label>
	    <textarea id="exampleInputDescription" name="description" class="form-control" ><?=$contact["description"]?></textarea>
	  </div>
	  <div class="form-group">
	    <label for="order_id">Número de pedido (Solo Postventa)</label>
	    <input type="number" min="1" class="form-control" name="order_id" id="order_id"  value="<?=$contact["order_id"]?>" >
	  </div>
	  <div class="form-group">
	    <label for="datetime_start">Fecha de Inicio</label>
	    <input required type="text" class="form-control" name="datetime_start" id="datetime_start"  value="<?=$contact["datetime_start"]?>" >
	  
	    <label for="datetime_end">Fecha de Fin</label>
	    <input required type="text" class="form-control" name="datetime_end" id="datetime_end"   value="<?=$contact["datetime_end"]?>">
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