<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Emails de notificación
      <?php if (!empty($_SESSION["permissions"]["Emails Notificacione"]["Crear"]) && $_SESSION["permissions"]["Emails Notificacione"]["Crear"] == 1) { ?>
        <a href="/notificationemail/new" class=" float-right btn btn-sm btn-primary mr-2">Nuevo Email de notificación</a>
      <?php } ?>
    </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los registros</h6>
    <table class="table table-responsive">
      <thead class="thead-light">
        <tr>
          <th class="text-center">#</th>
          <th>Email</th>
          <th>Tipo de notificación</th>
          <th class="text-right">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($emails as $cust) {
        ?>
          <tr>
            <th class="text-center" scope="row"><?= $cust["id"] ?></th>
            <td><?= $cust["email"] ?></td>
            <td><?= $cust["notification_type"] ?></td>
            <td class="td-actions text-right">
              <?php if (!empty($_SESSION["permissions"]["Emails Notificacione"]["Editar"]) && $_SESSION["permissions"]["Emails Notificacione"]["Editar"] == 1) { ?>
                <a class="btn btn-warning btn-sm" href="/notificationemail/edit/<?= $cust["id"] ?>"><i class="fas fa-pencil-alt"></i> Editar</a>
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