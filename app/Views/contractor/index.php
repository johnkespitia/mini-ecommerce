<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Contratista
      <?php if (!empty($_SESSION["permissions"]["Contratista"]["Crear"]) && $_SESSION["permissions"]["Contratista"]["Crear"] == 1) { ?>
        <a href="/contractor/new" class=" float-right btn btn-sm btn-primary mr-2">Nuevo Contratista</a>
      <?php } ?>
    </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los Contratistas registrados</h6>
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
        foreach ($rolList as $cust) {
        ?>
          <tr>
            <th class="text-center" scope="row"><?= $cust["id"] ?></th>
            <td><?= $cust["name"] ?></td>
            <td class="td-actions text-right">
              <?php if (!empty($_SESSION["permissions"]["Contratista"]["Editar"]) && $_SESSION["permissions"]["Contratista"]["Editar"] == 1) { ?>
                <a class="btn btn-warning btn-sm" href="/contractor/edit/<?= $cust["id"] ?>"><i class="fas fa-pencil-alt"></i> Editar</a>
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