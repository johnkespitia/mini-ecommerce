<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Planillas
      <?php if (!empty($_SESSION["permissions"]["Planillas"]["Crear"]) && $_SESSION["permissions"]["Planillas"]["Crear"] == 1) { ?>
        <a href="/report/new" class=" float-right btn btn-sm btn-primary mr-2">Nueva Planilla</a>
      <?php } ?>
    </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los Planillas registrados </h6>
    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
      Filtrar Planillas
    </button>
    <div class="collapse" id="collapseExample">
      <div class="card card-body">
        <form method="POST">
          <div class="form-group">
            <label for="exampleInputName">Desde</label>
            <input type="date" class="form-control" name="date_report_min" id="exampleInputName">
          </div>
          <div class="form-group">
            <label for="exampleInputName">Hasta</label>
            <input type="date" class="form-control" name="date_report_max" id="exampleInputName">
          </div>
          <div class="form-group">
            <label for="exampleInputCity">Cliente</label>
            <select class="form-control" name="customer" id="exampleInputCity">
              <option value=""></option>
              <?php foreach ($customerList as $c) {
                echo "<option value='{$c["id"]}'>{$c["name"]}</option>";
              } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputCity">Vehículo</label>
            <select class="form-control" name="car" id="exampleInputCity">
              <option value=""></option>
              <?php foreach ($carList as $c) {
                echo "<option value='{$c["id"]}'>{$c["dni"]}</option>";
              } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="text-success"><i class="fas fa-file-excel"></i> Exportar Todo a Excel</label> <br/>
            <label class="custom-toggle">
              <input type="checkbox" name="export-excel" value="export" >
              <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Sí"></span>
            </label>
          </div>
          <button type="submit" class="btn btn-primary">Filtrar</button>

        </form>
      </div>
    </div>
    <table class="table table-responsive">
      <thead class="thead-light">
        <tr>
          <th class="text-center">#</th>
          <th>Fecha de Planilla</th>
          <th>Tipo de Servicio</th>
          <th>Area</th>
          <th>Cliente</th>
          <th>Vehículo</th>
          <th>Registros diarios</th>
          <th class="text-right">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($reportList as $cust) {
        ?>
          <tr>
            <th class="text-center" scope="row"><?= $cust["id"] ?></th>
            <td><?= $cust["date_report"] ?></td>
            <td><?= $cust["service_type"] ?></td>
            <td><?= $cust["area"] ?></td>
            <td><?= $cust["client_name"] ?></td>
            <td><?= $cust["car_dni"] ?></td>
            <td><?= $cust["rows_report"] ?></td>
            <td class="td-actions text-right">
              <?php if (!empty($_SESSION["permissions"]["Planillas"]["Editar"]) && $_SESSION["permissions"]["Planillas"]["Editar"] == 1) { ?>
                <a class="btn btn-info btn-sm" href="/report/edit/<?= $cust["id"] ?>"><i class="fas fa-pencil-alt"></i> Editar Planilla</a>
              <?php } ?>
              <a class="btn btn-warning btn-sm" href="/daily/index/<?= $cust["id"] ?>"><i class="fas fa-eye"></i> Ver Registros</a>
              <a class="btn btn-primary btn-sm" href="/daily/exportxls/<?= $cust["id"] ?>"><i class="fas fa-file-excel"></i> Exportar Excel</a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>