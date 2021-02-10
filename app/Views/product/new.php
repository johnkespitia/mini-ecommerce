<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nuevo Producto <a href="/product/index" class=" float-right btn btn-sm btn-primary">Listado de Productos</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar un nuevo Producto </h6>
	<hr>
	<form method="post" action="/product/store" enctype="multipart/form-data">
	  <div class="form-group">
	    <label for="exampleInputName">Nombre</label>
	    <input required type="text" class="form-control" name="name" id="exampleInputName" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputSKU">SKU</label>
	    <input required type="text" class="form-control" maxlength="10" name="sku" id="exampleInputSKU" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPrice">Precio</label>
	    <input required type="number" min="0" class="form-control" name="price" id="exampleInputPrice" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputQuantity">Cantidad</label>
	    <input required type="number" min="0" class="form-control" name="quantity" id="exampleInputQuantity" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputMethod">Categoría</label>
	    <select class="form-control" name="category_id" id="exampleInputMethod" >
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
	  </div>
	  <div class="form-group">
	    <label for="exampleInputDescription">Descripción</label>
	    <textarea required class="form-control" name="description" id="exampleInputDescription"></textarea>
	  </div>
	  <div class="form-group">
	    <label for="image-prod">Imagen</label>
	    <input type="file" class="form-control" name="images" id="image-prod" accept="image/png, .jpeg, .jpg, image/gif"/>
	  </div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>
