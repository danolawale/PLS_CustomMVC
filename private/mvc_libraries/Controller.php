<?php
//Controller loads models and passes data to views
//This class contains these base functionalities for a controller

class Controller {

  //load model
  public function model($model){

    require_once PRIVATE_PATH . '/models/' . $model . '.php';

    //instantiate the model
    return new $model;
  }

  public function view($view, $data=[]){

    if(file_exists(PUBLIC_PATH . '/views/' . $view . '.php')){
      require_once PUBLIC_PATH . '/views/' . $view . '.php';
    }else{
      die('View does not exist');
    }

  }
}

 ?>
