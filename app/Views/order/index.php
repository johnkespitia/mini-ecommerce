<h1>Listado de Ordenes</h1>
<a href="/order/new">Nueva orden</a>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Fecha</th>
      <th scope="col">Cliente</th>
      <th scope="col">Total</th>
      <th scope="col">Productos</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
  	<?php
  	foreach ($orderList as $cust) {
  		?>
  		<tr>
	      <th scope="row"><?= $cust["id"] ?></th>
	      <td><?= $cust["date_order"] ?></td>
	      <td><?php 
        foreach ($customerList as $cit) {
          if($cit["id"] == $cust["customer_id"]){
            echo $cit["name"];
          }
        } 
        ?></td>
	      <td>$ <?= number_format($cust["total"],2,",",".") ?></td>
	      <td><ul><?php 
        foreach ($orderItemList as $cit) {
          if($cit["order_id"] == $cust["id"]){
            $prod = array_filter($productList, function($prd) use($cit){
              return $cit["product_id"]==$prd["id"];
            });
            echo "<li>{$prod[0]["name"]} <a href='/order/deleteitem/{$cit["id"]}'>Eliminar Item</a></li>";
          }
        }	
	      ?></ul></td>
	      <td>
          <a href="/order/additem/<?=$cust["id"]?>">Añadir Items</a>
	      	<a href="/order/delete/<?=$cust["id"]?>">Eliminar</a>
	      </td>
	    </tr>
  		<?php
  	}
    ?>
  </tbody>
</table>