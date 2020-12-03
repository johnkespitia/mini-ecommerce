<h1>Listado de Productos</h1>
<a href="/product/new">Nuevo Producto</a>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">SKU</th>
      <th scope="col">precio</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
  	<?php
  	foreach ($productsList as $cust) {
  		?>
  		<tr>
	      <th scope="row"><?= $cust["id"] ?></th>
	      <td><?= $cust["name"] ?></td>
	      <td><?= $cust["sku"] ?></td>
	      <td>$ <?= number_format($cust["price"],2,",",".") ?></td>
	      <td>
	      	<a href="/product/edit/<?=$cust["id"]?>">Editar</a>
	      	<a href="/product/delete/<?=$cust["id"]?>">Eliminar</a>
	      </td>
	    </tr>
  		<?php
  	}
    ?>
  </tbody>
</table>