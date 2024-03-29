<!-- Header -->
<div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
  <div class="container">
    <div class="header-body text-center mb-7">
      <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
          <h1 class="text-white">Bienvenido!</h1>
          <p class="text-lead text-white">Debes autenticarte primero para utilizar el CRM.</p>
        </div>
      </div>
    </div>
  </div>
</div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-header bg-transparent pb-5">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>Sign in with credentials</small>
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
                      <span class="input-group-text" style="background-color: #1e1e2f;"><i class="fas fa-envelope" ></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" name="email" style="color: black;" required type="email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"  style="background-color: #1e1e2f;"><i class="fas fa-key" ></i></span>
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