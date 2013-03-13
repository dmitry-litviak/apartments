<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Favorites extends My_Layout_User_Logged_Controller {

    public function before() {
        parent::before();
//        $role = Auth::instance()->get_user()->roles->order_by('role_id', 'desc')->find()->name;
//        if ($role == 'owner' && $role != "admin")
//            $this->redirect('');
    }
    
    public function action_index()
    {
        Helper_Mainmenu::setActiveItem('favorites');
        Helper_Output::factory()
                        ->link_css('jquery-ui-1.8.16.custom');
        $data['apartments'] = $this->logged_user->apartments->find_all();
        $this->setTitle('Favorites Page')
             ->view('favorites/index', $data)
             ->render();
    }
    
    public function action_delete()
    {
        DB::delete('apartments_users')->where('apartment_id', '=', $this->request->param('id'))->where('user_id', '=', $this->logged_user->id)->execute();
        $this->redirect('favorites');
    }

} 
