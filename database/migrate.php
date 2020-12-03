<?php 

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();

define("FILE_VERSIONS", __DIR__."/versions.txt");
define("MIGRATIONS_FOLDER", __DIR__."/migrations/");
define("SEEDS_FOLDER", __DIR__."/seeds/");

$handler = fopen(FILE_VERSIONS, "r");
$content = fread($handler, filesize(FILE_VERSIONS));
$files = explode("\n", $content);

$filesMigrations  = scandir(MIGRATIONS_FOLDER);
foreach ($filesMigrations as $file) {
	if($file != "." && $file != ".." && !in_array($file, $files)){
		echo "RUN migration {$file} ------------------------------------------------------------------------\n";
		$content = readMigration($file);
		if(!empty($content)){
			if(runMigration($content)){
				addMigration($file);
				echo "migration {$file} completed ------------------------------------------------------------------------\n";
			}else{
				echo "Migraton can't ran \n";
			}
		}else{
			echo "Error: empty migration\n";
		}
		
		
	}
}

$filesSeed  = scandir(SEEDS_FOLDER);
foreach ($filesSeed as $file) {
	if($file != "." && $file != ".." && !in_array($file, $files)){
		echo "RUN migration {$file} ------------------------------------------------------------------------\n";
		$content = readSeed($file);
		if(!empty($content)){
			if(runMigration($content)){
				addMigration($file);
				echo "migration {$file} completed ------------------------------------------------------------------------\n";
			}else{
				echo "Migraton can't ran \n";
			}
		}else{
			echo "Error: empty migration\n";
		}
		
		
	}
}
function addMigration($migrationName){
	$handler = fopen(FILE_VERSIONS, "a");
	fwrite($handler, $migrationName."\n");
}

function readMigration($migrationName){
	$handler = fopen(MIGRATIONS_FOLDER.$migrationName, "r");
	$content = fread($handler, filesize(MIGRATIONS_FOLDER.$migrationName));
	return $content;
}

function readSeed($seedName){
	$handler = fopen(SEEDS_FOLDER.$seedName, "r");
	$content = fread($handler, filesize(SEEDS_FOLDER.$seedName));
	return $content;
}

function runMigration($content){
	try{
		$db = new \PDO("mysql:host=".$_ENV["DATABASE_HOST"].";dbname=".$_ENV["DATABASE_DBNAME"]."", $_ENV["DATABASE_USER"], $_ENV["DATABASE_PASSWORD"]);	
		$db->exec($content);
		$info = $db->errorInfo();
		if($info[0] == "00000"){
			return true;
		}else{
			print_r($db->errorInfo()); 
			return false;
		}
	}catch(Exception $e){
		throw new Exception("error {$e->getMessage()}", 101);
	}
}