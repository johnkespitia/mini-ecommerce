<h1>Nuevo Pedido</h1>
<a href="/order">Todos los pedidos</a>
<div class="card">
  <div class="card-body">
    <h2 class="card-title">Datos del nuevo pedido</h2>
	<form method="post" action="/order/store">
	  
	  <div class="form-group">
	    <label for="exampleInputCustomer">Cliente</label>
	    <select class="form-control" name="customer_id" id="exampleInputCustomer" >
	    	<?php foreach ($customerList as $customer) {
	    		echo "<option value='{$customer["id"]}'>{$customer["name"]}</option>";
	    	} ?>
	    </select>
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
  </div>
</div>

