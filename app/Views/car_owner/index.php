<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Propietarios
      <?php if (!empty($_SESSION["permissions"]["Propietarios"]["Crear"]) && $_SESSION["permissions"]["Propietarios"]["Crear"] == 1) { ?>
        <a href="/owner/new" class=" float-right btn btn-sm btn-primary mr-2">Nuevo Propietario</a>
      <?php } ?>
    </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los propietarios</h6>
    <table class="table table-responsive">
      <thead class="thead-light">
        <tr>
          <th class="text-center">#</th>
          <th>Identificación</th>
          <th>Nombre</th>
          <th>Email</th>
          <th class="text-right">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($cityList as $cust) {
        ?>
          <tr>
            <th class="text-center" scope="row"><?= $cust["id"] ?></th>
            <td><?= $cust["dni"] ?></td>
            <td><?= $cust["name"] ?></td>
            <td><?= $cust["email"] ?></td>
            <td class="td-actions text-right">
            <?php if (!empty($_SESSION["permissions"]["Propietarios"]["Editar"]) && $_SESSION["permissions"]["Propietarios"]["Editar"] == 1) { ?>
              <a class="btn btn-warning btn-sm" href="/owner/edit/<?= $cust["id"] ?>"><i class="fas fa-pencil-alt"></i> Editar</a>
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