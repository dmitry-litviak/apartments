<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Apartments extends My_Layout_User_Controller {

    public function action_index()
    {
        Helper_Mainmenu::setActiveItem('apartments');
        $this->setTitle('Apartments Page')
             ->view('apartments/index')
             ->render();
    }

    public function action_create()
    {
        Helper_Mainmenu::setActiveItem('apartments');
        Helper_Output::factory()->link_css('bootstrap.fileupload.min')
                                ->link_js('libs/jquery.geocomplete.min')
                                ->link_js('libs/bootstrap.fileupload.min')
                                ->link_js('apartments/create');
        if ($this->request->post()) {
            Helper_Main::print_flex($_POST);
            Helper_Main::print_flex($_FILES);
            die;
        }
        $data['types'] = ORM::factory('Type')->find_all();
        $this->setTitle('Apartments Create Page')
             ->view('apartments/create', $data)
             ->render();
    }

} 
