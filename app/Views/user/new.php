<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nuevo Usuario <a href="/user/index" class=" float-right btn btn-sm btn-primary">Listado de usuarios</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar un nuevo usuario </h6>
	<hr>
		<form method="post" action="/user/store">
			<div class="form-group">
				<label for="exampleInputEmail1">Email</label>
				<input required type="email" class="form-control" name="email" id="exampleInputEmail1" >
			</div>
			<div class="form-group">
				<label for="exampleInputUsername1">Username</label>
				<input required type="text" class="form-control" name="username" id="exampleInputUsername1" >
			</div>
			<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName" >
			</div>
			<div class="form-group">
				<label for="exampleInputRol">Rol</label>
				<select class="form-control" name="rol_id" id="exampleInputRol" >
					<?php 
					foreach($rolsList as $rol){
						echo "<option value='{$rol['id']}'>{$rol['name']}</option>";
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input required type="password" class="form-control" name="password" id="exampleInputPassword1">
			</div>
			<div class="form-group">
				<label for="exampleInputStatus">Estado</label>
				<select class="form-control" name="status" id="exampleInputStatus" >
					<option value='1'>Activo</option>
					<option value='2'>Inactivo</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>