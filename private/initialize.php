<?php
  ob_start();

 //get all bootstrap
 require_once("config/config.php");
 require_once("utilities/utils.php");
 require_once("config/database_config.php");
 require_once("utilities/database_utils.php");



 //autoload classes
 spl_autoload_register('classes_autoload');
 spl_autoload_register('mvc_autoload');
 $db = db_connect();
 DatabaseObject::set_database($db);


 ?>
