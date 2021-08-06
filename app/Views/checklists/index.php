<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Checklists
      <?php if (!empty($_SESSION["permissions"]["Checklist Vehículos"]["Crear"]) && $_SESSION["permissions"]["Checklist Vehículos"]["Crear"] == 1) { ?>
        <a href="/checklist/new" class=" float-right btn btn-sm btn-primary mr-2">Nuevo checklist</a>
      <?php } ?>
    </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todas las checklists</h6>
    <table class="table table-responsive">
      <thead class="thead-light">
        <tr>
          <th class="text-center">#</th>
          <th>Título</th>
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
            <td><?= $cust["name"] ?></td>
            <td class="td-actions text-right">
            <?php if (!empty($_SESSION["permissions"]["Checklist Vehículos"]["Editar"]) && $_SESSION["permissions"]["Checklist Vehículos"]["Editar"] == 1) { ?>
              <a class="btn btn-warning btn-sm" href="/checklist/edit/<?= $cust["id"] ?>"><i class="fas fa-pencil-alt"></i> Editar</a>
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