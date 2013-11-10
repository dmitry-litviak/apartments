<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Application extends ORM {
	protected $_belongs_to = array(
		'user' => array('model' => 'User'),
	);
        
}