<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de tipos de Trailer
      <?php if (!empty($_SESSION["permissions"]["Tipo de Trailer"]["Crear"]) && $_SESSION["permissions"]["Tipo de Trailer"]["Crear"] == 1) { ?>
        <a href="/trailertype/new" class=" float-right btn btn-sm btn-primary">Nuevo Tipo de Trailer</a>
      <?php } ?>
    </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los tipos de Trailer registrados</h6>
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
        foreach ($carTypeList as $cust) {
        ?>
          <tr>
            <th class="text-center" scope="row"><?= $cust["id"] ?></th>
            <td><?= $cust["name"] ?></td>
            <td class="td-actions text-right">
              <?php if (!empty($_SESSION["permissions"]["Tipo de Trailer"]["Editar"]) && $_SESSION["permissions"]["Tipo de Trailer"]["Editar"] == 1) { ?>
                <a class="btn btn-warning btn-sm" href="/trailertype/edit/<?= $cust["id"] ?>"><i class="fas fa-pencil-alt"></i> Editar</a>
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