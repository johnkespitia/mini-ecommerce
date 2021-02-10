<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Productos <a href="/product/newcategory" class=" float-right btn btn-sm btn-primary">Nueva Categoría</a><a href="/product/" class=" float-right btn btn-sm btn-info mr-2">Listado de Productos</a></h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los Productos registrados </h6>
    <table class="table">
    <thead class="thead-light">
        <tr>
            <th class="text-center">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Categoría Padre</th>
            <th class="text-right">Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php
  	foreach ($categories as $cust) {
  		?>
  		<tr>
	      <th class="text-center" scope="row"><?= $cust["id"] ?></th>
	      <td><?= $cust["name"] ?></td>
		    <td><?= $cust["parent_name"] ?></td>
	      <td class="td-actions text-right">
          <a class="btn btn-warning btn-sm" href="/product/editcategory/<?=$cust["id"]?>"><i class="fas fa-pencil-alt"></i> Editar</a>
	      </td>
	    </tr>
  		<?php
  	}
    ?>
    </tbody>
</table>
  </div>
</div>