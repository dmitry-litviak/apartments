<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Image extends ORM {
        protected $_belongs_to = array(
                'apartment'    => array(
                        'model'         => 'Apartment',
                        'foreign_key' 	=> 'apartment_id',
                        ),
	);
}