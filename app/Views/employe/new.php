<div class="card">
	<div class="card-body">
		<h4 class="card-title">Nuevo empleado <a href="/employe/index" class=" float-right btn btn-sm btn-primary">Listado de empleados</a></h4>
		<h6 class="card-subtitle mb-2 text-muted">Registrar un nuevo empleado </h6>
		<hr>
		<form method="post" action="/employe/store">
			<h5>Datos Personales</h5>
			<hr>
			<div class="form-group">
				<label for="exampleInputName">Nombre</label>
				<input required type="text" maxlength="150" class="form-control" name="name" id="exampleInputName">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Email</label>
				<input required type="email" maxlength="150" class="form-control" name="email" id="exampleInputEmail1">
			</div>
			<div class="form-group">
				<label for="exampleInputdni_type">Tipo de documento</label>
				<select class="form-control" name="dni_type" id="exampleInputdni_type">
					<option value='CC'>Cédula de ciudadanía</option>
					<option value='CE'>Cédula de extranjería</option>
					<option value='TI'>Tarjeta de identidad</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputdni1">Cédula</label>
				<input required type="text" maxlength="12" class="form-control" name="dni" id="exampleInputdni1">
			</div>
			<div class="form-group">
				<label for="examplecity_exp">Lugar de expedición</label>
				<input required type="text" class="form-control" name="city_exp" id="examplecity_exp">
			</div>
			<div class="form-group">
				<label for="examplebirth_date">Fecha Nacimiento</label>
				<input required type="date" class="form-control" name="birth_date" id="examplebirth_date">
			</div>
			<div class="form-group">
				<label for="exampleaddress">Dirección</label>
				<input required type="text" class="form-control" name="address" id="exampleaddress">
			</div>
			<div class="form-group">
				<label for="examplephone">Teléfono</label>
				<input required type="text" class="form-control" name="phone" id="examplephone">
			</div>
			<div class="form-group">
				<label for="examplerh">RH</label>
				<input required type="text" class="form-control" name="rh" id="examplerh">
			</div>
			<div class="form-group">
				<label for="exampleInputStatus">Estado</label>
				<select class="form-control" name="status" id="exampleInputStatus">
					<option value='1'>Activo</option>
					<option value='2'>Inactivo</option>
				</select>
			</div>
			<h5>Datos Laborales</h5>
			<hr>
			<div class="form-group">
				<label for="exampleInputposition">Cargo</label>
				<select class="form-control" name="position" id="exampleInputposition">
					<?php
					foreach ($positionsList as $position) { ?>
						<option value="<?= $position["id"] ?>"><?= $position["name"] ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputposition">Area</label>
				<select class="form-control" name="area" id="exampleInputposition">
					<?php
					foreach ($areaList as $position) { ?>
						<option value="<?= $position["id"] ?>"><?= $position["name"] ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputposition">Contratación</label>
				<select class="form-control" name="type_contract" id="exampleInputposition">
					<option value="EMPLEADO">EMPLEADO</option>
					<option value="CONTRATISTA">CONTRATISTA</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputposition">Tipo de Contrato</label>
				<input list="contract_agreement_options" class="form-control" name="contract_agreement" id="exampleInputposition">
				<datalist id="contract_agreement_options">
					<option value="INDEFINIDO">
					<option value="FIJO">
					<option value="OBRA LABOR">
				</datalist>
			</div>
			<div class="form-group">
				<label for="salary_field">Salario</label>
				<input required type="number" class="form-control" name="salary" id="salary_field">
			</div>
			<div class="form-group">
				<label for="start_date_field">Fecha de Inicio</label>
				<input required type="date" class="form-control" name="start_date" id="start_date_field">
			</div>
			<div class="form-group">
				<label for="base_field">Base</label>
				<select class="form-control" name="payment_base" id="base_field">
					<option value="DIARIO">DIARIO</option>
					<option value="SEMANAL">SEMANAL</option>
					<option value="QUINCENAL">QUINCENAL</option>
					<option value="MENSUAL">MENSUAL</option>
					<option value="TRIMESTRAL">TRIMESTRAL</option>
					<option value="SEMESTRAL">SEMESTRAL</option>
				</select>
			</div>
			<div class="form-group">
				<label for="extra_benefit_field">Subsidio</label>
				<input required type="number" class="form-control" name="extra_benefit" id="extra_benefit_field">
			</div>
			<h5>Datos Contractuales</h5>
			<hr>
			<div class="form-group">
				<label for="exampleInputpEPS">EPS</label>
				<select class="form-control" name="eps" id="exampleInputpEPS">
					<?php
					foreach ($epsList as $position) { ?>
						<option value="<?= $position["id"] ?>"><?= $position["name"] ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputArl">ARL</label>
				<input list="arl_list" class="form-control" name="arl" id="exampleInputArl">
				<datalist id="arl_list">
					<?php
					foreach ($arlList as $position) { ?>
						<option value="<?= $position["id"] ?>" label="<?= $position["name"] ?>" >
					<?php } ?>
				</datalist>
			</div>

			<div class="form-group">
				<label for="exampleInputCcomp">Caja de Compensación</label>
				<input list="ccomp_list" class="form-control" name="caja_compensacion" id="exampleInputCcomp">
				<datalist id="ccomp_list">
					<?php
					foreach ($ccompList as $position) { ?>
						<option value="<?= $position["id"] ?>" label="<?= $position["name"] ?>" >
					<?php } ?>
				</datalist>
			</div>
			
			<div class="form-group">
				<label for="exampleInputPens">Pensiones</label>
				<input list="pension_list" class="form-control" name="pension" id="exampleInputPens">
				<datalist id="pension_list">
					<?php
					foreach ($pensionList as $position) { ?>
						<option value="<?= $position["id"] ?>" label="<?= $position["name"] ?>" >
					<?php } ?>
				</datalist>
			</div>
			
			<div class="form-group">
				<label for="exampleInputCesant">Cesantías</label>
				<input list="cesantias_list" class="form-control" name="cesantias" id="exampleInputCesant">
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
				<input list="bankList_list" class="form-control" name="bank" id="exampleInputCesant">
				<datalist id="bankList_list">
					<?php
					foreach ($bankList as $position) { ?>
						<option value="<?= $position["id"] ?>" label="<?= $position["name"] ?>" >
					<?php } ?>
				</datalist>
			</div>
			
			<div class="form-group">
				<label for="exampleInputaccount_type">Tipo de Cuenta</label>
				<select class="form-control" name="account_type" id="account_type">
					<option value="AHORROS">AHORROS</option>
					<option value="CORRIENTE">CORRIENTE</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputaccount_number">Número de cuenta</label>
				<input required type="number" class="form-control" name="account_number" id="account_number">
			</div>
			<div class="form-group">
				<label for="exampleInputaccount_type">Método de Pago</label>
				<input required type="text" class="form-control" name="payment_method" id="payment_method">
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>