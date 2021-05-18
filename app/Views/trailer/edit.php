<div class="card">
	<div class="card-body">
		<h4 class="card-title">Editar Trailer <span class="badge badge-primary"><?= $customer["dni"] ?></span>
			<a href="/trailer/index" class=" float-right btn btn-sm btn-primary">Listado de Trailers</a>
		</h4>
		<h6 class="card-subtitle mb-2 text-muted">Editar Trailer registrado </h6>
		<hr>
		<form method="post" action="/trailer/update/<?= $customer["id"] ?>">
			<div class="form-group">
				<label for="exampleInputName">Placa</label>
				<input required type="text" class="form-control" maxlength="7" name="dni" id="exampleInputName" value="<?= $customer["dni"] ?>"">
			</div>
			<div class="form-group">
				<label for="register_code">Código de registro</label>
				<input required type="text" id="register_code" class="form-control" name="register_code" value="<?= $customer["register_code"] ?>" />
			</div>
			<div class="form-group">
				<label for="register_date">Fecha de registro</label>
				<input required type="date" id="register_date" class="form-control" name="register_date" value="<?= $customer["register_date"] ?>" />
			</div>
			<div class="form-group">
				<label for="register_city">Ciudad de registro</label>
				<input required type="text" id="register_city" class="form-control" name="register_city" value="<?= $customer["register_city"] ?>" />
			</div>
			<div class="form-group">
				<label for="brandInputName">Marca</label>
				<select required class="form-control" name="brand">
					<?php
					foreach ($BrandList as $ct) {
						$selected = ($ct["id"] == $customer["brand"]) ? "seleted='selected'" : "";
						echo "<option {$selected} value='{$ct["id"]}'>{$ct["name"]}</option>";
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="cover">Revestimiento</label>
				<input required type="text" id="cover" class="form-control" name="cover" value="<?= $customer["cover"] ?>" />
			</div>
			<div class="form-group">
				<label for="exampleInputName">Modelo</label>
				<input required type="number" class="form-control" name="model" value="<?= $customer["model"] ?>" min="1900" id="exampleInputName">
			</div>
			<div class="form-group">
				<label for="color">Color</label>
				<input required type="text" id="color" class="form-control" name="color" value="<?= $customer["color"] ?>" />
			</div>
			<div class="form-group">
				<label for="dni_color">Color de placa</label>
				<input required type="text" id="dni_color" class="form-control" name="dni_color" value="<?= $customer["dni_color"] ?>" />
			</div>
			<div class="form-group">
				<label for="axis_number">Número de ejes</label>
				<input required type="number" class="form-control" name="axis_number" max="10" id="axis_number" value="<?= $customer["axis_number"] ?>">
			</div>
			<div class="form-group">
				<label for="weight_capacity">Capacidad Toneladas</label>
				<input required type="number" class="form-control" step="0.5" name="weight_capacity" value="<?= $customer["weight_capacity"] ?>" max="100" id="weight_capacity">
			</div>
			<div class="form-group">
				<label for="type">Tipo de Trailer</label>
				<select required class="form-control" name="type" id="type">
					<?php
					foreach ($carTypeList as $ct) {
						$selected = ($ct["id"] == $customer["type"]) ? "seleted='selected'" : "";
						echo "<option {$selected} value='{$ct["id"]}'>{$ct["name"]}</option>";
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="contractor">Contratista</label>
				<select required class="form-control" name="contractor">
					<?php
					foreach ($CarOwnerList as $ct) {
						$selected = ($ct["id"] == $customer["contractor"]) ? "seleted='selected'" : "";
						echo "<option {$selected} value='{$ct["id"]}'>{$ct["name"]}</option>";
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputStatus">Estado</label>
				<select class="form-control" name="status" id="exampleInputStatus">
					<option <?= ($customer["status"] == "1") ? "selected" : "" ?> value='1'>Activo</option>
					<option <?= ($customer["status"] == "2") ? "selected" : "" ?> value='2'>Inactivo</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>