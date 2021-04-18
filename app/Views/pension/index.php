<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Pensions
      <?php if (!empty($_SESSION["permissions"]["Pension"]["Crear"]) && $_SESSION["permissions"]["Pension"]["Crear"] == 1) { ?>
        <a href="/pension/new" class=" float-right btn btn-sm btn-primary mr-2">Nuevo Pension</a>
      <?php } ?>
    </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los Pensions</h6>
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
        foreach ($cityList as $cust) {
        ?>
          <tr>
            <th class="text-center" scope="row"><?= $cust["id"] ?></th>
            <td><?= $cust["name"] ?></td>
            <td class="td-actions text-right">
            <?php if (!empty($_SESSION["permissions"]["Pension"]["Editar"]) && $_SESSION["permissions"]["Pension"]["Editar"] == 1) { ?>
              <a class="btn btn-warning btn-sm" href="/pension/edit/<?= $cust["id"] ?>"><i class="fas fa-pencil-alt"></i> Editar</a>
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