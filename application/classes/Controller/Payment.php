<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Payment extends My_Layout_User_Controller {

    public function before() {
        parent::before();
        $key = Kohana::$config->load('stripe')->get('test');
        
        Stripe::setApiKey($key['secret_key']);
    }

    public function action_index() {
        Helper_Output::factory()
                ->link_js('libs/stripe')
                ->link_js('payment/index')
        ;
        if ($this->request->query('hash')) {
            $data['hash'] = $this->request->query('hash');
            $key = Kohana::$config->load('stripe')->get('test');
            $data['key'] = $key['publishable_key'];
            $this->setTitle('Payment')
                    ->view('payment/index', $data)
                    ->render();
        } else {
            $this->redirect("/");
        }
    }

    public function action_pay() {
        if ($this->request->post()) {
            $sending = ORM::factory('Send')->where('hash', '=', $this->request->post('hash'))->find();
            $application = ORM::factory('Application', $sending->application_id);
            $owner = ORM::factory('User', $sending->user_id);
            $token = $_POST['stripeToken'];

            $customer = Stripe_Customer::create(array(
                        'email' => $owner->email,
                        'card' => $token
            ));

            $charge = Stripe_Charge::create(array(
                        'customer' => $customer->id,
                        'amount' => 400,
                        'currency' => 'usd'
            ));
            Library_Mail::factory()
                    ->setFrom(array('0' => 'noreply@' . URL::base()))
                    ->setTo(array('0' => $owner->email))
                    ->setSubject('New Application')
                    ->setView('mail/application_paid', array(
                        'application' => $application,
                        'owner' => $owner,
                        'sending' => $sending,
                    ))
                    ->send();
            $this->setTitle('Thanks')
                    ->view('payment/thanks')
                    ->render();
        } else {
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
    }

}

// End Home Controller
