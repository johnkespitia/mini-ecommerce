<div class="card">
  <div class="card-body">
	<h4 class="card-title">Editar Usuario <span  class="badge badge-primary"><?= $customer["name"] ?></span>
		<?php if($_SESSION["rol_id"] == 1 ){ ?> <a href="/user/index" class=" float-right btn btn-sm btn-primary">Listado de usuarios</a> <?php } ?> 
	</h4>
	<h6 class="card-subtitle mb-2 text-muted">Editar usuario registrado </h6>
	<hr>
		<form method="post" action="/user/update/<?= $customer["id"] ?>">
			<div class="form-group">
				<label for="exampleInputEmail1">Email</label>
				<input required type="email" class="form-control" name="email" id="exampleInputEmail1" value="<?= $customer["email"] ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputUsername1">Username</label>
				<input required type="text" class="form-control" name="username" id="exampleInputUsername1" value="<?= $customer["username"] ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName" value="<?= $customer["name"] ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputRol">Rol</label>
				<select class="form-control" name="rol_id" id="exampleInputRol" >
					<option <?= ($customer["rol_id"]=="2")?"selected":"" ?> value='2'>Asesor</option>
					<option <?= ($customer["rol_id"]=="1")?"selected":"" ?> value='1'>Administrador</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="password" class="form-control" name="password" id="exampleInputPassword1">
			</div>
			<?php if($_SESSION["rol_id"] == 1 ){ ?>
			<div class="form-group">
				<label for="exampleInputStatus">Estado</label>
				<select class="form-control" name="status" id="exampleInputStatus" >
					<option <?= ($customer["status"]=="1")?"selected":"" ?> value='1'>Activo</option>
					<option <?= ($customer["status"]=="2")?"selected":"" ?> value='2'>Inactivo</option>
				</select>
			</div>
			<?php } ?>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>