<?php
function db_connect(){
  $connection = new PDO(DSN, DB_USER, DB_PASS);
  confirm_db_connect($connection);
  return $connection;
}

function confirm_db_connect($connection){
  if($connection->errorCode()){
    $msg = "Database connection failed: ";
    $msg .= $connection->errorInfo()[2];
    #print_r($connection->errorInfo());
    $msg .= " (" . $connection->errorCode() . ")";
    exit($msg);
  }
}

function db_disconnect($connection) {
  if(isset($connection)){
    $connection = null;
  }
}

 ?>
