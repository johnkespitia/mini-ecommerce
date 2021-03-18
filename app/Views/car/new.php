<div class="card">
	<div class="card-body">
		<h4 class="card-title">Nuevo Vehículo <a href="/car/index" class=" float-right btn btn-sm btn-primary">Listado de Vehículos</a></h4>
		<h6 class="card-subtitle mb-2 text-muted">Registrar un nuevo vehículo </h6>
		<hr>
		<form method="post" action="/car/store" enctype="multipart/form-data">
			<div class="form-group">
				<label for="exampleInputName">Placa</label>
				<input required type="text" class="form-control" maxlength="7" name="dni" id="exampleInputName">
			</div>
			<div class="form-group">
				<label for="exampleInputName">Modelo</label>
				<input required type="number" class="form-control" name="modelo" min="1900" id="exampleInputName">
			</div>
			<div class="form-group">
				<label for="exampleInputName">Tipo de Vehículo</label>
				<select required class="form-control" name="car_type">
					<?php
					foreach ($carTypeList as $ct) {
						echo "<option value='{$ct["id"]}'>{$ct["name"]}</option>";
					}
					?>
				</select>
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
				<label for="lineInputName">Línea</label>
				<select required class="form-control" name="line_category">
					<?php
					foreach ($LineList as $ct) {
						echo "<option value='{$ct["id"]}'>{$ct["name"]}</option>";
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="fuelInputName">Tipo de Combustible</label>
				<select required class="form-control" name="fuel_type">
					<?php
					foreach ($FuelTypeList as $ct) {
						echo "<option value='{$ct["id"]}'>{$ct["name"]}</option>";
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="servicetypeInputName">Tipo de Servicio</label>
				<select required class="form-control" name="service_type">
					<?php
					foreach ($ServiceTypeList as $ct) {
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
			<div class="form-group">
				<label for="load-file">Foto</label>
				<input type="file" class="form-control" name="photo" id="load-file" accept=".jpg,.png,.gif,.jpeg" />
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>