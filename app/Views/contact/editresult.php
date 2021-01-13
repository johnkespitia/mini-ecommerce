<link rel="stylesheet" type="text/css" href="/libs/datetimepicker/jquery.datetimepicker.css"/>
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Editar Seguimiento <span class="badge badge-info"><?= $contactResult["id"] ?> - <?= $contactResult["title"] ?></span><a href="/contact/results/<?=$contactResult["contact_id"]?>" class=" float-right btn btn-sm btn-primary">Listado de seguimientos</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Editar un nuevo Seguimiento a un contacto con el cliente </h6>
	<hr>
	<form method="post" action="/contact/updateresult/<?= $contactResult["id"] ?>">
	  <div class="form-group">
	    <label for="exampleInputtitle">Título</label>
	    <input required type="text" class="form-control" name="title" id="exampleInputtitle" value="<?= $contactResult["title"] ?>" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDescription">Descripción</label>
	    <textarea id="exampleInputDescription" name="description" class="form-control" ><?= $contactResult["description"] ?></textarea>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputResult">Resultado</label>
	    <textarea id="exampleInputResult" name="result" class="form-control" ><?= $contactResult["result"] ?></textarea>
	  </div>
	  <div class="form-group">
	    <label for="date_result">Fecha de seguimiento</label>
	    <input required type="text" class="form-control" name="date_result" id="date_result"  value="<?= $contactResult["date_result"] ?>" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputType">Estado</label>
	    <select class="form-control" name="status" id="exampleInputType" >
	    	<option value='Atendida' <?= $contactResult["status"]=="Atendida"?"selected":"" ?>>Atendida</option>
	    	<option value='Cancelada por cliente' <?= $contactResult["status"]=="Cancelada por cliente"?"selected":"" ?>>Cancelada por cliente</option>
	    	<option value='Cancelada por asesor' <?= $contactResult["status"]=="Cancelada por asesor"?"selected":"" ?>>Cancelada por asesor</option>
	    </select>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputMethod">Siguiente paso</label>
	    <select class="form-control" name="next_step" id="exampleInputMethod" >
	    	<option value='Otro evento' <?= $contactResult["next_step"]=="Otro evento"?"selected":"" ?>>Otro evento</option>
	    	<option value='Cotizacion' <?= $contactResult["next_step"]=="Cotizacion"?"selected":"" ?>>Cotización</option>
	    	<option value='Venta' <?= $contactResult["next_step"]=="Venta"?"selected":"" ?>>Venta</option>
	    	<option value='Proceso finalizado' <?= $contactResult["next_step"]=="Proceso finalizado"?"selected":"" ?>>Proceso finalizado</option>
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