<div class="card">
  <div class="card-body">
	<h4 class="card-title">Editar Vehículo <span  class="badge badge-primary"><?= $customer["dni"] ?></span>
		 <a href="/car/index" class=" float-right btn btn-sm btn-primary">Listado de Vehículos</a> 
	</h4>
	<h6 class="card-subtitle mb-2 text-muted">Editar Vehículo registrado </h6>
	<hr>
		<form method="post" action="/car/update/<?= $customer["id"] ?>">
		<div class="form-group">
				<label for="exampleInputName">Placa</label>
				<input required type="text" class="form-control" maxlength="7" name="dni" id="exampleInputName" value="<?=$customer["dni"]?>" >
			</div>
			<div class="form-group">
				<label for="exampleInputName">Modelo</label>
				<input required type="number" class="form-control" name="modelo" min="1900" id="exampleInputName" value="<?=$customer["modelo"]?>" >
			</div>
			<div class="form-group">
				<label for="exampleInputName">Tipo de Vehículo</label>
				<select required class="form-control" name="car_type" >
				<?php 
					foreach ($carTypeList as $ct) {
						$selected = ($customer["car_type"] == $ct["id"])?"selected='selected'":"";
						echo "<option {$selected} value='{$ct["id"]}'>{$ct["name"]}</option>";
					}
				?>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputStatus">Estado</label>
				<select class="form-control" name="status" id="exampleInputStatus" >
					<option <?= ($customer["status"]=="1")?"selected":"" ?> value='1'>Activo</option>
					<option <?= ($customer["status"]=="2")?"selected":"" ?> value='2'>Inactivo</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>