<div class="card">
  <div class="card-body">
    <h4 class="card-title">Registro masivo de Clientes <a href="/customer/index" class=" float-right btn btn-sm btn-primary">Listado de Clientes</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Registrar Clientes desde excel</h6>
	<hr>
	<form method="post" action="/customer/storexls"  enctype="multipart/form-data">
	<div class="form-group">
	    <label for="load-file">Archivo</label>
	    <input type="file" class="form-control" name="load_file" id="load-file" accept=".xlsx"/>
	  </div>
	  <button type="submit" class="btn btn-primary">Guardar</button>
	  <a href="<?=$_ENV["SITE_URL"]?>/files/customers/sample-customers.xlsx" target="_blank" class="btn text-white btn-info">Descargar Template</a>
	</form>
	</div>
	<?php
	if(!empty($successMessage)){
		foreach ($successMessage as $line => $msg) { ?>
			<div class="alert alert-success" role="alert">
				<strong>Linea <?= $line ?></strong> <?= $msg ?>
			</div>
		<?php
		}
	}
	
	if(!empty($errorMessage)){
		foreach ($errorMessage as $line => $msg) { ?>
			<div class="alert alert-danger" role="alert">
				<strong>Linea <?= $line ?></strong> <?= $msg ?>
			</div>
		<?php
		}
	}
	?>
</div>