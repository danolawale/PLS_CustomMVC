<?php
   //controller gets model and passes the data to the views

  class Pages extends Controller {

    public function __construct(){

    }

    public function index(){
      $data = [
        'title' =>  'PLS Custom MVC'
      ];
      $this->view('pages/index', $data);
    }

    public function about(){
      $data = $this->get_common_data();
      $data = [
        'title' => 'About Us'
      ];
      $this->view('pages/about', $data);
    }
  }

 ?>
