<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Marca de Vehículo
      <?php if (!empty($_SESSION["permissions"]["Marca"]["Crear"]) && $_SESSION["permissions"]["Marca"]["Crear"] == 1) { ?>
        <a href="/brand/new" class=" float-right btn btn-sm btn-primary mr-2">Nueva Marca de Vehículo</a>
      <?php } ?>
    </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todas las Marcas de Vehículo registradas</h6>
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
              <?php if (!empty($_SESSION["permissions"]["Marca"]["Editar"]) && $_SESSION["permissions"]["Marca"]["Editar"] == 1) { ?>
                <a class="btn btn-warning btn-sm" href="/brand/edit/<?= $cust["id"] ?>"><i class="fas fa-pencil-alt"></i> Editar</a>
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