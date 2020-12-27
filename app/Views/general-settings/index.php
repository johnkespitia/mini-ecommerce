<div class="card">
  <div class="card-body">
    <h4 class="card-title">General Configs List <a href="/generalsettings/new" class=" float-right btn btn-sm btn-primary">New Config</a></h4>
    <h6 class="card-subtitle mb-2 text-muted">All General configs  </h6>
    <table class="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Name</th>
            <th>Value</th>
            <th>Status</th>
            <th class="text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
      <?php
      foreach ($settingslist as $cust) {
        ?>
        <tr>
          <th class="text-center" scope="row"><?= $cust["id"] ?></th>
          <td><?= $cust["name"] ?></td>
          <td><?= $cust["value"] ?></td>
          <td><?= $cust["status"]==1?"<span class='badge bg-success text-dark'>Active</span>":"<span class='badge bg-danger text-dark'>Inactive</span>" ?></td>
          <td class="td-actions text-right">
            <a class="btn btn-warning btn-sm" href="/generalsettings/edit/<?=$cust["id"]?>"><i class="fas fa-pencil-alt"></i> Edit</a>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
</table>
  </div>
</div>