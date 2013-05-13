<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Session extends My_Layout_User_Controller {

    public function action_login() {
        Helper_Mainmenu::setActiveItem('sign_in');
        Helper_Output::factory()->link_js('libs/jquery.validate.min')
                ->link_js('session/login');
        if (Auth::instance()->logged_in()) {
            $this->redirect('home/index');
        } else {
            if ($this->request->post()) {
                try {
                    $status = Auth::instance()->login($this->request->post('email'), $this->request->post('password'));
                    $role = Auth::instance()->get_user()->roles->order_by('role_id', 'desc')->find()->name;
                    if ($status && $role != "owner") {
                        $this->redirect('/');
                    } else {
                        Auth::instance()->logout();
                        Helper_Alert::setStatus('error');
                        Helper_Alert::set_flash(Kohana::$config->load('errors')->get('004'));
                    }
                } catch (ErrorException $e) {
                    Helper_Alert::setStatus('error');
                    Helper_Alert::set_flash(Kohana::$config->load('errors')->get('001'));
                }
            }
        }
        $this->setTitle('User Login')->view('session/login')->render();
    }

    public function action_create() {
        Helper_Mainmenu::setActiveItem('register');
        Helper_Output::factory()->link_js('libs/jquery.validate.min')
                ->link_js('session/register');
        if ($this->request->post()) {
            $model = ORM::factory('User');
            $post = Helper_Output::clean($this->request->post());
            try {
                $model->values($post);
                $model->save();
                $model->add('roles', ORM::factory('Role')->where('name', '=', 'login')->find());
                Auth::instance()->login($this->request->post('email'), $this->request->post('password'));
                ORM::factory('Application')->values(array(
                    "name" => $model->first_name . " " . $model->last_name,
                    "email" => $model->email,
                    "user_id" => $model->id
                ))->save();
                $this->redirect('/');
            } catch (ORM_Validation_Exception $e) {
                Helper_Alert::setStatus('error');
                Helper_Alert::set_flash($e->errors('User'));
            }
        }
        $this->setTitle('Create Account')
                ->view('session/register')
                ->render();
    }

    public function action_logout() {
        if (Auth::instance()->logout()) {
            $this->redirect('/');
        } else {
            Helper_Alert::setStatus('error');
            Helper_Alert::set_flash(Kohana::$config->load('errors')->get('002'));
        }
    }

}

// End Session Controller
