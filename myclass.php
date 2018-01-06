<?php
require_once 'CLoader.php';
require_once 'config.php';

class MyClass extends CLoader{
  
  function __construct() {
    parent::__construct(new Config());
  }

  public function testMethod() {
    return $this->TComponent->sayHello();
  }
}