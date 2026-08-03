<?php
ini_set('error_reporting', E_ALL);                            
date_default_timezone_set('Asia/Yangon');             
$dbhost = 'localhost';                                        
$dbname = 'lv5_ecommerce';                                                                         
$dbuser = 'root';
$dbpass = 'creation11111';

// Defining base url
define("BASE_URL", "");

// Getting Admin url
define("ADMIN_URL", BASE_URL . "admin" . "/");

$url = "http://{$_SERVER['HTTP_HOST']}/F-Tech-kuro";

try {
	$conn = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $e ) {
	echo "Connection error : " . $e->getMessage();
}