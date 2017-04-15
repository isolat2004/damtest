<?php
class App {
	// etap 1 controller par defaut,qui sera ini. grace au fc __construct(),en fonction du controle/page que l internaute aurait demandé
  private $controller = 'home';
  private $method = 'index';
  private $params = [];
    //etap 3
  public function __construct() {
    $route = $this->getParams();
      //etap 4
    if ( file_exists( ROOT . 'app/controllers/' . $route[0] . '.php' ) ) {
      $this->controller = $route[0];
      unset ( $route[0] );
    }
     //etap 5
    require_once ROOT . 'app/controllers/' . $this->controller . '.php';
      //etap6
    if ( isset ( $route[1] ) ) {
      if ( method_exists( $this->controller, $route[1] ) ) {
        $this->method = $route[1];
        unset( $route[1] );
      }
    }
      //etap7
    $this->controller = new $this->controller;
      //etap8
    $this->params = $route ? array_values( $route ) : [];
      //etap9
    call_user_func_array( [ $this->controller, $this->method ], $this->params );
  }
    //etape 2
  private function getParams() {
    if ( isset( $_GET['route'] ) )
      return explode( '/', filter_var( rtrim( $_GET['route'], '/' ), FILTER_SANITIZE_URL ) );
  }
}
