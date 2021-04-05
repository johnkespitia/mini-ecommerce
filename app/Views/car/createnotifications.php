<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nueva Notificación <a href="/car/notifications/<?= $car["id"]?>" class=" float-right btn btn-sm btn-primary">Listado de Notificaciones</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar una nueva notificación </h6>
	<hr>
		<form method="post" action="/car/storenotification">
			<div class="form-group">
				<label for="exampleInputDNI">Tipo de notificación</label>
				<select class="form-control" name="notification_type" >
					<?php foreach ($typeNotifications as $notType) {
						echo "<option value='{$notType["id"]}'>{$notType["name"]}</option>";
					}?>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputName">Tipo alerta </label>
				<select name="value_type" class="form-control">
					<option value="KILOMETROS">KILOMETROS</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail">Valor de alerta (Kilometros/Días)</label>
				<input required type="text" class="form-control" name="value_compare" id="exampleInputEmail" >
			</div>
			<div class="form-group">
				<label for="exampleInputEmail">Notificar despues de (Kilometros/Días)</label>
				<input required type="text" class="form-control" name="avg_reminder" id="exampleInputEmail" >
			</div>
			<input type="hidden" name="car" value="<?= $car["id"] ?>" />
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>