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

    public function action_test() {
//        $config = Kohana::$config->load('email');
//        $swift = email::connect($config);
//        $message = Swift_Message::newInstance();
//        $message->setSubject('hello')
//                ->setFrom(array('alex@example.com.au' => 'Alex'))
//                ->setTo(array('dmitry.litviak@gmail.com' => 'Dmitry'))
//                ->setBody('hello');
////
//        $swift->send($message);
//        $config = Kohana::$config->load('email');
//        $mailer = Email::connect($config);
//        $message = Swift_Message::newInstance("123123", "123123", 'text/html', 'utf-8');
//        $message->setTo("litvdim@gmail.com", "Dmitry");
//        $message->setFrom("no-reply@apartments.com", "Service");
//        $mailer->send($message);

//        $config = Kohana::$config->load('email');
//        Email::connect($config);
//
//        $to = 'dmitry.litviak@gmail.com';
//        $subject = 'Сообщение от Коханой..т.е. Коханы.';
//        $from = 'kohanaframework@test.ru';
//        $message = 'Проверка связи';
//        Email::send($to, $from, $subject, $message, $html = false);
//        Library_Mail::factory()->setFrom(array('0' => 'noreply@apartments.loc'))->setTo(array('0' => "litvdim@gmail.com"))->setSubject('Отпуск')->setView('mail/alert', array())->send();
    }

}

// End Session Controller
