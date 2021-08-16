<?php if (isset($_SESSION["permissions"]["Planillas"]["Listar"]) && $_SESSION["permissions"]["Planillas"]["Listar"] == 1) {
?>
    <div class="card">
        <div class="card-header" id="headingThree">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#checklist" aria-expanded="false" aria-controls="checklist">
                    Checklist
                </button>
            </h5>
        </div>
        <div id="checklist" class="collapse" aria-labelledby="headingThree" data-parent="#menuAccordion">
            <div class="card-body">
                <ul class="navbar-nav">
                    <?php foreach ($list as $ch) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/checklist/index/<?= $ch["id"] ?>">
                                <i class="fas fa-clipboard-check"></i> <?= $ch["name"] ?>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/checklist/newtype">
                            <i class="fas fa-notes-medical"></i> Agregar nuevo
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>