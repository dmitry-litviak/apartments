<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Alerts extends My_Layout_User_Logged_Controller {

    public function before() {
        parent::before();
    }
    
    public function action_index()
    {
        Helper_Mainmenu::setActiveItem('alerts');
        Helper_Output::factory()
                        ->link_css('jquery-ui-1.8.16.custom');
        $data['alerts'] = $this->logged_user->alerts->find_all();
        $this->setTitle('Alerts Page')
             ->view('alerts/index', $data)
             ->render();
    }
    
    public function action_delete()
    {
        DB::delete('alerts')->where('id', '=', $this->request->param('id'))->where('user_id', '=', $this->logged_user->id)->execute();
        $this->redirect('alerts');
    }
    
    public function action_save() {
        if ($this->request->post()) {
            $post = Helper_Output::clean($this->request->post());
//            Helper_Main::print_flex($post);die;
            $model = ORM::factory('Alert');
            $model->title = $post['title'];
            $model->user_id = $this->logged_user->id;
            $model->count = $post['count'];
            $model->search = $post['options']['search'];
            $model->from = $post['options']['from'];
            $model->to = $post['options']['to'];
            $model->lat = $post['options']['lat'];
            $model->lng = $post['options']['lng'];
            $model->type_id = html_entity_decode($post['options']['type_id']);
            $model->save();
            Helper_Jsonresponse::render_json('success', "", "");
        } else {
            Helper_Jsonresponse::render_json('error', "", "");
        }
    }

} 
