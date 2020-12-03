<h1>Agregar item al pedido <?= $order["id"] ?></h1>
<a href="/customer">Todos los pedidos</a>
<div class="card">
  <div class="card-body">
    <h2 class="card-title">Datos del cliente</h2>
	<form method="post" action="/order/storeitem/<?= $order["id"] ?>">
	  <div class="form-group">
	    <label for="exampleInputCity">Producto</label>
	    <select class="form-control" name="product_id" id="exampleInputCity" >
	    	<?php foreach ($productList as $product) {
	    		echo "<option value='{$product["id"]}'>{$product["name"]} - {$product["price"]}</option>";
	    	} ?>
	    </select>
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
  </div>
</div>

