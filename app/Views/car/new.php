<script>
	$(document).ready(function() {
		$("#ConvenioEMpresarialfield").hide();
	})

	function showConvenios(combo) {
		if (combo.value == "CONVENIO EMPRESARIAL") {
			$("#ConvenioEMpresarialfield").show();
		} else {
			$("#ConvenioEMpresarial").val("");
			$("#ConvenioEMpresarialfield").hide();
		}
	}
</script>
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
				<label for="internal_number">Número Interno</label>
				<input required type="number" min="0" class="form-control" name="internal_number" />
			</div>
			<div class="form-group">
				<label for="relationship">Tipo de Relación</label>
				<select required class="form-control" name="relationship" onchange="showConvenios(this)">
					<option value='VEHÍCULO PROPIO'>VEHÍCULO PROPIO</option>
					<option value='VEHÍCULO AFILIADO'>VEHÍCULO AFILIADO</option>
					<option value='CONVENIO EMPRESARIAL'>CONVENIO EMPRESARIAL</option>
				</select>
			</div>
			<div class="form-group" id="ConvenioEMpresarialfield">
				<label for="ConvenioEMpresarial">Convenio Empresarial</label>
				<select class="form-control" id="ConvenioEMpresarial" name="company_agreement">
					<option value=''></option>
					<?php
					foreach ($companyAgreementList as $ct) {
						echo "<option value='{$ct["id"]}'>{$ct["name"]}</option>";
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="ccnumber">Cilindraje</label>
				<input type="number" min="0" class="form-control" name="cc" />
				</select>
			</div>
			<div class="form-group">
				<label for="color">Color</label>
				<input type="text" required class="form-control" name="color" />
			</div>
			<div class="form-group">
				<label for="service_permission">Servicio</label>
				<select required class="form-control" name="service_permission">
					<option value='PARTICULAR'>PARTICULAR</option>
					<option value='PUBLICO'>PUBLICO</option>
					<option value='OFICIAL'>OFICIAL</option>
					<option value='DIPLOMÁTICO'>DIPLOMÁTICO</option>
				</select>
			</div>
			<div class="form-group">
				<label for="bpdytype">Tipo de Carrocería</label>
				<input type="text" required class="form-control" name="body_type" />
			</div>
			<div class="form-group">
				<label for="door_nr">Número de Puertas</label>
				<input required type="number" min="0" class="form-control" name="no_doors" />
			</div>
			<div class="form-group">
				<label for="engine_nr">Número de Motor</label>
				<input required type="text" min="0" class="form-control" name="no_engine" />
			</div>
			<div class="form-group">
				<label for="vin">Vin</label>
				<input type="text" required class="form-control" name="vin" />
			</div>
			<div class="form-group">
				<label for="noSerieName">Número de serie</label>
				<input required type="text" min="0" class="form-control" name="no_serie" />
			</div>
			<div class="form-group">
				<label for="tnCharge">Toneladas Carga</label>
				<input required type="number" min="0" class="form-control" name="tn_charge" />
			</div>
			<div class="form-group">
				<label for="noChasis">Número de Chasis</label>
				<input required type="text" min="0" class="form-control" name="no_chasis" />
			</div>
			<div class="form-group">
				<label for="date_license">Fecha de Matricula</label>
				<input required type="date" class="form-control" name="date_license" id="exampleInputFinishDate">
			</div>
			<div class="form-group">
				<label for="oilchange">Kilometros para cambio de aceite</label>
				<input type="number" min="0" class="form-control" name="oil_change_km" value="0" />
			</div>
			<div class="form-group">
				<label for="ca_owner">Propietario</label>
				<select required class="form-control" name="car_owner">
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
			<div class="form-group">
				<label for="load-file">Foto</label>
				<input type="file" class="form-control" name="photo" id="load-file" accept=".jpg,.png,.gif,.jpeg" />
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>