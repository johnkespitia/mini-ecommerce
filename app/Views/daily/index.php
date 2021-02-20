<div class="card">
  <div class="card-body">
    <h4 class="card-title">Reporte Diario  <span  class="badge badge-primary">Planilla # <?= $group["id"] ?> Fecha <?= $group["date_report"] ?> </span>
    <a href="/daily/exportxls/<?= $group["id"] ?>" class=" float-right btn btn-sm btn-warning mr-2">Exportar listado</a> <a href="/daily/loadfile/<?= $group["id"] ?>" class=" float-right btn btn-sm btn-success mr-2">Reportar por excel</a> <a href="/daily/new/<?= $group["id"] ?>" class=" float-right btn btn-sm btn-primary mr-2">Reportar día</a> 
    <a href="/report/index" class=" float-right btn btn-sm btn-info mr-2">Listado de Planillas</a> </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los reportes diarios registrados </h6>
    <table class="table table-responsive">
      <thead class="thead-light">
        <tr>
          <th class="text-center">#</th>
          <th>Fecha</th>
          <th>Cliente</th>
          <th>Empleado</th>
          <th>Vehículo</th>
          <th>Origen</th>
          <th>Destino</th>
          <th class="text-right">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($dailyList as $cust) {
        ?>
          <tr>
            <th class="text-center" scope="row"><?= $cust["id"] ?></th>
            <td><?= $cust["date_report"] ?></td>
            <td><?= $cust["client_name"] ?></td>
            <td><?= $cust["employe_name"] ?></td>
            <td><?= $cust["car_dni"] ?></td>
            <td><?= $cust["origin_name"] ?></td>
            <td><?= $cust["destination_name"] ?></td>
            <td class="td-actions text-right">
              <a class="btn btn-warning btn-sm" href="/daily/edit/<?= $cust["id"] ?>"><i class="fas fa-pencil-alt"></i> Editar</a>
              <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#productsModal<?= $cust["id"] ?>"><i class="fas fa-eye"></i> Ver detalles</button>
              <!-- Modal -->
              <div class="modal fade" id="productsModal<?= $cust["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="productsModal<?= $cust["id"] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Detalle de Reporte Diario Planilla #<?=$group["id"]?></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <h3 class="text-left">Fecha de reporte: <span class="badge badge-info"><?= $cust["date_report"] ?></span></h3>
                      <ul style="text-align: left;">
                        <li><strong>Tipo de Servicio</strong> <?= $cust["service_type"] ?></li>
                        <li><strong>Área</strong> <?= $cust["area"] ?></li>
                        <li><strong>Origen</strong> <?= $cust["origin_name"] ?></li>
                        <li><strong>Destino</strong> <?= $cust["destination_name"] ?></li>
                        <li><strong>Hora de Inicio AM</strong> <?= $cust["time_start_am"] ?></li>
                        <li><strong>Hora de Final AM</strong> <?= $cust["time_end_am"] ?></li>
                        <li><strong>Tiempo de Almuerzo</strong> <?= $cust["lunch_time"] ?></li>
                        <li><strong>Hora de Inicio PM</strong> <?= $cust["time_start_pm"] ?></li>
                        <li><strong>Hora de Final PM</strong> <?= $cust["time_end_pm"] ?></li>
                        <li><strong>Horas Trabajadas</strong> <?= $cust["worked_hours"] ?></li>
                        <li><strong>Horas de disponibilidad</strong> <?= $cust["abble_hours"] ?></li>
                        <li><strong>Kilometros Inicio</strong> <?= $cust["km_start"] ?></li>
                        <li><strong>Kilometros final</strong> <?= $cust["km_end"] ?></li>
                        <li><strong>Total Kilometros</strong> <?= $cust["km_end"] - $cust["km_start"] ?></li>
                        <li><strong>Cantidad de personas</strong> <?= $cust["people"] ?></li>
                      </ul>
                      <div class="accordion" id="accordionExample">
                        <div class="card">
                          <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Cliente
                              </button>
                            </h2>
                          </div>

                          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample" style="text-align:left">
                            <div class="card-body">
                              <ul>
                                <li><strong>Nombre</strong> <?= $cust["client_name"] ?></li>
                                <li><strong>NIT/DNI</strong> <?= $cust["client_dni"] ?></li>
                                <li><strong>Teléfono</strong> <?= $cust["client_phone"] ?></li>
                                <li><strong>Dirección</strong> <?= $cust["client_address"] ?></li>
                                <li><strong>Ciudad</strong> <?= $cust["client_city"] ?></li>
                                <li><strong>Email</strong> <?= $cust["client_email"] ?></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Vehículo
                              </button>
                            </h2>
                          </div>
                          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample" style="text-align:left">
                            <div class="card-body">
                              <ul>
                                <li><strong>Tipo de Vehículo</strong> <?= $cust["type_car"] ?></li>
                                <li><strong>Placa</strong> <?= $cust["car_dni"] ?></li>
                                <li><strong>Modelo</strong> <?= $cust["modelo"] ?></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Trabajador
                              </button>
                            </h2>
                          </div>
                          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample" style="text-align:left">
                            <div class="card-body">
                              <ul>
                                <li><strong>Nombre</strong> <?= $cust["employe_name"] ?></li>
                                <li><strong>NIT/DNI</strong> <?= $cust["employe_dni"] ?></li>
                                <li><strong>Email</strong> <?= $cust["employe_email"] ?></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>