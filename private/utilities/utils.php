<?php
//these contain general functions

function url_for($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

function u($string="") {
  return urlencode($string);
}

function raw_u($string="") {
  return rawurlencode($string);
}

function h($string="") {
  return htmlspecialchars($string);
}

function error_404() {
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

function mvc_autoload($class){
  if(preg_match('/\A\w+\Z/', $class)){
    if(file_exists(MVC_LIB_PATH .'/'. $class . '.php')){
      include MVC_LIB_PATH .'/'. $class . '.php';
    }
  }
}

function classes_autoload($class){
  if(preg_match('/\A\w+\Z/', $class)){
    if(file_exists(CLASS_PATH .'/'. $class . '.class.php')){
      include CLASS_PATH .'/'. $class . '.class.php';
    }
  }
}


 ?>
