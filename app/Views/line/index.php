<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Línea de Vehículo
      <?php if (!empty($_SESSION["permissions"]["Línea"]["Crear"]) && $_SESSION["permissions"]["Línea"]["Crear"] == 1) { ?>
        <a href="/line/new" class=" float-right btn btn-sm btn-primary mr-2">Nueva Línea de Vehículo</a>
      <?php } ?>
    </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todas las Línea de Vehículo registradas</h6>
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
              <?php if (!empty($_SESSION["permissions"]["Línea"]["Editar"]) && $_SESSION["permissions"]["Línea"]["Editar"] == 1) { ?>
                <a class="btn btn-warning btn-sm" href="/line/edit/<?= $cust["id"] ?>"><i class="fas fa-pencil-alt"></i> Editar</a>
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