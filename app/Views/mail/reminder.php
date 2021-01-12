<div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
  <div class="container">
    <div class="header-body text-center mb-7">
      <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
          <img src="<?= $_ENV["SITE_URL"] ?>/themes/<?= $_ENV["THEME"] ?>/assets/img/brand/brand.png" class="img-fluid" />
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
            <h5 class="title"><h1>Recordatorio desde <?= $_ENV['SITE_NAME'] ?></h1></h5>
        </a>
        <p class="description">
            Hola <?= $contact["user"] ?> Tienes un evento programado con el cliente: <h6><?= $contact["customer"] ?></h6>
            <ul>
                <li><strong>Asunto:</strong> <?= $contact["title"] ?></li>
                <li><strong>Tipo:</strong> <?= $contact["type"] ?></li>
                <li><strong>Canal:</strong> <?= $contact["method"] ?></li>
                <li><strong>Inicio:</strong> <?= $contact["datetime_start"] ?></li>
                <li><strong>Final:</strong> <?= $contact["datetime_end"] ?></li>
                <li><strong>Descripción:</strong> <?= $contact["description"] ?></li>
            </ul>
        </p>
        </div>
    <p></p>
    <div class="card-description">
        <p>Inicia sesión ingresando a la sección de <a href="<?= $_ENV["SITE_URL"] ?>/home/login">Inicio de sesión</a> y empieza a gestionar tus clientes 😎        
    </div>
    </div>
    <div class="card-footer">
    <div class="button-container">
    
    </div>
    </div>
</div>