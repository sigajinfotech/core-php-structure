<?php
$environment = 'development';
if($environment=='development'){
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'demo-test');
}else{
	error_reporting(0);
	ini_set('display_errors', 0);

	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'demo-test');
}

require_once('db.php');
$DAO = new DAO(DB_HOST,DB_USER,DB_PASS,DB_NAME);

?>