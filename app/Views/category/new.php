<div class="card">
  <div class="card-body">
    <h4 class="card-title">Nueva Categoría <a href="/product/categories" class=" float-right btn btn-sm btn-primary">Listado de Categorias</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar nueva categoría </h6>
	<hr>
	<form method="post" action="/product/storecategory">
	  <div class="form-group">
	    <label for="exampleInputName">Nombre</label>
	    <input required type="text" class="form-control" name="name" id="exampleInputName" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputMethod">Categoría padre</label>
	    <select class="form-control" name="parent_category" id="exampleInputMethod" >
			<option value=''> Categoría Padre</option>
	    	<?php foreach($categories as $cat){ ?>
				<option value='<?= $cat["id"]?>'> <?= $cat["name"] ?></option>
			<?php } ?>
	    </select>
	  </div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>
