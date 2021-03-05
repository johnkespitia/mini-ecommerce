<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de vehiculos
      <?php
      if (!empty($_SESSION["permissions"]["Vehículos"]["Crear"]) && $_SESSION["permissions"]["Vehículos"]["Crear"] == 1) { ?>
        <a href="/car/loadfile" class=" float-right btn btn-sm btn-secondary">Creación masiva de Vehículos</a>
        <a href="/car/new" class=" float-right btn btn-sm btn-primary mr-2">Nuevo Vehículo</a>
      <?php } ?>
      <?php
      if (!empty($_SESSION["permissions"]["Vehículos"]["Crear"]) && $_SESSION["permissions"]["Vehículos"]["Listar"] == 1) { ?>
        <a href="/car/exportxls" class=" float-right btn btn-sm btn-warning mr-2">Exportar todos los Vehículos</a>
      <?php } ?>
    </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los vehículos registrados</h6>
    <table class="table table-responsive">
      <thead class="thead-light">
        <tr>
          <th class="text-center">#</th>
          <th>Placa</th>
          <th>Modelo</th>
          <th>Tipo de Vehículo</th>
          <th>Marca</th>
          <th>Combustible</th>
          <th>Linea</th>
          <th>Tipo de Servicio</th>
          <th>Estado</th>
          <th class="text-right">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($carList as $cust) {
        ?>
          <tr>
            <th class="text-center" scope="row"><?= $cust["id"] ?></th>
            <td><?= $cust["dni"] ?></td>
            <td><?= $cust["modelo"] ?></td>
            <td><?= $cust["type_car"] ?></td>
            <td><?= $cust["brand_name"] ?></td>
            <td><?= $cust["fuel_type"] ?></td>
            <td><?= $cust["line_category_name"] ?></td>
            <td><?= $cust["service_type_name"] ?></td>
            <td><?= $cust["status"] == 1 ? "<span class='badge bg-success text-dark'>Activo</span>" : "<span class='badge bg-danger text-dark'>Inactivo</span>" ?></td>
            <td class="td-actions text-right">
              <?php
              if (!empty($_SESSION["permissions"]["Vehículos"]["Crear"]) && $_SESSION["permissions"]["Vehículos"]["Editar"] == 1) { ?>
                <a class="btn btn-warning btn-sm" href="/car/edit/<?= $cust["id"] ?>"><i class="fas fa-pencil-alt"></i> Editar</a>
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