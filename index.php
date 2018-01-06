<?php
  try {
      // en enviar por get c y m
      // http://localhost/odirectortest/index.php?c=myclass&m=testmethod

      $file = $_GET['c'] = 'myclass';
      $action = $_GET['m'] = 'testmethod';
      
      
      if(!file_exists($file.'.php')) {
        throw new RuntimeException('Class file doesn\'t exists');
        echo 'hello';
        exit;
      }

      require_once $file.'.php';

      $director = new $file();
      $response = $director->$action();
      echo json_encode($response);

  } catch(InvalidArgumentException $e) {

      header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
      echo json_encode(array(
        'success' => false,
        'message' => $e->getMessage()
      ));

  } catch(RuntimeException $e) {

      header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
      echo json_encode(array(
        'success' => false,
        'message' => $e->getMessage()
      ));
  }
?>