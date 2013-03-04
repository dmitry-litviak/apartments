<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Dashboard extends My_Layout_Admin_Controller {
        
    public function before()
	{
		parent::before();
        Helper_AdminSiteBar::setActiveItem('dashboard');
	}
        
	public function action_index()
	{
        $this->setTitle('Dashboard')
             ->view('admin/dashboard/index')
             ->render();
	}

} // End Admin Dashboard
