<div class="card">
  <div class="card-body">
    <h4 class="card-title">Editar Cliente <span  class="badge badge-primary"><?= $customer["name"] ?></span><a href="/customer/index" class=" float-right btn btn-sm btn-primary">Listado de Clientes</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Editar Cliente registrado </h6>
	<hr>
	<form method="post" action="/customer/update/<?= $customer["id"] ?>">
	  <div class="form-group">
	    <label for="exampleInputName">Nombre</label>
	    <input required type="text" class="form-control" name="name" id="exampleInputName"  value="<?= $customer["name"] ?>">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDNI">Identificación</label>
	    <input required type="text" maxlength="20" class="form-control" name="dni" id="exampleInputDNI"  value="<?= $customer["dni"] ?>">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputEmail1">Email</label>
	    <input required type="email" class="form-control" name="email" id="exampleInputEmail1" value="<?= $customer["email"] ?>" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPhone">Teléfono</label>
	    <input required type="text" class="form-control" name="phone" id="exampleInputPhone"  value="<?= $customer["phone"] ?>">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputAddress">Dirección</label>
	    <input required type="text" class="form-control" name="address" id="exampleInputAddress"  value="<?= $customer["address"] ?>">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputCity">Ciudad</label>
	    <select class="form-control" name="city_id" id="exampleInputCity" >
	    	<?php foreach ($cityList as $city) {
	    		$selected=($city["id"] == $customer["city_id"])?"selected":"";
	    		echo "<option {$selected} value='{$city["id"]}'>{$city["name"]}</option>";
	    	} ?>
	    </select>
	  </div>
	  <button type="submit" class="btn btn-primary">Guardar</button>
	</form>
	</div>
</div>
