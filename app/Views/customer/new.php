<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nuevo Cliente <a href="/user/index" class=" float-right btn btn-sm btn-primary">Listado de Clientes</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar un nuevo Clientes </h6>
	<hr>
	<form method="post" action="/customer/store">
	  <div class="form-group">
	    <label for="exampleInputName">Nombre</label>
	    <input required type="text" class="form-control" name="name" id="exampleInputName" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI">Identificación</label>
	    <input required type="text" maxlength="20" class="form-control" name="dni" id="exampleInputDNI"  value="<?= $customer["dni"] ?>">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputEmail1">Email</label>
	    <input required type="email" class="form-control" name="email" id="exampleInputEmail1" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPhone">Teléfono</label>
	    <input required type="text" class="form-control" name="phone" id="exampleInputPhone" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputAddress">Dirección</label>
	    <input required type="text" class="form-control" name="address" id="exampleInputAddress" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputCity">Ciudad</label>
	    <select class="form-control" name="city_id" id="exampleInputCity" >
	    	<?php foreach ($cityList as $city) {
	    		echo "<option value='{$city["id"]}'>{$city["name"]}</option>";
	    	} ?>
	    </select>
	  </div>
	  <button type="submit" class="btn btn-primary">Guardar</button>
	</form>
	</div>
</div>