<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Ordenes <a href="/order/new" class=" float-right btn btn-sm btn-primary">Nueva Orden</a></h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los Ordenes registradas </h6>
    <table class="table">
    <thead class="thead-light">
        <tr>
            <th class="text-center">#</th>
            <th scope="col">Fecha</th>
            <th scope="col">Cliente</th>
            <th scope="col">Total</th>
            <th scope="col">Productos</th>
            <th class="text-right">Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php
  	foreach ($orderList as $cust) {
  		?>
  		<tr>
	      <th class="text-center" scope="row"><?= $cust["id"] ?></th>
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
            echo "<li>{$cit["item_sku"]} - {$prod[0]["name"]} <a class='btn btn-danger btn-sm' href='/order/deleteitem/{$cit["id"]}'><i class='fas fa-minus-circle'></i> Eliminar Item</a></li>";
          }
        }	
	      ?></ul></td>
	      <td class="td-actions text-right">
          <a class="btn btn-primary btn-sm" href="/order/additem/<?=$cust["id"]?>"><i class="fas fa-plus-circle"></i> Añadir Items</a>
          <a class="btn btn-info btn-sm" href="/contact/order/<?=$cust["id"]?>"><i class="fas fa-calendar-alt"></i> Ver eventos</a>
          <?php if(count($orderItemList)==0){ ?>
            <a class="btn btn-danger btn-sm" href="/order/delete/<?=$cust["id"]?>"><i class="fas fa-trash"></i> Eliminar</a>
          <?php } ?>
	      </td>
	    </tr>
  		<?php
  	}
    ?>
    </tbody>
</table>
  </div>
</div>
