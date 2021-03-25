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
    <form method="get" action=""  class="form-inline">
      <label for="dniInputName">Filtrar por Placa</label>
      <input type="text" class="form-control mr-2 ml-2 " name="dni"/>
      <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>
    <hr>
    <table class="table table-responsive">
      <thead class="thead-light">
        <tr>
          <th class="text-center">#</th>
          <th>Foto</th>
          <th>Placa</th>
          <th>Tipo de Vehículo</th>
          <th>Marca</th>
          <th>Combustible</th>
          <th>Tipo de Servicio</th>
          <th>Estado</th>
          <th class="text-right">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($carList as $cust) {
        ?>
          <script>
            $.getJSON("/car/carimages/<?= $cust["id"] ?>", function(data, status, xhr) {
              if (data.imagesList.length > 0) {
                $("#img_car_<?= $cust["id"] ?>").attr("src", data.imagesList[0].url)
              }
            })
          </script>
          <tr>
            <th class="text-center" scope="row"><?= $cust["id"] ?></th>
            <td><img src="/themes/argon/assets/img/theme/loading.gif" width="100px" class="img-thumbnail" id="img_car_<?= $cust["id"] ?>" /></td>
            <td><?= $cust["dni"] ?></td>
            <td><?= $cust["type_car"] ?></td>
            <td><?= $cust["brand_name"] ?></td>
            <td><?= $cust["fuel_type"] ?></td>
            <td><?= $cust["service_type_name"] ?></td>
            <td><?= $cust["status"] == 1 ? "<span class='badge bg-success text-dark'>Activo</span>" : "<span class='badge bg-danger text-dark'>Inactivo</span>" ?></td>
            <td class="td-actions text-right">
              <a class="btn btn-success btn-sm" href="/car/details/<?= $cust["id"] ?>"><i class="fas fa-eye"></i> Detalle</a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>