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
                ->link_js('libs/underscore')
                ->link_js('public/assets/workspace')
                ->link_js('search/map');
        if (!empty($_POST['type_id'])) {
            $_POST['type_id'] = json_encode($_POST['type_id']);
        }
        $this->setTitle('Map Page')
                ->view('search/map', $_POST)
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
        Helper_Jsonresponse::render_json('success', "", array("ap" => $apartment->as_array(),
            "email" => $apartment->owner->email,
            "images"=> DB::select()->from('images')->where('apartment_id', '=', $apartment->id)->execute()->as_array(),
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
