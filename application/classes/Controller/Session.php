<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Session extends My_Layout_Controller {

    public function action_login()
    {
        Helper_Mainmenu::setActiveItem('sign_in');
        if (Auth::instance()->logged_in()) {
            $this->redirect('home/index');
        } else {
            if ($this->request->post()) {
                $status = Auth::instance()->login($this->request->post('email'), $this->request->post('password'));
                if ($status) {
                    $this->redirect('/');
                } else {
                    Helper_Alert::setStatus('error');
                    Helper_Alert::set_flash(Kohana::$config->load('errors')->get('001'));
                }
            }
        }
        $this->setTitle('Sign In')->view('session/login')->render();
    }

    public function action_create()
    {
        Helper_Mainmenu::setActiveItem('create_account');
        if ($this->request->post()) {
            $model = ORM::factory('User');
            $profile = array(
                'first_name' => $this->request->post('first_name'),
                'last_name'  => $this->request->post('last_name')
            );
            try {
                $model->values(array(
                    'email'              => $this->request->post('email'),
                    'password'           => $this->request->post('password'),
                    'user_profile_id'    => ORM::factory('User_Profile')->create_profile($profile, array('first_name', 'last_name'))
                ));
                $model->save();
                $model->add('roles', ORM::factory('Role')->where('name', '=', 'login')->find());
                $this->redirect('/');
            }
            catch (ORM_Validation_Exception $e) {
                Helper_Alert::setStatus('error');
                Helper_Alert::set_flash($e->errors('User'));
            }
        }
        $this->setTitle('Create Account')
            ->view('session/register')
            ->render();
    }
            
    public function action_logout()
    {
        if (Auth::instance()->logout()) {
            $this->redirect('/');
        } else {
            Helper_Alert::setStatus('error');
            Helper_Alert::set_flash(Kohana::$config->load('errors')->get('002'));
        }
    }
        
} // End Session Controller
