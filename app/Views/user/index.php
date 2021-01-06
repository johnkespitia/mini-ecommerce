<div class="card">
  <div class="card-body">
    <h4 class="card-title">Listado de usuarios <a href="/user/new" class=" float-right btn btn-sm btn-primary">Nuevo Usuario</a></h4>
    <h6 class="card-subtitle mb-2 text-muted">Todos los usuarios registrados </h6>
    <table class="table">
    <thead class="thead-light">
        <tr>
            <th class="text-center">#</th>
            <th>Username</th>
            <th>Nombre</th>
            <th>Perfil</th>
            <th>Email</th>
            <th>Estado</th>
            <th class="text-right">Acciones</th>
        </tr>
    </thead>
    <tbody>
      <?php
      foreach ($userList as $cust) {
        ?>
        <tr>
          <th class="text-center" scope="row"><?= $cust["id"] ?></th>
          <td><?= $cust["username"] ?></td>
          <td><?= $cust["name"] ?></td>
          <td><?= $cust["rol_id"]==1?"Administrador":"Asesor" ?></td>
          <td><?= $cust["email"] ?></td>
          <td><?= $cust["status"]==1?"<span class='badge bg-success text-dark'>Activo</span>":"<span class='badge bg-danger text-dark'>Inactivo</span>" ?></td>
          <td class="td-actions text-right">
            <a class="btn btn-warning btn-sm" href="/user/edit/<?=$cust["id"]?>"><i class="fas fa-pencil-alt"></i> Edit</a>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
</table>
  </div>
</div>