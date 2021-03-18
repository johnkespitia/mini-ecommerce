<!-- Header -->
<!-- Header -->
<div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(<?= $images[0]["url"] ?>); background-size: cover; background-position: center top;">
  <!-- Mask -->
  <span class="mask bg-gradient-default opacity-8"></span>
  <!-- Header container -->
  <div class="container-fluid d-flex align-items-center">
    <div class="row">
      <div class="col-lg-7 col-md-10">
        <h1 class="display-2 text-white"><?= $car["dni"] ?></h1>
        <p class="text-white mt-0 mb-5"><?= $car["brand_name"] ?></p>
        <?php if (!empty($_SESSION["permissions"]["Vehículos"]["Editar"]) && $_SESSION["permissions"]["Vehículos"]["Editar"] == 1) { ?>
          <a href="/car/edit/<?= $car["id"] ?>" class="btn btn-neutral">Editar Vehículo</a>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-xl-4 order-xl-2">
      <div class="card card-profile">
        <img src="/themes/argon/assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
        <div class="row justify-content-center">
          <div class="col-lg-3 order-lg-2">
            <div class="card-profile-image">
              <a href="#">
                <img src="<?= $images[0]["url"] ?>" class="rounded-circle">
              </a>
            </div>
          </div>
        </div>
        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
        </div>
        <div class="card-body pt-0">
          <div class="row">
            <div class="col">
              <div class="card-profile-stats d-flex justify-content-center">
                <div>
                  <span class="heading"><?= $car["brand_name"] ?></span>
                  <span class="description">Marca</span>
                </div>
                <div>
                  <span class="heading"><?= $car["fuel_type"] ?></span>
                  <span class="description">Combustible</span>
                </div>
                <div>
                  <span class="heading"><?= $car["type_car"] ?></span>
                  <span class="description">Tipo de Vehículo</span>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center">
            <h5 class="h3">
              <?= $car["dni"] ?><span class="font-weight-light">, <?= $car["modelo"] ?></span>
            </h5>
            <div class="h5 font-weight-300">
              <i class="ni location_pin mr-2"></i><?= $car["line_category_name"] ?>
            </div>
            <div class="h5 mt-4">
              <i class="ni business_briefcase-24 mr-2"></i><?= $car["service_type_name"] ?>
            </div>
            <div>
              <i class="ni education_hat mr-2"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-8 order-xl-1">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Información del Vehículo </h3>
            </div>
            <div class="col-4 text-right">

            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
              <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-bell-55 mr-2"></i>Novedades</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-image mr-2"></i>Fotos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false"><i class="ni ni-collection mr-2"></i>Documentos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="fuel-tab" data-toggle="tab" href="#fuel" role="tab" aria-controls="fuel" aria-selected="false"><i class="fas fa-gas-pump mr-2"></i>Combustible</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="maintenance-tab" data-toggle="tab" href="#maintenance" role="tab" aria-controls="maintenance" aria-selected="false"><i class="fa fa-wrench mr-2"></i>Mantenimiento</a>
              </li>
            </ul>
          </div>
          <div class="card shadow">
            <div class="card-body">
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                  <p class="description">Proximamente</p>
                </div>
                <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                  <?php
                  $indicators = [];
                  $slides = [];
                  $active = true;
                  foreach ($images as $key => $value) {
                    $activecls = ($active) ? "active" : "";
                    $eliminar = (!empty($_SESSION["permissions"]["Vehículos"]["Editar"]) && $_SESSION["permissions"]["Vehículos"]["Editar"] == 1) ? "<a href='/car/deleteimage/{$value["id"]}/{$car["id"]}' class='btn btn-danger'>Eliminar Imagen</a>" : "";
                    $indicators[] = "<li data-target='#carouselImages' class='{$activecls}' data-slide-to='{$key}'></li>";
                    $slides[] = "<div class='carousel-item {$activecls}'>
                                  <img class='d-block w-100' src='{$value["url"]}' alt='{$car["dni"]}_{$key}'>
                                  <div class='carousel-caption d-none d-md-block'>
                                    {$eliminar}  
                                  </div>
                                </div>";
                    $active = false;
                  }
                  ?>
                  <div id="carouselImages" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <?= implode("", $indicators) ?>
                    </ol>
                    <div class="carousel-inner">
                      <?= implode("", $slides) ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselImages" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselImages" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                  <hr />
                  <h2>Añadir Foto</h2>
                  <form method="post" action="/car/storeimage/<?= $car["id"] ?>" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="load-file">Foto</label>
                      <input type="file" class="form-control" name="photo" id="load-file" accept=".jpg,.png,.gif,.jpeg" />
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </form>
                </div>
                <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                  <h2 class="title">Documentos del vehículo</h2>
                  <h3>Añadir Documento</h3>
                  <form method="post" action="/car/storefile/<?= $car["id"] ?>" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName">Tipo de Documento</label>
                      <select required class="form-control" name="document_type">
                        <?php
                        foreach ($documentTypeList as $ct) {
                          echo "<option value='{$ct["id"]}'>{$ct["name"]}</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName">Proveedor</label>
                      <input required type="text" class="form-control" name="provider" id="exampleInputName">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName">Código/Serial</label>
                      <input required type="text" class="form-control" name="code" id="exampleInputName">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName">Expiración</label>
                      <input required type="date" class="form-control" name="date_expiration" id="exampleInputName">
                    </div>
                    <div class="form-group">
                      <label for="load-file">Documento</label>
                      <input type="file" class="form-control" name="file" id="load-file" accept=".jpg,.png,.gif,.jpeg,.pdf" />
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </form>
                  <hr />
                  <table class="table table-responsive">
                    <thead class="thead-light">
                      <tr>
                        <th>#</th>
                        <th>Documento</th>
                        <th>Proveedor</th>
                        <th>Código</th>
                        <th>Estado</th>
                        <th>Registro</th>
                        <th>Vencimiento</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($documents as  $doc) { ?>
                        <tr>
                          <td><?= $doc["id"] ?></td>
                          <td><?= $doc["document_name"] ?></td>
                          <td><?= $doc["provider"] ?></td>
                          <td><?= $doc["code"] ?></td>
                          <td><?= (!empty($doc["date_expiration"]) && strtotime($doc["date_expiration"]) < time()) ? "<span class='text-danger'>Expirado</span>" : "<span class='text-success'>Vigente</span>"  ?></td>
                          <td><?= $doc["date_created"] ?></td>
                          <td><?= $doc["date_expiration"] ?></td>
                          <td>
                            <a href='<?= $doc["url"] ?>' class='btn btn-sm btn-success mb-2'>Descargar</a>
                            <?php
                            if (!empty($_SESSION["permissions"]["Vehículos"]["Editar"]) && $_SESSION["permissions"]["Vehículos"]["Editar"] == 1) { ?>
                              <br /><a href='/car/deletefile/<?= $doc["id"] ?>/<?= $car["id"] ?>' class='btn btn-sm btn-danger'>Eliminar</a>
                            <?php
                            }
                            ?>
                          </td>
                        </tr>
                      <?php  }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="fuel" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                  <h2 class="title">Cargues de combustible</h2>
                  <h3>Cargue manual de combustible</h3>
                  <form method="post" action="/car/storefuel/<?= $car["id"] ?>" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="date_fuelInputName">Fecha de cargue</label>
                      <input required type="date" class="form-control" name="date_fuel" id="date_fuelInputName">
                    </div>
                    <div class="form-group">
                      <label for="providerInputName">Proveedor</label>
                      <input required type="text" class="form-control" name="provider" id="providerInputName">
                    </div>
                    <div class="form-group">
                      <label for="quantityInputName">Cantidad (Galones)</label>
                      <input required type="text" class="form-control" name="quantity" id="quantityInputName">
                    </div>
                    <div class="form-group">
                      <label for="ticketInputName">Código/Serial Tiquete</label>
                      <input required type="text" class="form-control" name="ticket" id="ticketInputName">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName">Tanqueada Completa</label>
                      <br />
                      <label class="custom-toggle">
                        <input type="checkbox" name="full" value="export">
                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Sí"></span>
                      </label>
                    </div>
                    <div class="form-group">
                      <label for="load-file">Factura</label>
                      <input type="file" class="form-control" name="image" id="load-file" accept=".jpg,.png,.gif,.jpeg,.pdf" />
                    </div>
                    <div class="form-group">
                      <label for="observations">Observaciones</label>
                      <textarea class="form-control" name="observations" id="observations"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </form>
                  <hr />
                  <table class="table table-responsive">
                    <thead class="thead-light">
                      <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Código tiquete</th>
                        <th>Cantidad</th>
                        <th>Tanque lleno?</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($fuel as  $doc) { ?>
                        <tr>
                          <td><?= $doc["id"] ?></td>
                          <td><?= $doc["date_fuel"] ?></td>
                          <td><?= $doc["provider"] ?></td>
                          <td><?= $doc["ticket"] ?></td>
                          <td><?= round($doc["quantity"], 2) ?> Gal.</td>
                          <td><?= (!empty($doc["full"])) ? "<span class='text-success'>Si</span>" : "<span class='text-info'>No</span>"  ?></td>
                          <td><?= $doc["observations"] ?></td>
                          <td>
                            <a href='<?= $doc["image"] ?>' class='btn btn-sm btn-success mb-2'>Descargar</a>

                          </td>
                        </tr>
                      <?php  }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="maintenance" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                  <h2 class="title">Mantenimientos programados</h2>
                  <h3>Programar Mantenimiento</h3>
                  <form method="post" action="/car/storemaintaince/<?= $car["id"] ?>" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="subject_fuelInputName">Motivo de Mantenimiento</label>
                      <input required type="text" class="form-control" name="subject" id="subject_fuelInputName">
                    </div>
                    <div class="form-group">
                      <label for="date_fuelInputName">Fecha de Mantenimiento</label>
                      <input required type="date" class="form-control" name="date_maintaince" id="date_fuelInputName">
                    </div>
                    <div class="form-group">
                      <label for="providerInputName">Proveedor</label>
                      <input required type="text" class="form-control" name="provider" id="providerInputName">
                    </div>
                    <div class="form-group">
                      <label for="quantityInputName">Tipo de mantenimiento</label>
                      <select class="form-control" name="type_maintance" id="quantityInputName">
                        <option value="PREVENTIVO">PREVENTIVO</option>
                        <option value="CORRECTIVO">CORRECTIVO</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName">Vehículo Disponible</label>
                      <br />
                      <label class="custom-toggle">
                        <input type="checkbox" name="abble" value="export">
                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Sí"></span>
                      </label>
                    </div>
                    <div class="form-group">
                      <label for="load-file">Observaciones</label>
                      <textarea class="form-control" name="observations" id="load-file"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </form>
                  <hr />
                  <table class="table table-responsive">
                    <thead class="thead-light">
                      <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Tipo de Mantenimiento</th>
                        <th>Motivo</th>
                        <th>Proveedor</th>
                        <th>Estado</th>
                        <th>Disponible</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($maintainceList as  $doc) { ?>
                        <tr>
                          <td><?= $doc["id"] ?></td>
                          <td><?= $doc["date_maintaince"] ?></td>
                          <td><?= $doc["type_maintance"] ?></td>
                          <td><?= $doc["subject"] ?></td>
                          <td><?= $doc["provider"] ?></td>
                          <td><?= $doc["status"] ?></td>
                          <td><?= (!empty($doc["abble"])) ? "<span class='text-success'>Disponible</span>" : "<span class='text-info'>No Disponible</span>"  ?></td>
                          <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailMaintaince<?= $doc["id"] ?>">
                              Detalles
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="detailMaintaince<?= $doc["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="detailMaintainceLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="detailMaintainceLabel">Mantenimiento # <?= $doc["id"] ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <ul>
                                      <li><strong>Fecha Mantenimiento: </strong><?= $doc["date_maintaince"] ?></li>
                                      <li><strong>Tipo de Mantenimiento: </strong><?= $doc["type_maintance"] ?></li>
                                      <li><strong>Asunto: </strong><?= $doc["subject"] ?></li>
                                      <li><strong>Proveedor: </strong><?= $doc["provider"] ?></li>
                                      <li><strong>Estado: </strong><?= $doc["status"] ?></li>
                                      <li><strong>Disponible: </strong><?= (!empty($doc["abble"])) ? "<span class='text-success'>Disponible</span>" : "<span class='text-info'>No Disponible</span>"  ?></li>
                                      <li><strong>Descripción: </strong><?= $doc["observations"] ?></li>
                                      <li><strong>Costo: </strong>$ <?= $doc["cost"] ?></li>
                                      <li><strong>Resultado: </strong><?= $doc["results"] ?></li>
                                    </ul>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php  }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>