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
    </p>
    <div class="author">
      <div class="block block-one"></div>
      <div class="block block-two"></div>
      <div class="block block-three"></div>
      <div class="block block-four"></div>
      <a href="javascript:void(0)">
        <h5 class="title">
          <h1>Recordatorio desde <?= $_ENV['SITE_NAME'] ?></h1>
        </h5>
      </a>
      <p class="description">
        A continuaci&oacute;n te env&iacute;o el estado de los Empleados que est&aacute;n cerca de alg&uacute;na acci&oacute;n
      </p>
      <h4>Documentos pr&oacute;ximos a expirar</h4>
      <table style="border: 1px solid black; width:100%;">
        <thead>
          <tr>
            <th  style="border: 1px solid black;">Trabajador</th>
            <th  style="border: 1px solid black;">Documento</th>
            <th  style="border: 1px solid black;">Fecha de Expiraci&oacute;n</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($documents as $d) { ?>
            <tr>
              <td style="border: 1px solid black;"><?= $d["employe_dni"] ?> <?= $d["employe_name"] ?></td>
              <td style="border: 1px solid black;"><?= $d["document_name"] ?></td>
              <td style="border: 1px solid black;"><?= $d["expiration_date"] ?></td>
            </tr>
          <?php  } ?>
        </tbody>
      </table>
      <h4>Cursos cercanos a expirar</h4>
      <table style="border: 1px solid black; width:100%">
        <thead>
          <tr>
            <th  style="border: 1px solid black;">Trabajador</th>
            <th  style="border: 1px solid black;">Curso</th>
            <th  style="border: 1px solid black;">Fecha</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($courses as $d) { ?>
            <tr>
            <td style="border: 1px solid black;"><?= $d["employe_dni"] ?> <?= $d["employe_name"] ?></td>
              <td style="border: 1px solid black;"><?= $d["course_name"] ?></td>
              <td style="border: 1px solid black;"><?= $d["expiration_date"] ?></td>
            </tr>
          <?php  } ?>
        </tbody>
      </table>
    </div>
    <p></p>
    <div class="card-description">
      <p>Inicia sesi&oacute;n ingresando a la secci&oacute;n de <a href="<?= $_ENV["SITE_URL"] ?>/home/login">Inicio de sesi&oacute;n</a> y empieza a gestionar tus procesos 😎
    </div>
  </div>
  <div class="card-footer">
    <div class="button-container">

    </div>
  </div>
</div>