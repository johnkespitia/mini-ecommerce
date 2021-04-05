<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Tipos de notificaciones
      <?php if (!empty($_SESSION["permissions"]["Tipo Notificación"]["Crear"]) && $_SESSION["permissions"]["Tipo Notificación"]["Crear"] == 1) { ?>
        <a href="/carnotificationtype/new" class=" float-right btn btn-sm btn-primary mr-2">Nuevo Tipo de notificaicón</a>
      <?php } ?>
    </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los Tipos de Notificaciones registrados</h6>
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
              <?php if (!empty($_SESSION["permissions"]["Tipo Notificación"]["Editar"]) && $_SESSION["permissions"]["Tipo Notificación"]["Editar"] == 1) { ?>
                <a class="btn btn-warning btn-sm" href="/carnotificationtype/edit/<?= $cust["id"] ?>"><i class="fas fa-pencil-alt"></i> Editar</a>
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