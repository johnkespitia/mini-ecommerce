<!-- Header -->
<script>
  function setTab(tabId) {
    $(`#tabs-icons-text a[href='#${tabId}']`).tab('show');
  }
</script>
<!-- Header -->
<div class="header pb-6 d-flex align-items-center" style="min-height: 500px;">
  <!-- Mask -->
  <span class="mask bg-gradient-default opacity-8"></span>
  <!-- Header container -->
  <div class="container-fluid d-flex align-items-center">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <h1 class="display-2 text-white"><?= $employe["name"] ?></h1>
        <p class="text-white mt-0 mb-1">
          <?= $employe["dni_type"] ?> <?= $employe["dni"] ?>
        </p>
        <p class="text-white mt-0 mb-1">
          <?= $employe["area_name"] ?>
        </p>
        <p class="text-white mt-0 mb-5"><?= $employe["email"] ?></p>
        <?php if (!empty($_SESSION["permissions"]["Empleados"]["Editar"]) && $_SESSION["permissions"]["Empleados"]["Editar"] == 1) { ?>
          <a href="/employe/edit/<?= $employe["id"] ?>" class="btn btn-neutral">Editar</a>
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
                <?php if(sizeof($images)>0 ){ ?><img src="<?= $images[0]["url"] ?>" class="rounded-circle"><?php } ?>
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
                  <span class="heading"><?= $employe["birth_date"] ?></span>
                  <span class="description">Cumpleaños</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card-profile-stats d-flex justify-content-center">
                <div>
                  <span class="heading"><?= $employe["city_exp"] ?></span>
                  <span class="description">Ciudad Documento</span>
                </div>
                <div>
                  <span class="heading"><?= $employe["rh"] ?></span>
                  <span class="description">RH</span>
                </div>
                <div>
                  <span class="heading"><?= $employe["eps_name"] ?></span>
                  <span class="description">EPS</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card-profile-stats d-flex justify-content-center">
                <div>
                  <span class="heading"><?= $employe["bank_name"] ?></span>
                  <span class="description">Banco</span>
                </div>
                <div>
                  <span class="heading"><?= $employe["payment_base"] ?></span>
                  <span class="description">Periodo de Pago</span>
                </div>
                <div>
                  <span class="heading"><?= $employe["payment_method"] ?></span>
                  <span class="description">Método de Pago</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card-profile-stats d-flex justify-content-center">
                <div>
                  <span class="heading"><?= $employe["salary"] ?></span>
                  <span class="description">Salario</span>
                </div>
                <div>
                  <span class="heading"><?= $employe["account_type"] ?></span>
                  <span class="description">Tipo de Cuenta</span>
                </div>
                <div>
                  <span class="heading"><?= $employe["account_number"] ?></span>
                  <span class="description">Número de Cuenta</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card-profile-stats d-flex justify-content-center">
                <div>
                  <span class="heading"><?= $employe["start_date"] ?></span>
                  <span class="description">Fecha de Inicio</span>
                </div>
                <div>
                  <span class="heading"><?= $employe["type_contract"] ?></span>
                  <span class="description">Tipo de Contrato</span>
                </div>
                <div>
                  <span class="heading"><?= $employe["contract_agreement"] ?></span>
                  <span class="description">Modo de contratación</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card-profile-stats d-flex justify-content-center">
                <div>
                  <span class="heading"><?= $employe["pension_name"] ?></span>
                  <span class="description">Pensión</span>
                </div>
                <div>
                  <span class="heading"><?= $employe["arl_name"] ?></span>
                  <span class="description">ARL</span>
                </div>
                <div>
                  <span class="heading"><?= $employe["caja_compensacion_name"] ?></span>
                  <span class="description">Caja de Compensación</span>
                </div>
              </div>
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
              <h3 class="mb-0">Información del Empleado </h3>
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
                <a class="nav-link mb-sm-3 mb-md-0" id="learning-tab" data-toggle="tab" href="#learning" role="tab" aria-controls="learning" aria-selected="false"><i class="fas fa-graduation-cap mr-2"></i>Cursos</a>
              </li>
            </ul>
          </div>
          <div class="card shadow">
            <div class="card-body">
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">

                  <h3>Alertas</h3>
                  <table class="table table-responsive">
                    <thead class="thead-light">
                      <tr>
                        <th>Tipo</th>
                        <th>Detalle</th>
                        <th>Fecha/Momento</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($docsExpired as $doc) {
                      ?>
                        <tr>
                          <td>Documentos por expirar</td>
                          <td><?= $doc["document_name"] ?></td>
                          <td><?= $doc["expiration_date"] ?></td>
                          <td>
                            <a class="btn btn-sm btn-warning text-white" onclick="setTab('documents')"><i class="ni ni-collection mr-2"></i>Renovar Documento</a>
                          </td>
                        </tr>
                      <?php  } ?>
                      <?php foreach ($coursesExpired as $doc) {
                      ?>
                        <tr>
                          <td>Cursos por expirar</td>
                          <td><?= $doc["course_name"] ?></td>
                          <td><?= $doc["expiration_date"] ?></td>
                          <td>
                            <a class="btn btn-sm btn-warning text-white" onclick="setTab('learning')"><i class="fas fa-graduation-cap mr-2"></i>Renovar Curso</a>
                          </td>
                        </tr>
                      <?php  } ?>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                  <?php
                  $indicators = [];
                  $slides = [];
                  $active = true;
                  foreach ($images as $key => $value) {
                    $activecls = ($active) ? "active" : "";
                    $eliminar = (!empty($_SESSION["permissions"]["Empleados"]["Editar"]) && $_SESSION["permissions"]["Empleados"]["Editar"] == 1) ? "<a href='/employe/deleteimage/{$value["id"]}/{$employe["id"]}' class='btn btn-danger'>Eliminar Imagen</a>" : "";
                    $indicators[] = "<li data-target='#carouselImages' class='{$activecls}' data-slide-to='{$key}'></li>";
                    $slides[] = "<div class='carousel-item {$activecls}'>
                                  <img class='d-block w-100' src='{$value["url"]}' alt='{$employe["dni"]}_{$key}'>
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
                  <form method="post" action="/employe/storeimage/<?= $employe["id"] ?>" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="load-file">Foto</label>
                      <input type="file" class="form-control" name="photo" id="load-file" accept=".jpg,.png,.gif,.jpeg" />
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </form>
                </div>
                <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                  <h2 class="title">Documentos del Empleado</h2>
                  <h3>Añadir Documento</h3>
                  <form method="post" action="/employe/storefile/<?= $employe["id"] ?>" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName">Tipo de Documento</label>
                      <select required class="form-control" name="document_type">
                        <?php
                        foreach ($documentsTypeList as $key => $value) { ?>
                          <option value='<?= $value["id"] ?>'><?= $value["name"] ?></option>
                        <?php } ?>
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
                      <label for="exampleInputName">Expedición</label>
                      <input required type="date" class="form-control" name="expedition_date" id="exampleInputName">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName">Expiración</label>
                      <input required type="date" class="form-control" name="expiration_date" id="exampleInputName">
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
                        <th>Expedición</th>
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
                          <td><?= (!empty($doc["expiration_date"]) && strtotime($doc["expiration_date"]) < time()) ? "<span class='text-danger'>Expirado</span>" : "<span class='text-success'>Vigente</span>"  ?></td>
                          <td><?= $doc["date_created"] ?></td>
                          <td><?= $doc["expedition_date"] ?></td>
                          <td><?= $doc["expiration_date"] ?></td>
                          <td>
                            <a target="_blank" href='<?= $doc["url"] ?>' class='btn btn-sm btn-success mb-2'>Descargar</a>
                            <?php
                            if (!empty($_SESSION["permissions"]["Empleados"]["Editar"]) && $_SESSION["permissions"]["Empleados"]["Editar"] == 1) { ?>
                              <br /><a href='/employe/deletefile/<?= $doc["id"] ?>/<?= $employe["id"] ?>' class='btn btn-sm btn-danger'>Eliminar</a>
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
                <div class="tab-pane fade" id="learning" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                  <h2 class="title">Cursos</h2>
                  <h2 class="title">Cursos del Empleado</h2>
                  <h3>Añadir Curso</h3>
                  <form method="post" action="/employe/storecourse/<?= $employe["id"] ?>" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName">Curso</label>
                      <select required class="form-control" name="course">
                            <?php foreach ($coursesList as $key => $c) { ?>
                              <option value="<?= $c["id"]?>"><?=$c["name"]?></option>
                            <?php }?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName">Proveedor</label>
                      <input required type="text" class="form-control" name="provider" id="exampleInputName">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName">Código</label>
                      <input required type="text" class="form-control" name="code" id="exampleInputName">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName">Expedición</label>
                      <input required type="date" class="form-control" name="expedition_date" id="exampleInputName">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName">Expiración</label>
                      <input required type="date" class="form-control" name="expiration_date" id="exampleInputName">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName">Calificación</label>
                      <input required type="number" min="0" max="100" class="form-control" name="qualification" id="exampleInputName">
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
                        <th>Curso</th>
                        <th>Proveedor</th>
                        <th>Código</th>
                        <th>Estado</th>
                        <th>Registro</th>
                        <th>Expedición</th>
                        <th>Vencimiento</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($courses as  $doc) { ?>
                        <tr>
                          <td><?= $doc["id"] ?></td>
                          <td><?= $doc["course_name"] ?></td>
                          <td><?= $doc["provider"] ?></td>
                          <td><?= $doc["code"] ?></td>
                          <td><?= (!empty($doc["expiration_date"]) && strtotime($doc["expiration_date"]) < time()) ? "<span class='text-danger'>Expirado</span>" : "<span class='text-success'>Vigente</span>"  ?></td>
                          <td><?= $doc["date_created"] ?></td>
                          <td><?= $doc["expedition_date"] ?></td>
                          <td><?= $doc["expiration_date"] ?></td>
                          <td>
                            <a href='<?= $doc["url"] ?>' class='btn btn-sm btn-success mb-2'>Descargar</a>
                            <?php
                            if (!empty($_SESSION["permissions"]["Empleados"]["Editar"]) && $_SESSION["permissions"]["Empleados"]["Editar"] == 1) { ?>
                              <br /><a href='/employe/deletecourse/<?= $doc["id"] ?>/<?= $employe["id"] ?>' class='btn btn-sm btn-danger'>Eliminar</a>
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>