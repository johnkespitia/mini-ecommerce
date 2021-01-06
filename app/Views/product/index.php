<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Productos <a href="/product/new" class=" float-right btn btn-sm btn-primary">Nuevo Producto</a></h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los Productos registrados </h6>
    <table class="table">
    <thead class="thead-light">
        <tr>
            <th class="text-center">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">SKU</th>
            <th scope="col">precio</th>
            <th scope="col">Cantidad</th>
            <th class="text-right">Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php
  	foreach ($productsList as $cust) {
  		?>
  		<tr>
	      <th class="text-center" scope="row"><?= $cust["id"] ?></th>
	      <td><?= $cust["name"] ?></td>
	      <td><?= $cust["sku"] ?></td>
		  <td>$ <?= number_format($cust["price"],2,",",".") ?></td>
		  <td><?= $cust["quantity"] ?></td>
	      <td class="td-actions text-right">
        <a class="btn btn-warning btn-sm" href="/product/edit/<?=$cust["id"]?>"><i class="fas fa-pencil-alt"></i> Edit</a>
        <a class="btn btn-danger btn-sm" href="/product/delete/<?=$cust["id"]?>"><i class="fas fa-trash"></i> Eliminar</a>
	      </td>
	    </tr>
  		<?php
  	}
    ?>
    </tbody>
</table>
  </div>
</div>