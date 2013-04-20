<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Search extends My_Layout_User_Controller {

    public function before() {
        parent::before();
        Helper_Mainmenu::setActiveItem('search');
    }

    public function action_index() {
        Helper_Output::factory()->link_css('jquery-ui-1.8.16.custom')
                ->link_js('libs/jquery.validate.min')
                ->link_js('search/index')
        ;
        $data['types'] = ORM::factory('Type')->find_all();
        $this->setTitle('Search Apartments')
                ->view('search/index', $data)
                ->render();
    }

    public function action_map() {
        Helper_Mainmenu::setActiveItem('map');
        Helper_Output::factory()->link_css('jquery-ui-1.8.16.custom')
                ->link_css('jquery.galleryview-3.0-dev')
                ->link_js('libs/underscore')
                ->link_js('libs/jquery.easing.1.3')
                ->link_js('libs/jquery.timers-1.2')
                ->link_js('libs/jquery.galleryview-3.0-dev')
                ->link_js('libs/jquery.validate.min')
                ->link_js('public/assets/workspace')
                ->link_js('search/map');
        $_GET['sel_types'] = "";
        if (!empty($_GET['type_id'])) {
            $_GET['sel_types'] = array();
            foreach ($_GET['type_id'] as $value) {
                $_GET['sel_types'][] = ORM::factory("Type", $value)->title;
            }
            if (count($_GET['type_id']) >= 2) {
                $_GET['sel_types'] = implode(", ", $_GET['sel_types']);
            } else {
                $_GET['sel_types'] = $_GET['sel_types'][0];
            }
            $_GET['type_id'] = json_encode($_GET['type_id']);
        }

        if (empty($_GET['lng'])) {
            $_GET['lng'] = -110;
        }

        if (empty($_GET['search'])) {
            $_GET['search'] = "";
        }

        if (empty($_GET['lat'])) {
            $_GET['lat'] = 52;
        }

        if (empty($_GET['from'])) {
            $_GET['from'] = "";
        }

        if (empty($_GET['to'])) {
            $_GET['to'] = "";
        }
        $_GET['types'] = ORM::factory('Type')->find_all();
        $this->setTitle('Map Page')
                ->view('search/map', $_GET)
                ->render();
    }

    public function action_get_markers() {
        $post = Helper_Output::clean($this->request->post());
        $types = json_decode($this->request->post('options.type_id'));
        $apartments = DB::select('id', 'lat', 'lng')->from('apartments')
                ->where('lat', '>', $post['options']['lat'] - 2)
                ->where('lat', '<', $post['options']['lat'] + 2)
                ->where('lng', '>', $post['options']['lng'] - 2)
                ->where('lng', '<', $post['options']['lng'] + 2);
        if (!empty($post['options']['from'])) {
            $apartments = $apartments->where('cost', '>', $post['options']['from']);
        }
        if (!empty($post['options']['to'])) {
            $apartments = $apartments->where('cost', '<', $post['options']['to']);
        }
        if (!empty($types)) {
            $apartments = $apartments->where_open();
            foreach ($types as $type_id) {
                $apartments = $apartments->or_where('type_id', '=', $type_id);
            }
            $apartments = $apartments->where_close();
        }
        $apartments = $apartments->where('status', '=', 1)->execute()->as_array();
        Helper_Jsonresponse::render_json('success', "", $apartments);
    }

    public function action_get_apartment() {
        $apartment = ORM::factory('Apartment', $this->request->post('id'));
        $apartment->img = Helper_Output::get_apartment($apartment, 'small_');
        $apartment->type_id = $apartment->type->title;
        $fav = 0;
        $user_id = 0;
        $application_id = 0;
        if (Auth::instance()->logged_in()) {
            $user = Auth::instance()->get_user();
            $user_id = $user->id;
            $fav = DB::select()->from('apartments_users')->where('apartment_id', '=', $apartment->id)->where('user_id', '=', $user_id)->execute()->get('id');
            $application_id = DB::select()->from('applications')->where('user_id', '=', Auth::instance()->get_user()->id)->execute()->get('id');
        }
        $images = DB::select()->from('images')->where('apartment_id', '=', $apartment->id)->execute()->as_array();
        if (!count($images)) {
            $images[0]['name'] = URL::site('img/icon-no-image-512.png');
            $images[0]['id'] = '0';
        }
        Helper_Jsonresponse::render_json('success', "", array("ap" => $apartment->as_array(),
            "email" => $apartment->owner->email,
            "images" => $images,
            "application_id" => $application_id,
            "fav" => array(
                "status" => $fav,
                "user_id" => $user_id,
            )
        ));
    }

    public function action_set_favorite() {
        DB::insert('apartments_users', array('apartment_id', 'user_id'))->values(array($this->request->post('id'), $this->request->post('user_id')))->execute();
        Helper_Jsonresponse::render_json('success', "", "");
    }

    public function action_set_send() {
        $owner = ORM::factory('User')->where('email', '=', $this->request->post('email'))->find();
        $sending = ORM::factory('Send')->where('application_id', '=', $this->request->post('application_id'))->find();
        if (empty($sending->id)) {
            DB::insert('sends', array('application_id', 'user_id', 'hash'))->values(array($this->request->post('application_id'), $owner->id, md5($owner->email . time())))->execute();
            Library_Mail::factory()
                    ->setFrom(array('0' => 'noreply@' . URL::base()))
                    ->setTo(array('0' => $owner->email))
                    ->setSubject('New Application')
                    ->setView('mail/application', array(
                        'application' => ORM::factory('Application', $this->request->post('application_id')),
                        'user' => Auth::instance()->get_user(),
                        'owner' => $owner
                    ))
                    ->send();
            Helper_Jsonresponse::render_json('success', "", "Sent");
        } else {
            Helper_Jsonresponse::render_json('success', "", "You already sent application for this ad");
        }
    }

}
