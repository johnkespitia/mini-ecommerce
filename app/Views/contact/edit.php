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
	    <label for="exampleInputMethod">Método de comunicación</label>
	    <select class="form-control" name="method" id="exampleInputMethod" >
	    	<option <?= ($contact["method"]=="Llamada")?"selected":"" ?> value='Llamada'>Llamada</option>
	    	<option <?= ($contact["method"]=="Correo")?"selected":"" ?> value='Correo'>Correo</option>
	    	<option <?= ($contact["method"]=="Whatsapp")?"selected":"" ?> value='Whatsapp'>Whatsapp</option>
	    	<option <?= ($contact["method"]=="SMS")?"selected":"" ?> value='SMS'>SMS</option>
	    	<option <?= ($contact["method"]=="Visita")?"selected":"" ?> value='Visita'>Visita</option>
	    	<option <?= ($contact["method"]=="Videollamada")?"selected":"" ?> value='Videollamada'>Videollamada</option>
	    	<option <?= ($contact["method"]=="Redes Sociales")?"selected":"" ?> value='Redes Sociales'>Redes Sociales</option>
	    	<option <?= ($contact["method"]=="Otro")?"selected":"" ?> value='Otro'>Otro</option>
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
	  <div class="form-group">
	    <label for="exampleInputreminder">Recordar</label>
	    <select class="form-control" name="reminder" id="exampleInputreminder" >
	    	<option value='10 minutos'  <?= ($contact["reminder"]=="10 minutos")?"selected":"" ?>>10 minutos antes</option>
	    	<option value='1 hora'  <?= ($contact["reminder"]=="1 hora")?"selected":"" ?>>1 hora antes</option>
	    	<option value='1 día' <?= ($contact["reminder"]=="1 día")?"selected":"" ?>>1 día antes</option>
	    	<option value='2 días'  <?= ($contact["reminder"]=="2 días")?"selected":"" ?>>2 días antes</option>
	    	<option value='3 días'  <?= ($contact["reminder"]=="3 días")?"selected":"" ?>>3 días antes</option>
	    </select>
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