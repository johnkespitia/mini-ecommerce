<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Eventos del pedido  <span  class="badge badge-primary"><?= $order["id"] ?></span><a href="/order/index" class=" float-right btn btn-sm btn-primary">Listado de Pedidos</a></h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los eventos registrados para el pedido </h6>
    <table class="table">
    <thead class="thead-light">
        <tr>
            <th class="text-center">#</th>
            <th>Titulo</th>
            <th>Descripción</th>
            <th>Fecha Hora Inicio</th>
            <th>Fecha Hora Fin</th>
            <th>Asesor</th>
            <th>Tipo</th>
            <th>Cliente</th>
            <th class="text-right">Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php
  	foreach ($contactList as $cust) {
  		?>
  		<tr>
	      <th class="text-center" scope="row"><?= $cust["id"] ?></th>
	      <td><?= $cust["title"] ?></td>
	      <td><?= $cust["description"] ?></td>
	      <td><?= $cust["datetime_start"] ?></td>
	      <td><?= $cust["datetime_end"] ?></td>
        <td><?= $cust["user"] ?></td>
        <td><?= $cust["type"] ?></td>
        <td><?= $cust["customer"] ?></td>
	      <td class="td-actions text-right">
        <a class="btn btn-warning btn-sm" href="/contact/edit/<?=$cust["id"]?>"><i class="fas fa-pencil-alt"></i> Edit</a>
        <!-- <a class="btn btn-info btn-sm" href="/contact/results/<?=$cust["id"]?>"><i class="fas fa-calendar-alt"></i> Seguimientos</a> -->
	      </td>
	    </tr>
  		<?php
  	}
    ?>
    </tbody>
</table>
  </div>
</div>