<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Favorite extends ORM {
	protected $_has_many = array(
		'users' => array('model' => 'User','through' => 'apartments_users'),
	);
        
    
}