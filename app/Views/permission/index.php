<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Roles <span  class="badge badge-primary"><?= $rol["name"] ?></span> <a href="/permission/new/<?= $rol["id"] ?>" class=" float-right btn btn-sm btn-primary mr-2">Nuevo Permiso</a> </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los roles registrados</h6>
    <table class="table table-responsive">
    <thead class="thead-light">
        <tr>
            <th class="text-center">#</th>
            <th>Módulo</th>
            <th>Permiso</th>
            <th>Estado</th>
            <th class="text-right">Acciones</th>
        </tr>
    </thead>
    <tbody>
      <?php
      foreach ($permissionList as $cust) {
        ?>
        <tr>
          <th class="text-center" scope="row"><?= $cust["id"] ?></th>
          <td><?= $cust["module"] ?></td>
          <td><?= $cust["permission"] ?></td>
          <td><?= $cust["status"]==1?"<span class='badge bg-success text-dark'>Activo</span>":"<span class='badge bg-danger text-dark'>Inactivo</span>" ?></td>
          <td class="td-actions text-right">
            <a class="btn btn-warning btn-sm" href="/permission/edit/<?=$cust["id"]?>"><i class="fas fa-pencil-alt"></i> Editar</a>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
</table>
  </div>
</div>