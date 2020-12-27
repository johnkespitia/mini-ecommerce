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
                <?php if(!empty($result)){ ?>
                    <div class="alert alert-success" role="alert">
                        <?= $result ?>
                    </div>
                <?php } ?>
              </div>
              <form role="form" method="post" action="">
                <div class="row text-dark">
                    <div class="col-md-5 pr-md-1">
                      <div class="form-group">
                        <label class="text-dark">Card Number</label>
                        <input type="number" required min="0" class="form-control text-dark" name="cardnumber" placeholder="Card Number" value="">
                      </div>
                    </div>
                    <div class="col-md-3 px-md-1">
                      <div class="form-group">
                        <label class="text-dark">MM</label>
                        <input type="number" required min="1" max="12" class="form-control text-dark"  name="month" placeholder="Month" value="">
                      </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                      <div class="form-group">
                        <label class="text-dark">YY</label>
                        <input type="number" required min="<?= date("y") ?>" class="form-control text-dark" name="year"  placeholder="Year 2 digits">
                      </div>
                    </div>
                  </div>
                  <div class="row text-dark">
                    <div class="col-md-3 pr-md-1">
                      <div class="form-group">
                        <label class="text-dark">CVV2</label>
                        <input type="number" required min="0" max ="9999" class="form-control text-dark" name="cvv" placeholder="CVV2" value="">
                      </div>
                    </div>
                    <div class="col-md-5 px-md-1">
                    </div>
                    <div class="col-md-4 pl-md-1">
                    </div>
                  </div>
                  <div class="row text-dark">
                    <div class="col-md-6 pr-md-1">
                    <button type="submit" class="btn btn-primary my-4">Check Card</button>
                  </div>
                    <div class="col-md-6 pr-md-1">
                    <a class="btn btn-dark my-4 float-right" href="/checker/history">History</a>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
	</div>
</div>
