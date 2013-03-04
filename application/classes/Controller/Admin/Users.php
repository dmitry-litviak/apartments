<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Users extends My_Layout_Admin_Controller {
    
    public function before()
	{
		parent::before();
        Helper_AdminSiteBar::setActiveItem('users');
	}
        
    
	public function action_index()
	{
        Helper_Output::factory()
                      ->link_js('libs/jquery.dataTables.min')
                      ->link_js('admin/users/index')
                      ->link_js('libs/jquery.dataTables.pagination');

        $this->setTitle('Users')
             ->view('admin/users/index')
             ->render();
	}
        
    public function action_create()
    {
        if ($this->request->post()) {
            $model = ORM::factory('User');
            $profile = array(
                                'first_name' => $this->request->post('first_name'),
                                'last_name'   => $this->request->post('last_name')
                            );
            try {
                $model->values(array(
                                        'email'              => $this->request->post('email'),
                                        'password'           => $this->request->post('password'),
                                        'user_profile_id'    => ORM::factory('User_Profile')->create_profile($profile, array('first_name', 'last_name'))
                                    ));
                $model->save();
                $model->add('roles', ORM::factory('Role')->where('name', '=', 'login')->find());
                $this->redirect('admin/users');
            }
            catch (ORM_Validation_Exception $e) {
                Helper_Alert::setStatus('error');
                Helper_Alert::set_flash($e->errors('User'));
            }
        }
        $this->setTitle('Create User')
                ->view('admin/users/create')
                ->render();
    }

    public function action_edit(){
        $data["user"] = ORM::factory('User', $this->request->param('id'));

        if ($this->request->post()) {
            $data["user"] = ORM::factory('User', $this->request->post("id"));
            $profile = array(
                                "first_name" => $this->request->post('first_name'),
                                "last_name"   => $this->request->post('last_name')
                            );
            try {
                $data["user"]->values(array(
                                                "email"              => $this->request->post('email'),
                                                "password"           => $this->request->post('password'),
                                                "user_profile_id"    => ORM::factory('User_Profile')->create_profile($profile, array('first_name', 'last_name'))
                                            ));
                $data["user"]->save();
                $data["user"]->remove("roles");
                $data["user"]->add('roles', ORM::factory('Role', $this->request->post('role_id')));
                $this->redirect('admin/users/');
            }
            catch (ORM_Validation_Exception $e) {
                Helper_Alert::setStatus('error');
                Helper_Alert::set_flash($e->errors('User'));
            }
        }

        $this->setTitle('Edit User')
                ->view('admin/users/edit', $data)
                ->render();
    }



    public function action_getAjaxData()
    {
        $offset      = $this->request->query('iDisplayStart');
        $limit       = $this->request->query('iDisplayLength');
        $columns     =   array();
        $columns[]   =   'id';
        $columns[]   =   'email';
        $columns[]   =   'first_name';
        $columns[]   =   'last_name';
        $columns[]   =   'role';

        $users = ORM::factory('User');

        if ($this->request->query('sSearch'))
        {
            $users->where('email', 'like',  trim($this->request->query('sSearch')). '%');
        }

        $users = $users->limit($limit)->offset($offset)->order_by($columns[$this->request->query('iSortCol_0')], $this->request->query('sSortDir_0'))->find_all();

        $data['iTotalDisplayRecords'] =  ORM::factory('User')->count_all();
        $data['iTotalRecords']        =  $data['iTotalDisplayRecords'];

        if(count($users))
        {
            foreach ($users as $user)
            {
                $tempArray    = array();
                $tempArray[]  = $user->id;
                $tempArray[]  = $user->email;
                $tempArray[]  = $user->user_profile->first_name;
                $tempArray[]  = $user->user_profile->last_name;
                $role         = $user->roles->order_by('role_id', 'desc')->find()->name;
                $tempArray[]  = $role == 'admin' ? '<span class="label label-important">' . $role . '</span>' : '<span class="label label-info">' . $role . '</span>';
                $tempArray[]  = '<a href="'.URL::site('admin/users/edit/'.$user->id).'" class="btn btn-small btn-primary"> Edit </a>
                                 <a onclick="javascript:index.remove('.$user->id.', this)" class="btn btn-small btn-danger"> Remove </a>';

                $data['aaData'][] = $tempArray;
            }
        }
        else
        {
           $data['aaData'] = array();
        }

        echo json_encode($data);
    }

    public function action_delete()
    {
        ORM::factory('User', $this->request->post('id'))->delete();
        Helper_Jsonresponse::render_json('success', null);
    }

} // End Admin Users
