<?php
class Loader {
  function __construct() {}
  
  public function handler($components, $callback) {
    if(gettype($components) === 'string') {
      require_once $components . '.php';
      $args = new $components();
      $callback($args);
    } else if(gettype($components) === 'array') {
      $args = array();
      foreach($components AS $component) {
        require_once $component . '.php';
        $args[$component] = new $component();
      }
      $callback($args);
    } else {
      throw new InvalidArgumentException('Invalid argument type...');
    }
    
  }
}

class MyClass {

  function __construct(Loader $loader) {
    $this->controller = $loader;
  }

  function withString() {
    $this->controller->handler('Component', function ($Component) {
      var_dump($Component);
    });
  }

  function withArray() {
    $this->controller->handler(['Component', 'AnotherComponent'], function ($Components) {
      var_dump($Components['AnotherComponent']);
      var_dump($Components['Component']);
    });
  }
}

$MyClass = new MyClass(new Loader());
$MyClass->withString();
echo PHP_EOL;
$MyClass->withArray();

