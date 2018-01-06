<?php
/**
 * RequestValidator Class
 *
 * Connect to databases.
 *
 * @author	Domingo Ramirez
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://github.com/rdomingo1986
 */
require_once 'config/RequestParams.php';
require_once 'DataValidator.php';

class RequestValidator extends RequestParams{

  /**
	 * Class constructor
	 *
	 * Instantiate execute parent construct. 
   * 
	 * @return	void
	 */
  public function __construct() { 
    parent::__construct();
  }

  /**
	 * Validate url parameters. 
   * 
	 * @return	void
	 */
  public function isValid() {
    if(count($_GET) === 0 || (!isset($_GET['c']) && !isset($_GET['m']))) {
      throw new InvalidArgumentException('Url must containt \'c\' and \'m\' params...');
      exit;
    }

    $class = strtolower($_GET['c']);
    if(array_key_exists($class, $this->action)) {
      $method = strtolower($_GET['m']);
      if(!array_key_exists($method, $this->action[$class]['methods'])) {
        throw new InvalidArgumentException('Param \'m\' is not in the allowed list');
        exit;  
      }

      if(array_key_exists('validations', $this->action[$class]['methods'][$method])) {
        foreach($this->action[$class]['methods'][$method]['validations'] AS $key => $validation){
          if($validation['on_request']) {
            $validation['key'] = $key;
            DataValidator::validateItem($validation);
          }
        }
      }

      global $file;
      global $action;
      $file = $this->action[$class]['map'];
      $action = $this->action[$class]['methods'][$method]['map'];
    } else {
      throw new InvalidArgumentException('Param \'c\' is not in the allowed list');
      exit;
    }
  }
}
  
?>