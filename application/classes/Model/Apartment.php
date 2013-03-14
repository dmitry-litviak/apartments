<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Apartment extends ORM {
        protected $_belongs_to = array(
		'type'   => array('model' => 'Type'),
                'owner'    => array(
                        'model'         => 'User',
                        'foreign_key' 	=> 'user_id',
                        ),
	);
}