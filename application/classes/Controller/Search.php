<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Search extends My_Layout_User_Logged_Controller {

    public function before()
    {
        parent::before();
        Helper_Mainmenu::setActiveItem('search');
    }

    public function action_index()
    {
        Helper_Output::factory()->link_css('jquery-ui-1.8.16.custom')
                                ->link_js('libs/jquery.validate.min')
                                ->link_js('search/index')
                                ;
        $data['types'] = ORM::factory('Type')->find_all();
        $this->setTitle('Search Page')
            ->view('search/index', $data)
            ->render();
    }
    public function action_map()
    {
        Helper_Output::factory()->link_css('jquery-ui-1.8.16.custom')
                                ->link_js('search/map');
        $_POST['type_id'] = json_encode($_POST['type_id']);
        $this->setTitle('Map Page')
            ->view('search/map', $_POST)
            ->render();
    }
    
    public function action_get_markers()
    {
        $post = Helper_Output::clean($this->request->post());
        $apartments = ORM::factory('Apartment')->where('lat', '>', $post['options']['lat'] - 2)
                                               ->where('lat', '<', $post['options']['lat'] + 2)
                                               ->where('lng', '>', $post['options']['lng'] - 2)
                                               ->where('lng', '<', $post['options']['lng'] + 2)
                                               ->find_all()->as_array();
        $data = array();
        foreach ($apartments as $apartment) {
            $data[] = $apartment->as_array();
        }
        Helper_Jsonresponse::render_json('success', "", $data);
    }

}
