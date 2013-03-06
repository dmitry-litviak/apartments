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
                                ->link_css('bootstrap.fileupload.min')
                                ->link_js('libs/bootstrap-datepicker')
                                ->link_js('libs/jquery.ui.widget')
                                ->link_js('libs/bootstrap.fileupload.min')
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
                if ($_FILES['avatar']['tmp_name']) {
                    $place_upload_dir = Kohana::$config->load('config')->get('user_files') . $this->logged_user->id . '/avatar/';
                    Helper_Output::clear_dir($place_upload_dir);
                    if(!is_dir($place_upload_dir))
                        mkdir($place_upload_dir, 0777, true);
                    $name   = basename(md5($_FILES['avatar']['name'].time())). '.' .pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                    $target = $place_upload_dir . $name;
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $target);
                    $image_small = Image::factory($target)->resize(265, 265);
                    $image_small->save($place_upload_dir . 'small_' . $name);
                    ORM::factory('User_Profile')->update_profile(array('avatar' => $name), array('avatar'), $this->logged_user->user_profile->id);
                }
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

} // End User Controller
