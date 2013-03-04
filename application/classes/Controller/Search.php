<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Search extends My_Layout_User_Logged_Controller {

    public function before()
    {
        parent::before();
        Helper_Mainmenu::setActiveItem('search');
    }

    public function action_index()
	{
        $this->setTitle('Search Page')
            ->view('search/index')
            ->render();
    }

}
