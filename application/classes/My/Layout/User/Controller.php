<?php defined('SYSPATH') or die('No direct script access.');

class My_Layout_User_Controller extends My_Layout_Controller
{
	public function before()
	{
		parent::before();
		//choose main template
//                if (Auth::instance()->logged_in()) {
//                    $this->redirect('search/index');
//                }

                Helper_Output::factory()
                                        ->link_js('libs/bootstrap-dropdown')
                                        ->link_js('libs/bootstrap-collapse')
                                        ->link_js('application')
                                        ->link_css('main')
                                        ;
	}
        
}
