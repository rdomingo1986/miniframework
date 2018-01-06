<?php
/**
 * DataValidator Class
 *
 * Validate data format.
 *
 * @author	Domingo Ramirez
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://github.com/rdomingo1986
 */
require_once 'config/Validations.php';

class DataValidator {

  /**
	 * Validate array of parameters. 
   * 
	 * @param 	array	$params	a validation configuration multidimentional array
	 * @return	void
	 */
  public static function isValid($params) {
    if(count($_GET) === 0 || (!isset($_GET['c']) && !isset($_GET['m']))) {
      throw new InvalidArgumentException('Url must containt \'c\' and \'m\' params...');
      exit;
    }
    $class = strtolower($_GET['c']);
    $method = strtolower($_GET['m']);
    if(array_key_exists($class, $this->action)) {
      if(!array_key_exists($method, $this->action[$class]['methods'])) {
        throw new InvalidArgumentException('Param \'m\' is not in the allowed list');
        exit;  
      }

      $this->areAdditionalsValid($class, $method);

      global $file;
      global $action;
      $file = $this->action[$class]['map'];
      $action = $this->action[$class]['methods'][$method]['map'];
    } else {
      throw new InvalidArgumentException('Param \'c\' is not in the allowed list');
      exit;
    }
  }

  public static function validateItem($item) {
    $item['value'] = ${$item['origin']}[$item['key']];
    if(array_key_exists($item, 'pre_format')) {
      $item['value'] = self::formatItem($item);
    }
  }
}
  
?>