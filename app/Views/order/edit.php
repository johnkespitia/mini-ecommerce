<h1>Editar cliente <?= $customer["name"] ?></h1>
<a href="/customer">Todos los clientes</a>
<div class="card">
  <div class="card-body">
    <h2 class="card-title">Datos del cliente</h2>
	<form method="post" action="/customer/update/<?= $customer["id"] ?>">
	  <div class="form-group">
	    <label for="exampleInputEmail1">Email</label>
	    <input required type="email" class="form-control" name="email" id="exampleInputEmail1" value="<?= $customer["email"] ?>" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputName">Nombre</label>
	    <input required type="text" class="form-control" name="name" id="exampleInputName"  value="<?= $customer["name"] ?>">
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
	  <div class="form-group">
	    <label for="exampleInputPassword1">Password</label>
	    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
  </div>
</div>

