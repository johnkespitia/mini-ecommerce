<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Notificaciones para el vehículo <span class="badge badge-primary"><?= $car["dni"] ?></span>
      <?php
      if (!empty($_SESSION["permissions"]["Vehículos"]["Crear"]) && $_SESSION["permissions"]["Vehículos"]["Editar"] == 1) { ?>
        <a href="/car/createnotification/<?= $car["id"] ?>" class=" float-right btn btn-sm btn-success">Nueva Notificación</a>
      <?php } ?>
        <a href="/car/details/<?= $car["id"] ?>" class=" float-right btn btn-sm btn-warning mr-2">Detalles del vehículo</a>
    </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todas las Notificaciones</h6>
    <table class="table table-responsive">
      <thead class="thead-light">
        <tr>
          <th class="text-center">#</th>
          <th>Notificación</th>
          <th>Tipo</th>
          <th>Valor de Notificación</th>
          <th>Alerta</th>
          <th class="text-right">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($notifications as $cust) {
        ?>
          <tr>
            <th class="text-center" scope="row"><?= $cust["id"] ?></th>
            <td><?= $cust["not_type"] ?></td>
            <td><?= $cust["value_type"] ?></td>
            <td><?= $cust["value_compare"] ?></td>
            <td><?= $cust["avg_reminder"] ?></td>
            <td class="td-actions text-right">
              <a class="btn btn-danger btn-sm" href="/car/deletenotification/<?= $cust["id"] ?>"><i class="fas fa-trash"></i> Eliminar</a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>