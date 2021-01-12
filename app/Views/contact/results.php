<div class="card">
  <div class="card-body">
    <h4 class="card-title">Seguimiento de evento <span class="badge badge-info"><?= $contact["id"] ?> - <?= $contact["method"] ?> <?= $contact["title"] ?></span> <a href="/contact/newresult/<?= $contact["id"] ?>" class=" float-right btn btn-sm btn-primary">Nuevo Seguimiento</a></h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos seguimientos del evento de contacto con el cliente </h6>
    <table class="table">
    <thead class="thead-light">
        <tr>
            <th class="text-center">#</th>
            <th>Título</th>
            <th>Asesor</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Descripción</th>
            <th>Resultado</th>
            <th>Siguiente paso</th>
            <th class="text-right">Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php
  	foreach ($resultsList as $cust) {
  		?>
  		<tr>
	      <th class="text-center" scope="row"><?= $cust["id"] ?></th>
	      <td><?= $cust["title"] ?></td>
	      <td><?= $cust["user"] ?></td>
	      <td><?= $cust["date_result"] ?></td>
	      <td><?= $cust["status"] ?></td>
	      <td><?= $cust["description"] ?></td>
	      <td><?= $cust["result"] ?></td>
	      <td><?= $cust["next_step"] ?></td>
	      <td class="td-actions text-right">
          <a class="btn btn-warning btn-sm" href="/contact/editresult/<?=$cust["id"]?>"><i class="fas fa-pencil-alt"></i> Editar</a>
	      </td>
	    </tr>
  		<?php
  	}
    ?>
    </tbody>
</table>
  </div>
</div>