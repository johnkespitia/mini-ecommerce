<link rel="stylesheet" type="text/css" href="/libs/datetimepicker/jquery.datetimepicker.css"/>
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nuevo Seguimiento <span class="badge badge-info"><?= $contact["id"] ?> - <?= $contact["method"] ?> <?= $contact["title"] ?></span><a href="/contact/results/<?=$contact["id"]?>" class=" float-right btn btn-sm btn-primary">Listado de seguimientos</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar un nuevo Seguimiento a un contacto con el cliente </h6>
	<hr>
	<form method="post" action="/contact/storeresult/<?= $contact["id"] ?>">
	  <div class="form-group">
	    <label for="exampleInputtitle">Título</label>
	    <input required type="text" class="form-control" name="title" id="exampleInputtitle" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDescription">Descripción</label>
	    <textarea id="exampleInputDescription" name="description" class="form-control" ></textarea>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputResult">Resultado</label>
	    <textarea id="exampleInputResult" name="result" class="form-control" ></textarea>
	  </div>
	  <div class="form-group">
	    <label for="date_result">Fecha de seguimiento</label>
	    <input required type="text" class="form-control" name="date_result" id="date_result" value="<?= date("Y-m-d") ?>" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputType">Estado</label>
	    <select class="form-control" name="status" id="exampleInputType" >
	    	<option value='Atendida'>Atendida</option>
	    	<option value='Cancelada por cliente'>Cancelada por cliente</option>
	    	<option value='Cancelada por asesor'>Cancelada por asesor</option>
	    </select>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputMethod">Siguiente paso</label>
	    <select class="form-control" name="next_step" id="exampleInputMethod" >
	    	<option value='Otro evento'>Otro evento</option>
	    	<option value='Cotizacion'>Cotización</option>
	    	<option value='Venta'>Venta</option>
	    	<option value='Proceso finalizado'>Proceso finalizado</option>
	    </select>
	  </div>
	  <button type="submit" class="btn btn-primary">Guardar</button>
	</form>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('#date_result').datetimepicker({
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
	});
</script>