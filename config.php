<?php
class Config {

  private $config = [
    'default' => [
      'components' => [
        'TComponent'
      ]
    ],
    'another-config' => []
  ];

  public $selected;

  function __construct($config = 'default') {
    $this->selected = $this->config[$config]['components'];
  }
}