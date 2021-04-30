<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nuevo Email de notificaciones <a href="/notificationemail/index" class=" float-right btn btn-sm btn-primary">Listado de Emails de notificaciones</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar nueva Email de notificaciones </h6>
	<hr>
		<form method="post" action="/notificationemail/store">
			<div class="form-group">
				<label for="exampleInputName">Email</label>
				<input required type="email" class="form-control" name="email" id="exampleInputName" >
			</div>
			<div class="form-group">
				<label for="exampleInputName">Tipo de notificación</label>
				<select required class="form-control" name="notification_type" id="exampleInputName" >
					<option value="VEHICLE_STATUS">Estado de vehículos</option>
					<option value="EMPLOYE_STATUS">Estado de Empleados</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>