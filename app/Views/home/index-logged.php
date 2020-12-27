<div class="card card-user container mt-4">
    <div class="card-body">
    <p class="card-text">
        </p><div class="author">
        <div class="block block-one"></div>
        <div class="block block-two"></div>
        <div class="block block-three"></div>
        <div class="block block-four"></div>
        <a href="javascript:void(0)">
            <h5 class="title"><h1>Welcome to <?= $_ENV['SITE_NAME'] ?></h1></h5>
        </a>
        <p class="description">
            The best Credit Card checker
        </p>
        </div>
    <p></p>
    <div class="card-description text-center">
        <p>Your account is active and your credit is <span class="badge badge-primary"><i class="fas fa-dollar-sign"></i><?= $_SESSION["credits"] ?></span>, please got to <a href="/checker/index">Check Cards</a> section and start your process 😎
        <p></p>
        <p>For add more credit please send a email to <a href="mailto:<?= $_ENV["MAIN_EMAIL"] ?>"><?= $_ENV["MAIN_EMAIL"] ?></a> with your email and your aditional amount, and we will send you the answer request with the steps for to do the pay and the confirmation.</p>
    </div>
    </div>
    <div class="card-footer">
    <div class="button-container">
    <h3>Happy Checking!</h3>
    </div>
    </div>
</div>