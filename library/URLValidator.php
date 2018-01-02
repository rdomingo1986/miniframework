<?php
/**
 * URLValidator Class
 *
 * Connect to databases.
 *
 * @author	Domingo Ramirez
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://github.com/rdomingo1986
 */
require_once 'config/RequestParams.php';

class URLValidator extends RequestParams{

  /**
	 * Class constructor
	 *
	 * . 
   * 
	 * @return	void
	 */
  public function __construct() { 
    parent::__construct();
  }
  /**
	 * Validate url parameters. 
   * 
	 * @param 	mixed	$params	An object of PDatabase type with connection parameters of the database
	 * @return	object $db A connection object for the database
	 */
  public function isValid() {
    if(count($_GET) === 0 || (!isset($_GET['c']) && !isset($_GET['m']))) {
      throw new InvalidArgumentException('Url must containt \'c\' and \'m\' params...');
      exit;
    }
    $c = strtolower($_GET['c']);
    $m = strtolower($_GET['m']);
    if(array_key_exists($c, $this->action)) {
      if(!array_key_exists($m, $this->action[$c]['methods'])) {
        throw new InvalidArgumentException('Param \'m\' is not in the allowed list');
        exit;  
      }
      global $class;
      global $method;
      $class = $this->action[$c]['map'];
      $method = $this->action[$c]['methods'][$m]['map'];
    } else {
      throw new InvalidArgumentException('Param \'c\' is not in the allowed list');
      exit;
    }
  }
}
  
?>