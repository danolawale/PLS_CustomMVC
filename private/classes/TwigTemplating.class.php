<?php # Another example of implicit class instantiation and property declarations
  require_once VENDOR_PATH . '/autoload.php';

  class TwigTemplating {

    private $loader;
    private $twig;
    #private $template;
    private $include = PRIVATE_PATH;

    private function __construct($template_path){
      //$loader = new Twig_Loader_Filesystem($template_path);
      $loader = new Twig_Loader_Filesystem([$this->include, $template_path]);
      $twig = new Twig_Environment($loader);
      $this->loader = $loader;
      $this->twig = $twig;
    }

    public static function preloadTemplatePath($template_path){
      if(is_dir($template_path)){
        $instance = new self($template_path);
        return $instance;
      }else{
        echo "Supplied Directory could not be found";
      }
    }

    public static function loadTemplate($template_path, $template_name, $instance=''){
      if(!isset($instance->twig) || !isset($instance->loader)){
        $instance = self::preloadTemplatePath($template_path);
      }
      if(file_exists($template_path.'/'.$template_name)){
        $template = $instance->twig->load($template_name);
        $instance->template = $template;
        return $instance;
      }else{
        echo "Template supplied could not be found";
      }

    }

    public static function populateTemplate($instance, $data=[]) {
      $instance->output = $instance->template->render($data);
    }

    public static function renderTemplate($instance) {
      echo $instance->output;
    }
  }
 ?>
