<div class="card">
  <div class="card-body">
	<h4 class="card-title">Editar Email de notificación <span  class="badge badge-primary"><?= $rol["email"] ?></span>
		 <a href="/notificationemail/index" class=" float-right btn btn-sm btn-primary">Listado Email de notificación</a> 
	</h4>
	<h6 class="card-subtitle mb-2 text-muted">Editar Email registrado </h6>
	<hr>
		<form method="post" action="/notificationemail/update/<?= $rol["id"] ?>">
			<div class="form-group">
				<label for="exampleInputName">Email</label>
				<input required type="email" class="form-control" name="email" id="exampleInputName" value="<?=$rol["email"]?>">
			</div>
			<div class="form-group">
				<label for="exampleInputName">Tipo de notificación</label>
				<select required class="form-control" name="notification_type" id="exampleInputName" >
					<option <?=($rol["notification_type"]=="VEHICLE_STATUS")?"selected=selected":"" ?> value="VEHICLE_STATUS">Estado de vehículos</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>