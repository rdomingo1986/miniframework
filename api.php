<?php
  try {

      require_once 'library/URLValidator.php';
      $url = new URLValidator();
      $url->isValid();

      require_once $class.'.php';
      $controller = new $class();
      echo json_encode($controller->$method());

  } catch(InvalidArgumentException $e) {

      header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
      echo json_encode(array(
        'success' => false,
        'message' => 'Invalid url parameters'
      ));

  }
  
?>