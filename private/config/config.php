<?php
//set up all site constants

define("PRIVATE_PATH", dirname(dirname(__FILE__)));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . "/public");
define("MVC_LIB_PATH", PRIVATE_PATH . '/mvc_libraries');

$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

define('SITENAME', 'Custom MVC');

 ?>
