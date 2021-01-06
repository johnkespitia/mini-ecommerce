<div class="card">
  <div class="card-body">
<div class="row">
<div class="col-6">
	<div class="card">
	  <h5 class="card-header">Ventas por Productos</h5>
	  <div class="card-body">
	    <table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">Producto</th>
		      <th scope="col">Venta Total</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php
		  	foreach ($products as $prd) {
		  		?>
		  		<tr>
			      <th scope="row"><?= $prd["name"] ?></th>
			      <td>$ <?php 
			      	$total = array_reduce($orderItems, function($startVal, $oi) use($prd){
			      		if($oi["product_id"]==$prd["id"]){
			      			return $startVal + $oi["product_price_sold"];
			      		}
			      	});
			      	echo number_format($total,2,",",".");
			       ?></td>
			    </tr>
		  		<?php
		  	}
		    ?>
		  </tbody>
		</table>
	  </div>
	</div>
</div>
<div class="col-6">
	<div class="card">
	  <h5 class="card-header">Cliente Comprando</h5>
	  <div class="card-body">
	    <table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">Cliente</th>
		      <th scope="col">Venta Total</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php
		  	foreach ($customers as $cust) {
		  		?>
		  		<tr>
			      <th scope="row"><?= $cust["name"] ?></th>
			      <td>$ <?php 
			      	$total = array_reduce($orders, function($startVal, $o) use($cust){
			      		if($o["customer_id"]==$cust["id"]){
			      			return $startVal + $o["total"];
			      		}
			      	});
			      	echo number_format($total,2,",",".");
			       ?></td>
			    </tr>
		  		<?php
		  	}
		    ?>
		  </tbody>
		</table>
	  </div>
	</div>
</div>
</div>
</div>
</div>
