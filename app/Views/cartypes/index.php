<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de tipos de vehiculos <a href="/cartype/new" class=" float-right btn btn-sm btn-primary">Nuevo Tipo de Vehículo</a></h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los tipos de vehículos registrados</h6>
    <table class="table">
    <thead class="thead-light">
        <tr>
            <th class="text-center">#</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th class="text-right">Acciones</th>
        </tr>
    </thead>
    <tbody>
      <?php
      foreach ($carTypeList as $cust) {
        ?>
        <tr>
          <th class="text-center" scope="row"><?= $cust["id"] ?></th>
          <td><?= $cust["name"] ?></td>
          <td><?= $cust["status"]==1?"<span class='badge bg-success text-dark'>Activo</span>":"<span class='badge bg-danger text-dark'>Inactivo</span>" ?></td>
          <td class="td-actions text-right">
            <a class="btn btn-warning btn-sm" href="/cartype/edit/<?=$cust["id"]?>"><i class="fas fa-pencil-alt"></i> Editar</a>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
</table>
  </div>
</div>