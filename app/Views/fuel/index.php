<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Cargues de combustible
      <?php if (!empty($_SESSION["permissions"]["Combustible"]["Crear"]) && $_SESSION["permissions"]["Combustible"]["Crear"] == 1) { ?>
        <a href="/fuel/loadfile" class=" float-right btn btn-sm btn-secondary mr-2">Creación masiva</a>
      <?php } ?>
    </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los registros </h6>
    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
      Filtrar
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
            <label for="exampleInputCity">Vehículo</label>
            <select class="form-control" name="car" id="exampleInputCity">
              <option value=""></option>
              <?php foreach ($CarList as $c) {
                echo "<option value='{$c["id"]}'>{$c["dni"]}</option>";
              } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="text-success"><i class="fas fa-file-excel"></i> Exportar Todo a Excel</label> <br />
            <label class="custom-toggle">
              <input type="checkbox" name="export-excel" value="export">
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
          <th>Vehiculo</th>
          <th>Fecha</th>
          <th>Proveedor</th>
          <th>Combustible</th>
          <th>Articulo</th>
          <th>Cantidad (Gl)</th>
          <th>Tiquete</th>
          <th>Vale</th>
          <th>Tanque lleno?</th>
          <th>Valor</th>
          <th>Observaciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($employeesList as $cust) {
        ?>
          <tr>
            <th class="text-center" scope="row"><?= $cust["id"] ?></th>
            <td><?= $cust["dni"] ?></td>
            <td><?= $cust["date_fuel"] ?></td>
            <td><?= $cust["provider"] ?></td>
            <td><?= $cust["fuel_type_name"] ?></td>
            <td><?= $cust["article_code"] ?></td>
            <td><?= $cust["quantity"] ?></td>
            <td><a href="<?= $cust["image"] ?>" target="_blank"><?= $cust["ticket"] ?></a></td>
            <td><?= $cust["vale"] ?></td>
            <td><?= $cust["full"] == 1 ? "<span class='badge bg-success text-dark'>Lleno</span>" : "<span class='badge bg-danger text-dark'>No</span>" ?></td>
            <td>$ <?= number_format($cust["value"], 0, ",",'.') ?></td>
            <td><?= $cust["observations"] ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>