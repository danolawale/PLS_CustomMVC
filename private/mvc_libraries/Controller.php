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

  /**public function view($view, $data=[]){

    if(file_exists(PUBLIC_PATH . '/views/' . $view . '.php')){
      require_once PUBLIC_PATH . '/views/' . $view . '.php';
    }else{
      die('View does not exist');
    }

  }**/
  public function view($view, $data=[]){
    $data = array_merge($data, $this->get_common_data());
    $template = TwigTemplating::loadTemplate(PUBLIC_PATH . '/views/', $view .'.php');
    TwigTemplating::populateTemplate($template, $data);
    TwigTemplating::renderTemplate($template);
  }

  public function get_common_data(){
    $data = [
      'asset_folder' => url_for('assets'),
      'site_name'     => 'Custom MVC',
      'site_header'  => '/views_includes/inc/header.php',
      'site_footer'  => '/views_includes/inc/footer.php'
    ];
    return $data;
  }

}

 ?>
