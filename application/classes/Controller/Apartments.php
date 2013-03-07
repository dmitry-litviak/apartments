<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Apartments extends My_Layout_User_Logged_Controller {

    public function action_index()
    {
        Helper_Mainmenu::setActiveItem('apartments');
        Helper_Output::factory()->link_css('bootstrap.fileupload.min')
                        ->link_css('jquery-ui-1.8.16.custom')
                        ->link_js('libs/bootstrap.fileupload.min')
                        ->link_js('apartments/index');
        $data['apartments'] = ORM::factory('Apartment')->find_all();
        $this->setTitle('Apartments Page')
             ->view('apartments/index', $data)
             ->render();
    }

    public function action_create()
    {
        Helper_Mainmenu::setActiveItem('apartments');
        Helper_Output::factory()->link_css('bootstrap.fileupload.min')
                                ->link_css('jquery-ui-1.8.16.custom')
                                ->link_js('libs/bootstrap.fileupload.min')
                                ->link_js('apartments/create');
        if ($this->request->post()) {
//            Helper_Main::print_flex($_POST);
//            Helper_Main::print_flex($_FILES);
//            die;    
            $post = Helper_Output::clean($this->request->post());
            $post['user_id'] = $this->logged_user->id;
            $model = ORM::factory('Apartment');
            try {
                $model->values($post);
                $model->save();
                if ($_FILES['image']['tmp_name']) {
                    $place_upload_dir = Kohana::$config->load('config')->get('apartments_files') . $model->id . '/photos/';
                    if(!is_dir($place_upload_dir))
                        mkdir($place_upload_dir, 0777, true);
                    $name   = basename(md5($_FILES['image']['name'].time())). '.' .pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $target = $place_upload_dir . $name;
                    move_uploaded_file($_FILES['image']['tmp_name'], $target);
                    $image_small = Image::factory($target)->resize(265, 265);
                    $image_small->save($place_upload_dir . 'small_' . $name);
                    $model->img = $name;
                    $model->save();
                }
                $this->redirect('apartments');
            }
            catch (ORM_Validation_Exception $e) {
                Helper_Alert::setStatus('error');
                Helper_Alert::set_flash($e->errors('User'));
            }
        }
        $data['types'] = ORM::factory('Type')->find_all();
        $this->setTitle('Apartments Create Page')
             ->view('apartments/create', $data)
             ->render();
    }
    
    public function action_delete() {
        $apartment = ORM::factory('Apartment')->where('id', '=', $this->request->post('id'))->find();
        if ($this->logged_user->id == $apartment->user_id) {
            $apartment->delete();
            Helper_Jsonresponse::render_json('success', '' , '');
        } else {
            Helper_Jsonresponse::render_json('error', '' , '');
        }
    }

} 
