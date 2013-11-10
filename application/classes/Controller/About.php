<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_About extends My_Layout_User_Controller {

    public function before() {
        parent::before();
    }

    public function action_index() {
        Helper_Mainmenu::setActiveItem('about');
        $this->setTitle('About')
                ->view('about/index')
                ->render();
    }

}

// End Session Controller
