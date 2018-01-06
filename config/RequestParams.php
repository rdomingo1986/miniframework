<?php
/**
 * RequestParams Class
 *
 * Data for connection database.
 *
 * @author	Domingo Ramirez
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://github.com/rdomingo1986
 */
class RequestParams {

  /**
	 * An array with the api definition for url params validation.
	 *
	 * @var	array
	 */
  public $action;

  /**
	 * Class constructor
	 *
	 * Init action param. 
   * 
	 * @return void
	 */
  public function __construct() {
    $this->action = array(
      'persons' => array(
        'map' => 'Persons',
        'methods' => array(
          'list_all' => array(
            'map' => 'listAll'
          ),
          'insert_one' => array(
            'map' => 'insertOne'
          ),
          'select_one' => array(
            'map' => 'selectOne',
            'validations' => array(
              'id' => array(
                'on_request' => true,
                'origin' => '_GET',
                'pre_format' => 'trim',
                'output_format' => 'trim',
                'rules' => 'required|integer'
              )
            )
          ),
          'update_one' => array(
            'map' => 'updateOne'
          ),
          'delete_one' => array(
            'map' => 'deleteOne'
          )
        )
      ),
    );
  }
}
?>