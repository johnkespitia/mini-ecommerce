<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Planillas <a href="/report/new" class=" float-right btn btn-sm btn-primary mr-2">Nueva Planilla</a>  </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los Planillas registrados </h6>
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
            <a class="btn btn-info btn-sm" href="/report/edit/<?=$cust["id"]?>"><i class="fas fa-pencil-alt"></i> Editar Planilla</a>
            <a class="btn btn-warning btn-sm" href="/daily/index/<?=$cust["id"]?>"><i class="fas fa-eye"></i> Ver Registros</a>
            <a class="btn btn-primary btn-sm" href="/daily/exportxls/<?=$cust["id"]?>"><i class="fas fa-file-excel"></i> Exportar Excel</a>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
</table>
  </div>
</div>