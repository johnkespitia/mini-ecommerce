<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Productos <a href="/product/loadfile" class=" float-right btn btn-sm btn-secondary">Creación masiva de productos</a>  <a href="/product/new" class=" float-right btn btn-sm btn-primary">Nuevo Producto</a><a href="/product/exportxls" class=" float-right btn btn-sm btn-warning mr-2">Exportar todos los productos</a><a href="/product/categories" class=" float-right btn btn-sm btn-info mr-2">Listado de categorías</a> </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los Productos registrados </h6>
      <form action="/product/" method="post" >
        <div class="p-4 bg-secondary input-group">
          <select class="form-control" name="category_id" id="exampleInputMethod" >
            <option value=''> Sin filtro de categoría</option>
            <?php foreach($categories as $pcat=>$cat){ 
            echo "<optgroup label='{$pcat}'>";
            foreach ($cat as $datacat) {
              ?>
              <option value='<?= $datacat["id"]?>'> <?= $datacat["name"] ?></option>
              <?php 
            }
            echo "</optgroup>";
          } ?>
          </select>
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit" id="button-addon2">Filtrar por categoría</button>
          </div>
        </div>
      </form>
    <table class="table">
    <thead class="thead-light">
        <tr>
            <th class="text-center">#</th>
            <th scope="col">Categoría</th>
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
	      <td><?= $cust["category_name"] ?></td>
	      <td><?= $cust["name"] ?></td>
	      <td><?= $cust["sku"] ?></td>
		  <td>$ <?= number_format($cust["price"],2,",",".") ?></td>
		  <td><?= $cust["quantity"] ?></td>
	      <td class="td-actions text-right">
        <a class="btn btn-warning btn-sm" href="/product/edit/<?=$cust["id"]?>"><i class="fas fa-pencil-alt"></i> Editar</a>
        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#productsModal<?= $cust["id"] ?>"><i class="fas fa-pencil-alt"></i> Ver detalles</button>

        <!-- Modal -->
        <div class="modal fade" id="productsModal<?= $cust["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="productsModal<?= $cust["id"] ?>" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalle de producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <img src="<?= $cust["images"] ?>" class="img-fluid text-center" />
                <h3 class="text-left"><?= $cust["name"] ?> <span class="badge badge-info">$ <?= number_format($cust["price"],2,",",".")?></span></h3>
                <p class="text-left"><?= $cust["description"]?></p>
                <ul class="text-left">
                  <li><span class="badge badge-success">Categoría:</span> <?= $cust["category_name"] ?></li>
                  <li><span class="badge badge-success">SKU:</span> <?= $cust["sku"] ?></li>
                  <li><span class="badge badge-success">Cantidad: </span> <?= $cust["quantity"] ?></li>
                </ul>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>
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