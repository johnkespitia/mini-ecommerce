<div class="card">
  <div class="card-body">
    <h4 class="card-title">Check Cards </h4>
    <h6 class="card-subtitle mb-2 text-muted">Set all card info and click in the check button! </h6>
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-header bg-transparent pb-5">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>CC Check Form</small>
                <?php
                if(!empty($errors)){ ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $errors ?>
                    </div>
                <?php } ?>
              </div>
              <form role="form" method="post" action="">
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text" style="background-color: #1e1e2f;"><i class="fas fa-envelope" style="width: 25px;"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" name="email" style="color: black;" required type="email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"  style="background-color: #1e1e2f;"><i class="fas fa-key" style="width: 25px;"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" type="password" style="color: black;" required name="password">
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Sign in</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <h6 class="card-subtitle mb-2 text-muted">Last 5 requests </h6>
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
        foreach ($historyList as $cust) {
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
