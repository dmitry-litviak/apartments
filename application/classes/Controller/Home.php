<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends My_Layout_User_Controller {

    public function action_index()
    {
        Helper_Output::factory()->link_css('jquery-ui-1.8.16.custom')
                ->link_js('libs/jquery.validate.min')
                ->link_js('search/index')
        ;
        $data['types'] = ORM::factory('Type')->find_all();
        $this->setTitle('Search Apartments')
                ->view('search/index', $data)
                ->render();
    }

} // End Home Controller
