<div class="card">
  <div class="card-body">
    <h4 class="card-title">Check History <a href="/checker/index" class=" float-right btn btn-sm btn-primary">Check Cards</a></h4></h4>
    <h6 class="card-subtitle mb-2 text-muted">See the last 5 checkeds cards </h6>
    
    <table class="table">
      <thead>
          <tr>
              <th class="text-center">#</th>
              <th>Date Request</th>
              <th>Raw Request</th>
              <th>Raw Response</th>
              <th class="text-right">Cost</th>
          </tr>
      </thead>
      <tbody>
        <?php
        foreach ($historyList as $cust) {
          ?>
          <tr>
            <th class="text-center" scope="row"><?= $cust["id"] ?></th>
            <td><?= $cust["date_request"] ?></td>
            <td><?= $cust["raw_request"] ?></td>
            <td><?= $cust["raw_response"] ?></td>
            <td class="td-actions text-right">
            <span class="badge badge-primary"><i class="fas fa-dollar-sign"></i><?= $cust["cost_request"] ?></span>
            </td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
      </div>
	</div>
</div>
