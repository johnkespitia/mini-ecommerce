<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de ciudades <a href="/city/new" class=" float-right btn btn-sm btn-primary mr-2">Nueva Ciudad</a> </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todas las ciudades registradas</h6>
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
      foreach ($cityList as $cust) {
        ?>
        <tr>
          <th class="text-center" scope="row"><?= $cust["id"] ?></th>
          <td><?= $cust["name"] ?></td>
          <td class="td-actions text-right">
            <a class="btn btn-warning btn-sm" href="/city/edit/<?=$cust["id"]?>"><i class="fas fa-pencil-alt"></i> Editar</a>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
</table>
  </div>
</div>