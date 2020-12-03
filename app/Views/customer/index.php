<h1>Listado de Clientes</h1>
<a href="/customer/new">Nuevo cliente</a>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">Teléfono</th>
      <th scope="col">Dirección</th>
      <th scope="col">Ciudad</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
  	<?php
  	foreach ($customerList as $cust) {
  		?>
  		<tr>
	      <th scope="row"><?= $cust["id"] ?></th>
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
	      <td>
	      	<a href="/customer/edit/<?=$cust["id"]?>">Editar</a>
	      	<a href="/customer/delete/<?=$cust["id"]?>">Eliminar</a>
	      </td>
	    </tr>
  		<?php
  	}
    ?>
  </tbody>
</table>