<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Apartments extends My_Layout_User_Logged_Controller {

    public function before() {
        parent::before();
    }

    public function action_index() {
        Helper_Mainmenu::setActiveItem('apartments');
        Helper_Output::factory()->link_css('bootstrap.fileupload.min')
                ->link_css('jquery-ui-1.8.16.custom')
                ->link_js('libs/bootstrap.fileupload.min')
                ->link_js('apartments/index');
        $data['apartments'] = ORM::factory('Apartment')->where('user_id', '=', $this->logged_user->id)->find_all();
        $this->setTitle('Apartments Page')
                ->view('apartments/index', $data)
                ->render();
    }

    public function action_create() {
        Helper_Mainmenu::setActiveItem('apartments');
        Helper_Output::factory()->link_css('bootstrap.fileupload.min')
                ->link_css('jquery-ui-1.8.16.custom')
//                ->link_js('libs/bootstrap.fileupload.min')
                ->link_js('libs/jquery.validate.min')
                ->link_js('libs/jquery.fileupload')
                ->link_js('libs/jquery.fileupload-ui')
                ->link_js('libs/jquery.fileupload-fp')
                ->link_js('libs/underscore')
                ->link_js('public/assets/workspace')
                ->link_js('apartments/create');
        if ($this->request->post()) {
            $post = Helper_Output::clean($this->request->post());
            $post['user_id'] = $this->logged_user->id;
            $model = ORM::factory('Apartment');
            try {
                $model->values($post);
                $model->save();
                if (!empty($post['images'])) {
                    Helper_Uploader::save_gallery_images($model, $post['images']);
                }
                $this->redirect('apartments');
            } catch (ORM_Validation_Exception $e) {
                Helper_Alert::setStatus('error');
                Helper_Alert::set_flash($e->errors('User'));
            }
        }
        $data['types'] = ORM::factory('Type')->find_all();
        $this->setTitle('Apartments Create Page')
                ->view('apartments/create', $data)
                ->render();
    }

    public function action_edit() {
        $apartment = ORM::factory('Apartment')->where('id', '=', $this->request->param('id'))->find();
        $data['images'] = ORM::factory('Image')->where('apartment_id', '=', $apartment->id)->find_all();
        if ($this->logged_user->id == $apartment->user_id) {
            Helper_Mainmenu::setActiveItem('apartments');
            Helper_Output::factory()->link_css('bootstrap.fileupload.min')
                    ->link_css('jquery-ui-1.8.16.custom')
                    ->link_css('fancybox/jquery.fancybox-1.3.4')
                    ->link_js('libs/jquery.validate.min')
                    ->link_js('libs/jquery.fileupload')
                    ->link_js('libs/jquery.fileupload-ui')
                    ->link_js('libs/jquery.fileupload-fp')
                    ->link_js('libs/underscore')
                    ->link_js('public/assets/workspace')
                    ->link_js('libs/fancybox/jquery.fancybox-1.3.4_patch')
                    ->link_js('apartments/create');
            if ($this->request->post()) {
                $post = Helper_Output::clean($this->request->post());
                $post['user_id'] = $this->logged_user->id;
                $model = ORM::factory('Apartment', $this->request->param('id'));
                try {
                    $model->values($post);
                    $model->save();
                    if (!empty($post['images'])) {
                        Helper_Uploader::save_gallery_images($model, $post['images']);
                    }
                    $this->redirect('apartments');
                } catch (ORM_Validation_Exception $e) {
                    Helper_Alert::setStatus('error');
                    Helper_Alert::set_flash($e->errors('User'));
                }
            }
            $data['apartment'] = $apartment;
            $data['types'] = ORM::factory('Type')->find_all();
            $this->setTitle('Apartments Edit Page')
                    ->view('apartments/edit', $data)
                    ->render();
        } else {
            $this->redirect('apartments');
        }
    }

    public function action_delete() {
        $apartment = ORM::factory('Apartment')->where('id', '=', $this->request->post('id'))->find();
        if ($this->logged_user->id == $apartment->user_id) {
            @unlink(Kohana::$config->load('config')->get('apartments_files') . $apartment->id . '/photos/' . $apartment->img);
            @unlink(Kohana::$config->load('config')->get('apartments_files') . $apartment->id . '/photos/small_' . $apartment->img);
            $apartment->delete();
            Helper_Jsonresponse::render_json('success', '', '');
        } else {
            Helper_Jsonresponse::render_json('error', '', '');
        }
    }

}

