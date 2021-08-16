<div class="card">
	<div class="card-body">
		<h4 class="card-title">Editar Empleado <span class="badge badge-primary"><?= $customer["name"] ?></span>
			<a href="/employe/index" class=" float-right btn btn-sm btn-primary">Listado de Empleados</a>
		</h4>
		<h6 class="card-subtitle mb-2 text-muted">Editar Empleado registrado </h6>
		<hr>
		<form method="post" action="/employe/update/<?= $customer["id"] ?>" enctype="multipart/form-data">
			<h5>Datos Personales</h5>
			<hr>
			<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" class="form-control" name="name" maxlength="150" id="exampleInputName" value="<?= $customer["name"] ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Email</label>
				<input required type="email" class="form-control" name="email" maxlength="150" id="exampleInputEmail1" value="<?= $customer["email"] ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputdni_type">Tipo de documento</label>
				<select class="form-control" name="dni_type" id="exampleInputdni_type">
					<option  <?= ($customer["status"] == "CC") ? "selected" : "" ?> value='CC'>Cédula de ciudadanía</option>
					<option  <?= ($customer["status"] == "CE") ? "selected" : "" ?> value='CE'>Cédula de extranjería</option>
					<option  <?= ($customer["status"] == "TI") ? "selected" : "" ?> value='TI'>Tarjeta de identidad</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputdni1">Cédula</label>
				<input required type="text" maxlength="12" class="form-control" name="dni" id="exampleInputdni1" value="<?= $customer["dni"] ?>">
			</div>
			<div class="form-group">
				<label for="examplecity_exp">Lugar de expedición</label>
				<input required type="text" class="form-control" value="<?= $customer["city_exp"] ?>" name="city_exp" id="examplecity_exp">
			</div>
			<div class="form-group">
				<label for="examplebirth_date">Fecha Nacimiento</label>
				<input required type="date" class="form-control" value="<?= $customer["birth_date"] ?>" name="birth_date" id="examplebirth_date">
			</div>
			<div class="form-group">
				<label for="exampleaddress">Dirección</label>
				<input required type="text" class="form-control" value="<?= $customer["address"] ?>" name="address" id="exampleaddress">
			</div>
			<div class="form-group">
				<label for="examplephone">Teléfono</label>
				<input required type="text" class="form-control" value="<?= $customer["phone"] ?>" name="phone" id="examplephone">
			</div>
			<div class="form-group">
				<label for="examplerh">RH</label>
				<input required type="text" class="form-control" value="<?= $customer["rh"] ?>" name="rh" id="examplerh">
			</div>
			<div class="form-group">
				<label for="exampleInputStatus">Estado</label>
				<select class="form-control" name="status" id="exampleInputStatus">
					<option <?= ($customer["status"] == "1") ? "selected" : "" ?> value='1'>Activo</option>
					<option <?= ($customer["status"] == "2") ? "selected" : "" ?> value='2'>Inactivo</option>
				</select>
			</div>
			<h5>Datos Laborales</h5>
			<hr>
			<div class="form-group">
				<label for="exampleInputposition">Cargo</label>
				<select class="form-control" name="position" id="exampleInputposition">
					<?php
					foreach ($positionsList as $position) { 
						$selected = ($position["id"] == $customer["position"])?"selected='selected'":"";
						?>
						<option <?= $selected ?> value="<?= $position["id"] ?>"><?= $position["name"] ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputposition">Area</label>
				<select class="form-control" name="area" id="exampleInputposition">
					<?php
					foreach ($areaList as $position) {  
						$selected = ($position["id"] == $customer["area"])?"selected='selected'":"";
						?>
						<option <?= $selected ?> value="<?= $position["id"] ?>"><?= $position["name"] ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputposition">Contratación</label>
				<select class="form-control" name="type_contract" id="exampleInputposition">
					<option <?= ($customer["type_contract"] == "EMPLEADO")?"selected='selected'":"" ?> value="EMPLEADO">EMPLEADO</option>
					<option <?= ($customer["type_contract"] == "CONTRATISTA")?"selected='selected'":"" ?> value="CONTRATISTA">CONTRATISTA</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputposition">Tipo de Contrato</label>
				<input list="contract_agreement_options" class="form-control" value="<?= $customer["contract_agreement"] ?>" name="contract_agreement" id="exampleInputposition">
				<datalist id="contract_agreement_options">
					<option value="INDEFINIDO">
					<option value="FIJO">
					<option value="OBRA LABOR">
				</datalist>
			</div>
			<div class="form-group">
				<label for="salary_field">Salario</label>
				<input required type="number" class="form-control"  value="<?= $customer["salary"] ?>" name="salary" id="salary_field">
			</div>
			<div class="form-group">
				<label for="start_date_field">Fecha de Inicio</label>
				<input required type="date" class="form-control" value="<?= $customer["start_date"] ?>" name="start_date" id="start_date_field">
			</div>
			<div class="form-group">
				<label for="base_field">Base</label>
				<select class="form-control" name="payment_base" id="base_field">
					<option  <?= ($customer["type_contract"] == "DIARIO")?"selected='selected'":"" ?> value="DIARIO">DIARIO</option>
					<option  <?= ($customer["type_contract"] == "SEMANAL")?"selected='selected'":"" ?> value="SEMANAL">SEMANAL</option>
					<option  <?= ($customer["type_contract"] == "QUINCENAL")?"selected='selected'":"" ?> value="QUINCENAL">QUINCENAL</option>
					<option  <?= ($customer["type_contract"] == "MENSUAL")?"selected='selected'":"" ?> value="MENSUAL">MENSUAL</option>
					<option  <?= ($customer["type_contract"] == "TRIMESTRAL")?"selected='selected'":"" ?> value="TRIMESTRAL">TRIMESTRAL</option>
					<option  <?= ($customer["type_contract"] == "SEMESTRAL")?"selected='selected'":"" ?> value="SEMESTRAL">SEMESTRAL</option>
				</select>
			</div>
			<div class="form-group">
				<label for="extra_benefit_field">Subsidio</label>
				<input required type="number" class="form-control" name="extra_benefit" value="<?= $customer["extra_benefit"] ?>"  id="extra_benefit_field">
			</div>
			<h5>Datos Contractuales</h5>
			<hr>
			<div class="form-group">
				<label for="exampleInputpEPS">EPS</label>
				<select class="form-control" name="eps" id="exampleInputpEPS">
					<?php
					foreach ($epsList as $position) {   
						$selected = ($position["id"] == $customer["eps"])?"selected='selected'":"";
						?>
						<option <?= $selected ?> value="<?= $position["id"] ?>"><?= $position["name"] ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputArl">ARL</label>
				<input list="arl_list" class="form-control" value="<?= $customer["arl"] ?>" name="arl" id="exampleInputArl">
				<datalist id="arl_list">
					<?php
					foreach ($arlList as $position) { ?>
						<option value="<?= $position["id"] ?>" label="<?= $position["name"] ?>" >
					<?php } ?>
				</datalist>
			</div>

			<div class="form-group">
				<label for="exampleInputCcomp">Caja de Compensación</label>
				<input list="ccomp_list" class="form-control" value="<?= $customer["caja_compensacion"] ?>" name="caja_compensacion" id="exampleInputCcomp">
				<datalist id="ccomp_list">
					<?php
					foreach ($ccompList as $position) { ?>
						<option value="<?= $position["id"] ?>" label="<?= $position["name"] ?>" >
					<?php } ?>
				</datalist>
			</div>
			
			<div class="form-group">
				<label for="exampleInputPens">Pensiones</label>
				<input list="pension_list" class="form-control" value="<?= $customer["pension"] ?>" name="pension" id="exampleInputPens">
				<datalist id="pension_list">
					<?php
					foreach ($pensionList as $position) { ?>
						<option value="<?= $position["id"] ?>" label="<?= $position["name"] ?>" >
					<?php } ?>
				</datalist>
			</div>
			
			<div class="form-group">
				<label for="exampleInputCesant">Cesantías</label>
				<input list="cesantias_list" class="form-control" value="<?= $customer["cesantias"] ?>" name="cesantias" id="exampleInputCesant">
				<datalist id="cesantias_list">
					<?php
					foreach ($cesantiasList as $position) { ?>
						<option value="<?= $position["id"] ?>" label="<?= $position["name"] ?>" >
					<?php } ?>
				</datalist>
			</div>
			<h5>Datos Bancarios</h5>
			<hr>
			<div class="form-group">
				<label for="exampleInputCesant">Banco</label>
				<input list="bankList_list" class="form-control" name="bank" value="<?= $customer["bank"] ?>" id="exampleInputCesant">
				<datalist id="bankList_list">
					<?php
					foreach ($bankList as $position) { 
						?>
						<option value="<?= $position["id"] ?>" label="<?= $position["name"] ?>" >
					<?php } ?>
				</datalist>
			</div>
			
			<div class="form-group">
				<label for="exampleInputaccount_type">Tipo de Cuenta</label>
				<select class="form-control" name="account_type" id="account_type">
					<option <?= ($customer["type_contract"] == "AHORROS")?"selected='selected'":"" ?> value="AHORROS">AHORROS</option>
					<option <?= ($customer["type_contract"] == "CORRIENTE")?"selected='selected'":"" ?> value="CORRIENTE">CORRIENTE</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputaccount_number">Número de cuenta</label>
				<input required type="number" class="form-control" value="<?= $customer["account_number"] ?>" name="account_number" id="account_number">
			</div>
			<div class="form-group">
				<label for="exampleInputaccount_type">Método de Pago</label>
				<input required type="text" class="form-control" value="<?= $customer["payment_method"] ?>" name="payment_method" id="payment_method">
			</div>
			<div class="form-group">
				<label for="exampleInputpasswordapp">Password App</label>
				<input type="text" class="form-control" name="app_password" id="app_password">
			</div>
			<div class="form-group">
				<label for="load-file">Archivo firma</label>
				<input type="file" class="form-control" name="load_file" accept="image/*;capture=camera" id="load-file" />
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>