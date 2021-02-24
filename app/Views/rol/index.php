<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Roles
      <?php if (!empty($_SESSION["permissions"]["Roles"]["Crear"]) && $_SESSION["permissions"]["Roles"]["Crear"] == 1) { ?>
        <a href="/rol/new" class=" float-right btn btn-sm btn-primary mr-2">Nuevo Rol</a>
      <?php } ?>
    </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los roles registrados</h6>
    <table class="table table-responsive">
      <thead class="thead-light">
        <tr>
          <th class="text-center">#</th>
          <th>Nombre</th>
          <th class="text-right">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($rolList as $cust) {
        ?>
          <tr>
            <th class="text-center" scope="row"><?= $cust["id"] ?></th>
            <td><?= $cust["name"] ?></td>
            <td class="td-actions text-right">
              <?php if (!empty($_SESSION["permissions"]["Roles"]["Editar"]) && $_SESSION["permissions"]["Roles"]["Editar"] == 1) { ?>
                <a class="btn btn-warning btn-sm" href="/rol/edit/<?= $cust["id"] ?>"><i class="fas fa-pencil-alt"></i> Editar</a>
                <a class="btn btn-info btn-sm" href="/permission/index/<?= $cust["id"] ?>"><i class="fas fa-lock-open"></i> Permisos</a>
              <?php } ?>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>