<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Apartments extends My_Layout_Admin_Controller {
    
    public function before()
	{
		parent::before();
        Helper_AdminSiteBar::setActiveItem('apartments');
	}
        
    
	public function action_index()
	{
        Helper_Output::factory()
                      ->link_js('libs/jquery.dataTables.min')
                      ->link_js('admin/apartments/index')
                      ->link_js('libs/jquery.dataTables.pagination');

        $this->setTitle('Users')
             ->view('admin/apartments/index')
             ->render();
	}
        
public function action_create()
    {
        Helper_Output::factory()->link_css('bootstrap.fileupload.min')
                                ->link_css('jquery-ui-1.8.16.custom')
                                ->link_js('libs/bootstrap.fileupload.min')
                                ->link_js('libs/jquery.validate.min')
                                ->link_js('admin/apartments/create');
        if ($this->request->post()) { 
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
                $this->redirect('admin/apartments');
            }
            catch (ORM_Validation_Exception $e) {
                Helper_Alert::setStatus('error');
                Helper_Alert::set_flash($e->errors('User'));
            }
        }
        $data['types'] = ORM::factory('Type')->find_all();
        $this->setTitle('Apartments Create Page')
             ->view('admin/apartments/create', $data)
             ->render();
    }
    
    public function action_edit()
    {
        $apartment = ORM::factory('Apartment')->where('id', '=', $this->request->param('id'))->find();
        Helper_Mainmenu::setActiveItem('apartments');
        Helper_Output::factory()->link_css('bootstrap.fileupload.min')
                                ->link_css('jquery-ui-1.8.16.custom')
                                ->link_js('libs/jquery.validate.min')
                                ->link_js('libs/bootstrap.fileupload.min')
                                ->link_js('admin/apartments/create');
        if ($this->request->post()) { 
            $post = Helper_Output::clean($this->request->post());
            $post['user_id'] = $this->logged_user->id;
            $model = ORM::factory('Apartment', $this->request->param('id'));
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
                $this->redirect('admin/apartments');
            }
            catch (ORM_Validation_Exception $e) {
                Helper_Alert::setStatus('error');
                Helper_Alert::set_flash($e->errors('User'));
            }
        }
        $data['apartment'] = $apartment;
        $data['types'] = ORM::factory('Type')->find_all();
        $this->setTitle('Apartments Edit Page')
             ->view('admin/apartments/edit', $data)
             ->render();
    }
    
    public function action_delete() {
        $apartment = ORM::factory('Apartment')->where('id', '=', $this->request->post('id'))->find();
        $apartment->delete();
        Helper_Jsonresponse::render_json('success', '' , '');
    }
    
    public function action_change_status() {
        $apartment = ORM::factory('Apartment')->where('id', '=', $this->request->post('id'))->find();
        $apartment->values(array('status' => ($apartment->status xor 1)));
        $apartment->save();
        Helper_Jsonresponse::render_json('success', '' , '');
    }



    public function action_getAjaxData()
    {
        $offset      = $this->request->query('iDisplayStart');
        $limit       = $this->request->query('iDisplayLength');
        $columns     =   array();
        $columns[]   =   'id';
        $columns[]   =   'photo';
        $columns[]   =   'title';
        $columns[]   =   'address';
        $columns[]   =   'descr';
        $columns[]   =   'cost';
        $columns[]   =   'status';

        $apartments = ORM::factory('Apartment');

        if ($this->request->query('sSearch'))
        {
            $apartments->where('address', 'like',  trim($this->request->query('sSearch')). '%');
        }

        $apartments = $apartments->limit($limit)->offset($offset)->order_by($columns[$this->request->query('iSortCol_0')], $this->request->query('sSortDir_0'))->find_all();

        $data['iTotalDisplayRecords'] =  ORM::factory('Apartment')->count_all();
        $data['iTotalRecords']        =  $data['iTotalDisplayRecords'];

        if(count($apartments))
        {
            foreach ($apartments as $apartment)
            {
                $tempArray    = array();
                $tempArray[]  = $apartment->id;
                $tempArray[]  = '<img class="small-image" src="' . Helper_Output::get_apartment($apartment, "small_") .'" />';
                $tempArray[]  = $apartment->title;
                $tempArray[]  = $apartment->address;
                $tempArray[]  = $apartment->descr;
                $tempArray[]  = '<span class="label label-success">$' . $apartment->cost . '</span>';
                $tempArray[]  = $apartment->status ? '<span class="label label-success status" data-id="'. $apartment->id .'">OK</span>' : '<span class="label label-important status" data-id="'. $apartment->id .'">Pending</span>';
                $tempArray[]  = '<a href="'.URL::site('admin/apartments/edit/'.$apartment->id).'" class="btn btn-small btn-primary"> Edit </a>
                                 <a class="btn btn-small btn-danger delete" data-id="' . $apartment->id . '">Delete</a>';

                $data['aaData'][] = $tempArray;
            }
        }
        else
        {
           $data['aaData'] = array();
        }

        echo json_encode($data);
    }

} // End Admin Users
