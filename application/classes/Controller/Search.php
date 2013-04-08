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
        Helper_Output::factory()->link_css('jquery-ui-1.8.16.custom')
                ->link_css('jquery.galleryview-3.0-dev')
                ->link_js('libs/underscore')
                ->link_js('libs/jquery.easing.1.3')
                ->link_js('libs/jquery.timers-1.2')
                ->link_js('libs/jquery.galleryview-3.0-dev')
                ->link_js('libs/jquery.validate.min')
                ->link_js('public/assets/workspace')
                ->link_js('search/map');
//        Helper_Main::print_flex($_GET);die;
        $_GET['sel_types'] = "";
        if (!empty($_GET['type_id'])) {
            if (count($_GET['type_id']) > 2) {
                $_GET['sel_types'] = implode(", ", $_GET['type_id']);
            } else {
                $_GET['sel_types'] = $_GET['type_id'][0];
            }
            $_GET['type_id'] = json_encode($_GET['type_id']);
        }

        if (empty($_GET['lng'])) {
            $_GET['lng'] = -110;
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
        if (Auth::instance()->logged_in()) {
            $user = Auth::instance()->get_user();
            $user_id = $user->id;
            $fav = DB::select()->from('apartments_users')->where('apartment_id', '=', $apartment->id)->where('user_id', '=', $user_id)->execute()->get('id');
        }
        $images = DB::select()->from('images')->where('apartment_id', '=', $apartment->id)->execute()->as_array();
        if (!count($images)) {
            $images[0]['name'] = URL::site('img/icon-no-image-512.png');
            $images[0]['id'] = '0';
        }
        Helper_Jsonresponse::render_json('success', "", array("ap" => $apartment->as_array(),
            "email" => $apartment->owner->email,
            "images" => $images,
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

}
