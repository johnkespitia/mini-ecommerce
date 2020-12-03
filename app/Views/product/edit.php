<h1>Editar producto <?= $product["name"] ?></h1>
<a href="/product">Todos los productos</a>
<div class="card">
  <div class="card-body">
    <h2 class="card-title">Datos del producto</h2>
	<form method="post" action="/product/update/<?= $product["id"] ?>">
	  <div class="form-group">
	    <label for="exampleInputName">Nombre</label>
	    <input required type="text" class="form-control" name="name" id="exampleInputName" value="<?=$product["name"]?>" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputSKU">SKU</label>
	    <input required type="text" class="form-control" name="sku" id="exampleInputSKU" value="<?=$product["sku"]?>">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPrice">Precio</label>
	    <input required type="text" class="form-control" name="price" id="exampleInputPrice" value="<?=$product["price"]?>">
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
  </div>
</div>

