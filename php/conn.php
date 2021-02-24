<?php
define('ROOT_DIR', dirname(__DIR__, 1));

$config_filename = ROOT_DIR.'/config.json';

if (!file_exists($config_filename)) {
    throw new Exception("Can't find ".$config_filename);
}
$config = json_decode(file_get_contents($config_filename), true);

define('HOST', $config['database']['host']);
define('DB', $config['database']['db']);
define('USERNAME', $config['database']['user']);
define('PASSWORD', $config['database']['pass']);

$dsn = "mysql:host=".HOST.";dbname=".DB;
$pdo = new PDO($dsn, USERNAME, PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);