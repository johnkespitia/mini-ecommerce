<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Clientes <a href="/customer/new" class=" float-right btn btn-sm btn-primary">Nuevo Cliente</a></h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los clientes registrados </h6>
    <table class="table">
    <thead class="thead-light">
        <tr>
            <th class="text-center">#</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Ciudad</th>
            <th class="text-right">Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php
  	foreach ($customerList as $cust) {
  		?>
  		<tr>
	      <th class="text-center" scope="row"><?= $cust["id"] ?></th>
	      <td><?= $cust["name"] ?></td>
	      <td><?= $cust["email"] ?></td>
	      <td><?= $cust["phone"] ?></td>
	      <td><?= $cust["address"] ?></td>
	      <td><?php 
        foreach ($cityList as $cit) {
          if($cit["id"] == $cust["city_id"]){
            echo $cit["name"];
          }
        }	
	      ?></td>
	      <td class="td-actions text-right">
        <a class="btn btn-warning btn-sm" href="/customer/edit/<?=$cust["id"]?>"><i class="fas fa-pencil-alt"></i> Editar</a>
        <a class="btn btn-info btn-sm" href="/contact/customer/<?=$cust["id"]?>"><i class="fas fa-calendar-alt"></i> Ver eventos</a>
        <a class="btn btn-danger btn-sm" href="/customer/delete/<?=$cust["id"]?>"><i class="fas fa-trash"></i> Eliminar</a>
	      </td>
	    </tr>
  		<?php
  	}
    ?>
    </tbody>
</table>
  </div>
</div>