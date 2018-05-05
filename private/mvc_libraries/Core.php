<?php
// this is the core class for the mvc
// it gets the url and calls the controller


class Core{

  protected $currentController = 'Pages';
  protected $currentMethod = 'index';
  protected $params = [];

  public function __construct(){
    $url = $this->getUrl();
    if(file_exists(PRIVATE_PATH . '/controllers/' . ucwords($url[0]) . '.php')){
      $this->currentController = ucwords($url[0]);
      unset($url[0]);
    }
    require_once(PRIVATE_PATH . '/controllers/' . $this->currentController . '.php');
    $this->currentController = new $this->currentController; //call the controller

    if(isset($url[1])){
      if(method_exists($this->currentController, $url[1])){
        $this->currentMethod = $url[1];
      }
      unset($url[1]);
    }
    //Get params
    $this->params = empty($url) ? [] : array_values($url);
    //call a callback with array of params
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  }

  public function getUrl(){
    $url = '';
    if(isset($_GET['url'])){
      $url = rtrim($_GET['url']);
      $url = filter_var($url, FILTER_SANITIZE_URL); //remove unwanted characters in the url
      $url = explode('/', $url);//now an array
      return $url;

    }
  }
}

 ?>
