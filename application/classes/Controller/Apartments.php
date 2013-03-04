<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Apartments extends My_Layout_User_Controller {

	public function action_index()
	{
        //go away from landing page if you logged in ;)
        if(Auth::instance()->logged_in())
            $this->redirect('search');


        $this->setTitle('Landing Page')
             ->view('home/index')
             ->render();
	}

    public function action_test(){
        phpinfo();
    }

} // End Home Controller
