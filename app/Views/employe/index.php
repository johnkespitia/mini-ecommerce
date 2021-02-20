<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de Empleados <a href="/employe/loadfile" class=" float-right btn btn-sm btn-secondary">Creación masiva de Empleados</a> <a href="/employe/exportxls" class=" float-right btn btn-sm btn-warning mr-2">Exportar todos los Empleados</a> <a href="/employe/new" class=" float-right btn btn-sm btn-primary mr-2">Nuevo Empleado</a>  </h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los empleados registrados </h6>
    <table class="table table-responsive">
    <thead class="thead-light">
        <tr>
            <th class="text-center">#</th>
            <th>Nombre</th>
            <th>Cédula</th>
            <th>Email</th>
            <th>Estado</th>
            <th class="text-right">Acciones</th>
        </tr>
    </thead>
    <tbody>
      <?php
      foreach ($employeesList as $cust) {
        ?>
        <tr>
          <th class="text-center" scope="row"><?= $cust["id"] ?></th>
          <td><?= $cust["name"] ?></td>
          <td><?= $cust["dni"] ?></td>
          <td><?= $cust["email"] ?></td>
          <td><?= $cust["status"]==1?"<span class='badge bg-success text-dark'>Activo</span>":"<span class='badge bg-danger text-dark'>Inactivo</span>" ?></td>
          <td class="td-actions text-right">
            <a class="btn btn-warning btn-sm" href="/employe/edit/<?=$cust["id"]?>"><i class="fas fa-pencil-alt"></i> Editar</a>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
</table>
  </div>
</div>