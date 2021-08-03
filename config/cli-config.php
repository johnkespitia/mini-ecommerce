<?php
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array(__DIR__."/../app/Models/Yaml");
$isDevMode = $_ENV['SITE_ENVIRONMENT']=="DEV";

// the connection configuration
$dbParams = array(
    'driver'   =>"pdo_mysql",
    'host'   => $_ENV["DATABASE_HOST"],
    'user'     => $_ENV["DATABASE_USER"],
    'password' => $_ENV["DATABASE_PASSWORD"],
    'dbname'   => $_ENV["DATABASE_DBNAME"],
);

foreach (glob(__DIR__."/../app/Models/Entities/*.php") as $filename)
{
    include $filename;
}

$config = Setup::createYAMLMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);

return ConsoleRunner::createHelperSet($entityManager);