<div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
  <div class="container">
    <div class="header-body text-center mb-7">
      <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
          <img src="/themes/<?= $_ENV["THEME"] ?>/assets/img/brand/brand.png" class="img-fluid" />
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card card-user container mt--8 pb-5 text-center">
    <div class="card-body">
    <p class="card-text">
        </p><div class="author">
        <div class="block block-one"></div>
        <div class="block block-two"></div>
        <div class="block block-three"></div>
        <div class="block block-four"></div>
        <a href="javascript:void(0)">
            <h5 class="title"><h1>Algo ha salido mal</h1></h5>
        </a>
        <h2 class="description">
            Tenemos un error con código <span class="badge badge-danger"><?= $code ?></span>
        </h2>
        </div>
    <p></p>
    <div class="card-description">
        <p>EL mensaje de error es:        </p>
        <div class="alert alert-danger" role="alert">
            <?= $error??"nothing" ?>
        </div>
        <a class="btn btn-primary text-white" href="/">Ir a Inicio</a>
    </div>
    </div>
    <div class="card-footer">
    <div class="button-container">
    
    </div>
    </div>
</div>