<h1>Nuevo cliente</h1>
<a href="/customer">Todos los clientes</a>
<div class="card">
  <div class="card-body">
    <h2 class="card-title">Datos del nuevo cliente</h2>
	<form method="post" action="/customer/store">
	  <div class="form-group">
	    <label for="exampleInputEmail1">Email</label>
	    <input required type="email" class="form-control" name="email" id="exampleInputEmail1" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputName">Nombre</label>
	    <input required type="text" class="form-control" name="name" id="exampleInputName" >
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
	  <div class="form-group">
	    <label for="exampleInputPassword1">Password</label>
	    <input required type="password" class="form-control" name="password" id="exampleInputPassword1">
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
  </div>
</div>

