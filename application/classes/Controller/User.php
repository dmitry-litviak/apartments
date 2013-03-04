<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends My_Layout_User_Logged_Controller {
    
    public function action_index()
	{
        $this->redirect('user/profile');
    }
        
	public function action_contact()
	{
        Helper_Mainmenu::setActiveItem('contact');
        Helper_Output::factory()->link_js('users/contact');
        $data['user'] = $this->logged_user;
        $this->setTitle('Contact')
             ->view('user/contact', $data)
             ->render();
	}
        
    public function action_profile()
	{
        Helper_Mainmenu::setActiveItem('profile');
        Helper_Output::factory()->link_css('datepicker')
                                ->link_js('libs/bootstrap-datepicker')
                                ->link_js('libs/jquery.ui.widget')
                                ->link_js('libs/jquery.iframe-transport')
                                ->link_js('libs/jquery.fileupload')
                                ->link_js('libs/jquery.validate.min')
                                ->link_js('users/save')
                                ;
        $data['logged_user']  = $this->logged_user;
        $this->setTitle('My Profile')
             ->view('user/profile', $data)
             ->render();
	}
        
    public function action_save()
	{
        if ($this->request->post())
        {
            try
            {
                ORM::factory('User_Profile')->update_profile($this->request->post('profile'), array_keys($this->request->post('profile')), $this->logged_user->user_profile->id);
                Helper_Alert::set_flash('Profile has been successfully updated');
            }
            catch (ORM_Validation_Exception $e)
            {
                Helper_Alert::setStatus('error');
                Helper_Alert::set_flash(Kohana::$config->load('errors')->get('001'));
            }
        }

        $this->redirect('user/profile');
	}
        
        
    public function action_request_callback()
    {
        if($this->request->is_ajax())
        {
            $res = Library_Mail::factory()->setFrom(array($this->logged_user->email => $this->logged_user->getFullName()))
                                          ->setSubject('Request Callback')
                                          ->setView('mailer/service/mail', $this->logged_user)
                                          ->send();

            Helper_Jsonresponse::render_json('success', null, $res);

        }else{
            $this->response->status(404);
        }
        #$this->redirect('user/contact');
    }

    //need simple action for add ssl secure protocol
    public function action_send_secure_message()
    {
        try
        {
            ORM::factory('User_Message')->save_message($this->request->post('message'));
            Helper_Alert::set_flash('Was send');
        }
        catch (ORM_Validation_Exception $e)
        {
            Helper_Alert::setStatus('error');
            Helper_Alert::set_flash($e->errors('User_Message'));
        }
        $this->redirect('user/contact');
    }
        
//        public function action_test(){
//                Mailer::factory('Service')->request(array(
//                'user'     => array(
//                        'email'         => $this->logged_user->email,
//                        'user_fullname' => $this->logged_user->getFullName(),
//                    )
//                ));
//                
//                $res = Library_Mail::factory()->setFrom(array($this->logged_user->email => $this->logged_user->getFullName()))
//                                       ->setSubject('Request Callback')
//                                       ->setView('mailer/service/mail', $this->logged_user)
//                                       ->send();
//                
//                               Helper_Jsonresponse::render_json('success', null, $res);
//                
//        }
        

} // End User Controller
