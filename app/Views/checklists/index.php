<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de secciones de Checklists <?= $typelist["name"] ?> 
      <?php if (!empty($_SESSION["permissions"]["Checklist Vehículos"]["Crear"]) && $_SESSION["permissions"]["Checklist Vehículos"]["Crear"] == 1) { ?>
        <a href="/checklist/new/<?= $typelist["id"] ?>" class=" float-right btn btn-sm btn-primary mr-2">Nuevo checklist</a>
      <?php } ?>
    </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todas las checklists</h6>
    <table class="table table-responsive">
      <thead class="thead-light">
        <tr>
          <th class="text-center">#</th>
          <th>Título</th>
          <th>Momento de Operación</th>
          <th>Obligatorio</th>
          <th>Depende de</th>
          <th>Versión</th>
          <th>Estado</th>
          <th class="text-right">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($checksLists as $cust) {
        ?>
          <tr>
            <th class="text-center" scope="row"><?= $cust["id"] ?></th>
            <td><?= $cust["title"] ?></td>
            <td><?= $cust["checklist_type_name"] ?></td>
            <td><?= ($cust["required"]==1)?"Obligatorio":"Opcional" ?></td>
            <td><?= $cust["id_parent"] ?> - <?= $cust["title_parent"] ?></td>
            <td><?= $cust["version"] ?></td>
            <td><?= ($cust["status"]==1)?"Activa":"Inactiva" ?></td>
            <td class="td-actions text-right">
            <?php if (!empty($_SESSION["permissions"]["Checklist Vehículos"]["Editar"]) && $_SESSION["permissions"]["Checklist Vehículos"]["Editar"] == 1) { ?>
              <a class="btn btn-warning btn-sm" href="/checklist/edit/<?= $cust["id"] ?>"><i class="fas fa-pencil-alt"></i> Editar</a>
              <?php } ?>
              <a class="btn btn-success btn-sm" href="/checklist/detail/<?= $cust["id"] ?>"><i class="fas fa-eye"></i> Detalle</a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>