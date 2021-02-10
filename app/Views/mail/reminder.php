<div style="padding-bottom: 8rem !important; background: linear-gradient(87deg, #5e72e4 0, #825ee4 100%) !important;">
  <div class="container" style="    width: 100%;
    margin-right: auto;
    margin-left: auto;
    padding-right: 15px;
    padding-left: 15px;">
    <div class="header-body text-center mb-7" style="text-align: center !important;margin-bottom: 6rem !important;    box-sizing: border-box;">
      <div class="row justify-content-center" style="justify-content: center !important;display: flex;
    margin-right: -15px;
    margin-left: -15px;
    flex-wrap: wrap;">
        <div class="col-xl-5 col-lg-6 col-md-8 px-5" style="padding-left: 3rem !important;    max-width: 41.66667%;
    flex: 0 0 41.66667%;position: relative;
    width: 100%;">
          <img src="cid:brand.png" class="img-fluid" style="max-width: 100%;
    height: auto;    vertical-align: middle;
    border-style: none;text-align: center !important; margin-left:50%; margin-top:20%" />
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card card-user container mt--8 pb-5 text-center" style="
    margin-right: auto;
    margin-left: auto;
    padding-right: 15px;
    padding-left: 15px;
    text-align:center;
    margin-top: -8rem !important;
    margin-bottom: 30px;
    border: 0;
    box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15);
    position: relative;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    border: 1px solid rgba(0, 0, 0, .05);
    border-radius: .375rem;
    background-color: #fff;
    background-clip: border-box;">
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
            Hola <?= $contact["user"] ?> Tienes un evento programado con el cliente: 
            <h3><?= $contact["customer"] ?></h3>
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