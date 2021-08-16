<div class="header pb-6 d-flex align-items-center" style="min-height: 200px;">
  <!-- Mask -->
  <span class="mask bg-gradient-default opacity-8"></span>
  <!-- Header container -->
  <div class="container-fluid d-flex align-items-center">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <h1 class="display-2 text-white">Detalle de sección Checklist <?= $checksList["title"] ?></h1>
        <p class="text-white mt-0 mb-1"><strong>Checklist:</strong> <?= $checksList["checklist_type_name"] ?></p>
        <p class="text-white mt-0 mb-1"><strong>Obligatoriedad:</strong> <?= ($checksList["required"] == 1) ? "Obligatorio" : "Opcional" ?></p>
        <p class="text-white mt-0 mb-1"><strong>Depende de:</strong> <a href="/checklist/detail/<?= $checksList["id_parent"] ?>"><?= $checksList["title_parent"] ?></a></p>
        <p class="text-white mt-0 mb-1"><strong>Versión:</strong> <?= $checksList["version"] ?></p>
        <p class="text-white mt-0 mb-1"><strong>Estado:</strong> <?= ($checksList["status"] == 1) ? "Activa" : "Inactiva" ?></p>
        <?php if (!empty($_SESSION["permissions"]["Checklist Vehículos"]["Editar"]) && $_SESSION["permissions"]["Checklist Vehículos"]["Editar"] == 1) { ?>
          <a href="/checklist/edit/<?= $checksList["id"] ?>" class=" float-left btn btn-sm btn-primary mr-2">Editar checklist</a>
        <?php } ?>
        <a href="/checklist/index/<?= $checksList["checklist_type"] ?>" class=" float-left btn btn-sm btn-secondary mr-2">Listado de secciones de checklist</a>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid mt--4">
  <div class="row">

    <div class="col-xl-12 order-xl-1">
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
                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fas fa-question-circle mr-2"></i>Preguntas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="far fa-question-circle mr-2 mr-2"></i>Nueva Pregunta</a>
              </li>
            </ul>
          </div>
          <div class="card shadow">
            <div class="card-body">
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                  <h3>Preguntas</h3>
                  <table class="table table-responsive">
                    <thead class="thead-light">
                      <tr>
                        <th>Tipo</th>
                        <th>Detalle</th>
                        <th>Opciones</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($questions as $q) {
                      ?>
                        <tr>
                          <td><?= $q["q_type"] ?></td>
                          <td><?= $q["question"] ?></td>
                          <td><?php foreach ($q["options"] as $opt) {
                                echo "{$opt['option_text']}<br/>";
                              } ?></td>
                          <td>
                            <?php if (!empty($_SESSION["permissions"]["Checklist Vehículos"]["Editar"]) && $_SESSION["permissions"]["Checklist Vehículos"]["Editar"] == 1) { ?>
                              <a class="btn btn-sm btn-danger text-white" href="/checklist/deletequestion/<?= $q["id"] ?>">Eliminar</a>
                            <?php } ?>
                          </td>
                        </tr>
                      <?php  }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                  <h2 class="title">Nueva Pregunta</h2>
                  <h3>Adición de nuevas Preguntas</h3>
                  <form method="post" action="/checklist/storequestion/<?= $checksList["id"] ?>" ">
                    <div class=" form-group">
                    <label for="date_fuelInputName">Pregunta</label>
                    <input required type="text" class="form-control" name="question" id="date_fuelInputName">
                </div>
                <div class="form-group">
                  <label for="providerInputName">Tipo de pregunta</label>
                  <select class="form-control" name="question_type_id" id="exampleInputrequired">
                    <?php
                    foreach ($questionTypes as $type) {
                      echo "<option value='{$type['id']}'>{$type['type']}</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="options">Opciones (1 por línea)</label>
                  <textarea class="form-control" name="options" id="options" placeholder="opción 1
opción 2"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>