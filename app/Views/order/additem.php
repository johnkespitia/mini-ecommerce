<div class="card">
  <div class="card-body">
    <h4 class="card-title">Agregar item al pedido <?= $order["id"] ?> <a href="/product/index" class=" float-right btn btn-sm btn-primary">Listado de Pedidos</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Seleccione el item al pedido e indique el SKU de ese item </h6>
	<hr>
	<form method="post" action="/order/storeitem/<?= $order["id"] ?>">
	  <div class="form-group">
	    <label for="exampleInputCity">Producto</label>
	    <select class="form-control" required name="product_id" id="exampleInputCity" >
	    	<?php foreach ($productList as $product) {
	    		echo "<option value='{$product["id"]}'>{$product["name"]} - {$product["price"]}</option>";
	    	} ?>
	    </select>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputSKU">SKU</label>
	    <input required type="text" class="form-control" maxlength="10" name="item_sku" id="exampleInputSKU" >
	  </div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>
