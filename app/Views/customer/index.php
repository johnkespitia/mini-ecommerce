<div class="card">
  <div class="card-body">
    <h4 class="card-title">User List <a href="/customer/new" class=" float-right btn btn-sm btn-primary">New User</a></h4>
    <h6 class="card-subtitle mb-2 text-muted">All registered users </h6>
    <table class="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Username</th>
            <th>Name</th>
            <th>Rol</th>
            <th>Email</th>
            <th>Credit</th>
            <th>Status</th>
            <th class="text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
      <?php
      foreach ($customerList as $cust) {
        ?>
        <tr>
          <th class="text-center" scope="row"><?= $cust["id"] ?></th>
          <td><?= $cust["username"] ?></td>
          <td><?= $cust["name"] ?></td>
          <td><?= $cust["rol_id"]==1?"Administrator":"Customer" ?></td>
          <td><?= $cust["email"] ?></td>
          <td><i class="fas fa-dollar-sign"></i><?= $cust["credits"] ?></td>
          <td><?= $cust["status"]==1?"<span class='badge bg-success text-dark'>Active</span>":"<span class='badge bg-danger text-dark'>Inactive</span>" ?></td>
          <td class="td-actions text-right">
            <a class="btn btn-warning btn-sm" href="/customer/edit/<?=$cust["id"]?>"><i class="fas fa-pencil-alt"></i> Edit</a>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
</table>
  </div>
</div>