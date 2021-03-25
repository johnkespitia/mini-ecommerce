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
				<label for="brandInputName">Marca</label>
				<select required class="form-control" name="brand" >
				<?php 
					foreach ($BrandList as $ct) {
						$selected = ($customer["brand"] == $ct["id"])?"selected='selected'":"";
						echo "<option {$selected} value='{$ct["id"]}'>{$ct["name"]}</option>";
					}
				?>
				</select>
			</div>
			<div class="form-group">
				<label for="lineInputName">Línea</label>
				<select required class="form-control" name="line_category" >
				<?php 
					foreach ($LineList as $ct) {
						$selected = ($customer["line_category"] == $ct["id"])?"selected='selected'":"";
						echo "<option {$selected} value='{$ct["id"]}'>{$ct["name"]}</option>";
					}
				?>
				</select>
			</div>
			<div class="form-group">
				<label for="fuelInputName">Tipo de Combustible</label>
				<select required class="form-control" name="fuel_type" >
				<?php 
					foreach ($FuelTypeList as $ct) {
						$selected = ($customer["fuel_type"] == $ct["id"])?"selected='selected'":"";
						echo "<option {$selected} value='{$ct["id"]}'>{$ct["name"]}</option>";
					}
				?>
				</select>
			</div>
			<div class="form-group">
				<label for="servicetypeInputName">Tipo de Servicio</label>
				<select required class="form-control" name="service_type" >
				<?php 
					foreach ($ServiceTypeList as $ct) {
						$selected = ($customer["service_type"] == $ct["id"])?"selected='selected'":"";
						echo "<option {$selected} value='{$ct["id"]}'>{$ct["name"]}</option>";
					}
				?>
				</select>
			</div>
			<div class="form-group">
				<label for="internal_number">Número Interno</label>
				<input required type="number" min="0" class="form-control" name="internal_number" value="<?=$customer["internal_number"]?>" />
			</div>
			<div class="form-group">
				<label for="relationship">Tipo de Relación</label>
				<select required class="form-control" name="relationship">
					<option <?= ($customer["relationship"] == "VEHÍCULO PROPIO")?"selected='selected'":"" ?> value='VEHÍCULO PROPIO'>VEHÍCULO PROPIO</option>
					<option <?= ($customer["relationship"] == "VEHÍCULO AFILIADO")?"selected='selected'":"" ?> value='VEHÍCULO AFILIADO'>VEHÍCULO AFILIADO</option>
					<option <?= ($customer["relationship"] == "CONVENIO EMPRESARIAL")?"selected='selected'":"" ?> value='CONVENIO EMPRESARIAL'>CONVENIO EMPRESARIAL</option>
				</select>
			</div>
			<div class="form-group">
				<label for="ccnumber">Cilindraje</label>
				<input type="number" min="0" class="form-control" name="cc" value="<?=$customer["cc"]?>"/>
				</select>
			</div>
			<div class="form-group">
				<label for="color">Color</label>
				<input type="text" required class="form-control" name="color" value="<?=$customer["color"]?>"/>
			</div>
			<div class="form-group">
				<label for="service_permission">Servicio</label>
				<select required class="form-control" name="service_permission">
					<option <?= ($customer["service_permission"] == "PARTICULAR")?"selected='selected'":"" ?> value='PARTICULAR'>PARTICULAR</option>
					<option <?= ($customer["service_permission"] == "PUBLICO")?"selected='selected'":"" ?> value='PUBLICO'>PUBLICO</option>
					<option <?= ($customer["service_permission"] == "OFICIAL")?"selected='selected'":"" ?> value='OFICIAL'>OFICIAL</option>
					<option <?= ($customer["service_permission"] == "DIPLOMÁTICO")?"selected='selected'":"" ?> value='DIPLOMÁTICO'>DIPLOMÁTICO</option>
				</select>
			</div>
			<div class="form-group">
				<label for="bpdytype">Tipo de Carrocería</label>
				<input type="text" required class="form-control" name="body_type" value="<?=$customer["body_type"]?>" />
			</div>
			<div class="form-group">
				<label for="door_nr">Número de Puertas</label>
				<input required type="number" min="0" class="form-control" name="no_doors"  value="<?=$customer["no_doors"]?>"/>
			</div>
			<div class="form-group">
				<label for="engine_nr">Número de Motor</label>
				<input required type="text" min="0" class="form-control" name="no_engine"  value="<?=$customer["no_engine"]?>"/>
			</div>
			<div class="form-group">
				<label for="vin">Vin</label>
				<input type="text" required class="form-control" name="vin"  value="<?=$customer["vin"]?>"/>
			</div>
			<div class="form-group">
				<label for="noSerieName">Número de serie</label>
				<input required type="text" min="0" class="form-control" name="no_serie" value="<?=$customer["no_serie"]?>" />
			</div>
			<div class="form-group">
				<label for="tnCharge">Toneladas Carga</label>
				<input required type="number" min="0" class="form-control" name="tn_charge" value="<?=$customer["tn_charge"]?>"/>
			</div>
			<div class="form-group">
				<label for="noChasis">Número de Chasis</label>
				<input required type="text" min="0" class="form-control" name="no_chasis" value="<?=$customer["no_chasis"]?>"/>
			</div>
			<div class="form-group">
				<label for="date_license">Fecha de Matricula</label>
				<input required type="date" class="form-control" name="date_license" id="exampleInputFinishDate" value="<?=$customer["date_license"]?>">
			</div>
			<div class="form-group">
				<label for="oilchange">Kilometros para cambio de aceite</label>
				<input required type="number" min="0" class="form-control" name="oil_change_km" value="<?=$customer["oil_change_km"]?>"/>
			</div>
			<div class="form-group">
				<label for="ca_owner">Propietario</label>
				<select required class="form-control" name="car_owner">
					<?php
					foreach ($CarOwnerList as $ct) {
						$selected = ($customer["service_type"] == $ct["id"])?"selected='selected'":"";
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