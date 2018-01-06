<?php
class CLoader {
  function __construct(Config $config) {
    foreach($config->selected AS $component) {
      require_once $component . '.php';
      $this->{$component} = new $component();
    }
  }
}