<?php
class Persons {
  public $personsData;

  function __construct() { 
    $this->personsData = array(
      array(
        'id' => 1,
        'nombre' => 'Domingo',
        'apellido' => 'Ramirez',
        'edad' => 31
      ),
      array(
        'id' => 2,
        'nombre' => 'Ninoska',
        'apellido' => 'Suarez',
        'edad' => 30
      ),
    );
  }

  public function listAll() {
    return $this->personsData;
  }

  public function insertOne() {
    return array(
      'success' => true,
      'message' => 'Person has been created',
      'data' => $_POST
    );
  }

  public function selectOne() {
    
    return array(
      'success' => true,
      'message' => '',
      'responseBody' => $this->getById($_POST['id'])
    );
  }

  public function updateOne() {
    return array(
      'success' => true,
      'message' => 'Person has been updated',
      'responseBody' => $_POST
    );
  }

  public function deleteOne() {
    return array(
      'success' => true,
      'message' => 'Person has been deleted',
      'responseBody' => $this->getById($_POST['id'])
    );
  }

  private function getById($id) {
    $person = null;

    foreach($this->personsData AS $person) {
      if($person['id'] == $id) {
        $data = $person;
      }
    }

    return $person;
  }
}
?>