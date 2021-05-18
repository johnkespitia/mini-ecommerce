<div class="card">
	<div class="card-body">
		<h4 class="card-title">Nuevo Trailer <a href="/trailer/index" class=" float-right btn btn-sm btn-primary">Listado de Trailers</a></h4>
		<h6 class="card-subtitle mb-2 text-muted">Registrar un nuevo Trailer </h6>
		<hr>
		<form method="post" action="/trailer/store" enctype="multipart/form-data">
			<div class="form-group">
				<label for="exampleInputName">Placa</label>
				<input required type="text" class="form-control" maxlength="7" name="dni" id="exampleInputName">
			</div>
			<div class="form-group">
				<label for="register_code">Código de registro</label>
				<input required type="text" id="register_code" class="form-control" name="register_code" />
			</div>
			<div class="form-group">
				<label for="register_date">Fecha de registro</label>
				<input required type="date" id="register_date" class="form-control" name="register_date" />
			</div>
			<div class="form-group">
				<label for="register_city">Ciudad de registro</label>
				<input required type="text" id="register_city" class="form-control" name="register_city" />
			</div>
			<div class="form-group">
				<label for="brandInputName">Marca</label>
				<select required class="form-control" name="brand">
					<?php
					foreach ($BrandList as $ct) {
						echo "<option value='{$ct["id"]}'>{$ct["name"]}</option>";
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="cover">Revestimiento</label>
				<input required type="text" id="cover" class="form-control" name="cover" />
			</div>
			<div class="form-group">
				<label for="exampleInputName">Modelo</label>
				<input required type="number" class="form-control" name="model" min="1900" id="exampleInputName">
			</div>
			<div class="form-group">
				<label for="color">Color</label>
				<input required type="text" id="color" class="form-control" name="color" />
			</div>
			<div class="form-group">
				<label for="dni_color">Color de placa</label>
				<input required type="text" id="dni_color" class="form-control" name="dni_color" />
			</div>
			<div class="form-group">
				<label for="axis_number">Número de ejes</label>
				<input required type="number" class="form-control" name="axis_number" max="10" id="axis_number">
			</div>
			<div class="form-group">
				<label for="weight_capacity">Capacidad Toneladas</label>
				<input required type="number" class="form-control" step="0.5" name="weight_capacity" max="100" id="weight_capacity">
			</div>
			<div class="form-group">
				<label for="type">Tipo de Trailer</label>
				<select required class="form-control" name="type" id="type">
					<?php
					foreach ($carTypeList as $ct) {
						echo "<option value='{$ct["id"]}'>{$ct["name"]}</option>";
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="contractor">Contratista</label>
				<select required class="form-control" name="contractor">
					<?php
					foreach ($CarOwnerList as $ct) {
						echo "<option value='{$ct["id"]}'>{$ct["name"]}</option>";
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputStatus">Estado</label>
				<select class="form-control" name="status" id="exampleInputStatus">
					<option value='1'>Activo</option>
					<option value='2'>Inactivo</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>