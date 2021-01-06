<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nuevo Pedido <a href="/product/index" class=" float-right btn btn-sm btn-primary">Listado de Pedidos</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar un nuevo Pedido </h6>
	<hr>
	<form method="post" action="/order/store">
	  
	  <div class="form-group">
	    <label for="exampleInputCustomer">Cliente</label>
	    <select class="form-control" name="customer_id" id="exampleInputCustomer" >
	    	<?php foreach ($customerList as $customer) {
	    		echo "<option value='{$customer["id"]}'>{$customer["name"]}</option>";
	    	} ?>
	    </select>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputdateOrder">Fecha de Pedido</label>
	    <input required type="date" class="form-control" name="date_order" id="exampleInputdateOrder" >
	  </div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>
