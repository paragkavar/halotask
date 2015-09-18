<?php
defined('SYSPATH') or die('No direct script access allowed...');

/*
	File Name 		: role.php
	Type			: Controller
	Author		: Samuel Oloan Raja Napitupulu
	Modified		: 22 October 2010
	Description	: 	Controller of role
					use as the interface between the view and model of role.
*/
class Controller_Role extends Controller_Template_Default{

	public $controller = 'role';
	public $role_model;
	
	public function action_index(){
		// sets the title of page.
        $this->template->title = 'Sistem Informasi Manajemen User Universitas Sriwijaya';
		// sets the subtitle of page.
		$this->template->subtitle = 'ROLE';
		
		// make an instance of Model_Role
		$this->role_model = new Model_Role();
		
        // Get the total count of role records in the database
        $count = $this->role_model->count_all_roles();
		
        // Create an instance of Pagination class and set values
        $pagination = Pagination::factory(array(
			'total_items'    => $count,
		));
        // Load specific results for current page
        $result = $this->role_model->view_all($pagination->items_per_page, $pagination->offset);

        // Render the pagination links
		$page_links = $pagination->render();
	
		// the defined value of interal attributes of page.
		$btn_new = TRUE;
		
        $this->template->content = View::factory('role')
									->bind('btn_new', $btn_new)
									->bind('controller', $this->controller)
									->bind('result', $result)
									->bind('page_links', $page_links);
	}
	
	public function action_details($role_id){
		// sets the title of page.
        $this->template->title = 'Sistem Informasi Manajemen User Universitas Sriwijaya';
		// sets the subtitle of page.
		$this->template->subtitle = 'ROLE DETAIL';
		
		// make an instance of Model_Role
		$this->role_model = new Model_Role();
		
		// make an instance of Model_Privilege
		$privilege_model = new Model_Privilege();
		$role_privileges = $privilege_model->view_role_privileges($role_id);
		
		//make an instance of Model_Menu
		$menu_model = new Model_Menu();
		$menu_result = $menu_model->view_all();
		
		// make an instance of Model_Application
		$app_menu = new Model_Application();
		$app_result = $app_menu->view_all();
		
		// get data of selected role
		$role_data = $this->role_model->view_role_detail($role_id);
		$role_name = $role_data->name;
		$role_desc = $role_data->description;
		
        $this->template->content = View::factory('role-detail')
									->bind('role_privileges', $role_privileges)
									->bind('menu_result', $menu_result)
									->bind('app_result', $app_result)
									->bind('role_name', $role_name)
									->bind('role_desc', $role_desc);
		
	}
	
	public function action_edit($role_id){
		// sets the title of page.
        $this->template->title = 'Sistem Informasi Manajemen User Universitas Sriwijaya';
		// sets the subtitle of page.
		$this->template->subtitle = 'EDIT ROLE DATA';
		
		// make an instance of Model_Role
		$this->role_model = new Model_Role();
		
		// make an instance of Model_Privilege
		$privilege_model = new Model_Privilege();
		$role_privileges = $privilege_model->view_role_privileges($role_id);
		
		//make an instance of Model_Menu
		$menu_model = new Model_Menu();
		$menu_result = $menu_model->view_all();
		
		// make an instance of Model_Application
		$app_menu = new Model_Application();
		$app_result = $app_menu->view_all();
		
		// get data of selected role
		$role_data = $this->role_model->view_role_detail($role_id);
		$role_name = $role_data->name;
		$role_desc = $role_data->description;
		
        $this->template->content = View::factory('role-edit')
									->bind('role_id', $role_id)
									->bind('controller', $this->controller)
									->bind('role_privileges', $role_privileges)
									->bind('menu_result', $menu_result)
									->bind('app_result', $app_result)
									->bind('role_name', $role_name)
									->bind('role_desc', $role_desc);
	}
	
	public function action_save_edit($role_id){
		
        $this->template->data = array
        (
            'role_name' => '',
            'role_desc' => ''
        );
		$this->template->errors = $this->template->data;
		
		// make an instance of Model_Role
		$this->role_model = new Model_Role();
		
		// make an instance of Model_Privilege
		$privilege_model = new Model_Privilege();
		$role_privileges = $privilege_model->delete_role_privileges($role_id);
		
		//make an instance of Model_Menu
		$menu_model = new Model_Menu();
		$menu_result = $menu_model->view_all();
		$menu_count = $menu_model->count_menu();
		
		// make an instance of Model_Application
		$app_menu = new Model_Application();
		$app_result = $app_menu->view_all();
		
		foreach ($menu_result as $menus):
			$permission = '';
			$permission .= (isset($_POST['C' . $menus->menu_id])) ? 'C,' : '';
			$permission .= (isset($_POST['R' . $menus->menu_id])) ? 'R,' : '';
			$permission .= (isset($_POST['U' . $menus->menu_id])) ? 'U,' : '';
			$permission .= (isset($_POST['D' . $menus->menu_id])) ? 'D,' : '';
			$permission .= (isset($_POST['O' . $menus->menu_id])) ? 'O' : '';
			$privilege_model->create_privileges($role_id, $menus->menu_id, $permission);
		endforeach;
		
		$form = $this->role_model->validate_edit($_POST);
		
		if($form->check()){
			$this->role_model->update_role(
					$role_id,
					$_POST['role_name'],
					$_POST['role_desc']);
			Request::instance()->redirect(URL::base() . $this->controller);
		}
		else{
			$role_detail_result['role_name'] = $_POST['role_name'];
			$role_detail_result['role_desc'] = $_POST['role_desc'];
			$role_privileges = $privilege_model->view_role_privileges($role_id);
			$this->template->title = 'Sistem Informasi Manajemen User Universitas Sriwijaya';
			$this->template->subtitle = 'EDIT ROLE DATA';
			$data = Arr::overwrite($this->template->data, $form->as_array());
			$errors = Arr::overwrite($this->template->errors, $form->errors('role-edit'));
			
			$this->template->content = View::factory('role-edit')
									->bind('role_id', $role_id)
									->bind('controller', $this->controller)
									->bind('role_privileges', $role_privileges)
									->bind('menu_result', $menu_result)
									->bind('app_result', $app_result)
									->bind('role_name', $role_name)
									->bind('role_desc', $role_desc)
									->bind('errors', $errors)
									->bind('data', $data)
									->bind( 'detail_result', $role_detail_result );
		}
	}
	
	public function action_new(){
		// sets the title of page.
        $this->template->title = 'Sistem Informasi Manajemen User Universitas Sriwijaya';
		// sets the subtitle of page.
		$this->template->subtitle = 'ADD NEW ROLE';
		
		//make an instance of Model_Menu
		$menu_model = new Model_Menu();
		$menu_result = $menu_model->view_all();
		
		// make an instance of Model_Application
		$app_menu = new Model_Application();
		$app_result = $app_menu->view_all();
		
        $this->template->content = View::factory('role-new')
									->bind('role_id', $role_id)
									->bind('controller', $this->controller)
									->bind('menu_result', $menu_result)
									->bind('app_result', $app_result);
	}
	
	public function action_save_new(){
		
        $this->template->data = array
        (
            'role_name' => '',
            'role_desc' => ''
        );
		$this->template->errors = $this->template->data;
		
		// make an instance of Model_Role
		$this->role_model = new Model_Role();
		
		// make an instance of Model_Privilege
		$privilege_model = new Model_Privilege();
		
		//make an instance of Model_Menu
		$menu_model = new Model_Menu();
		$menu_result = $menu_model->view_all();
		$menu_count = $menu_model->count_menu();
		
		// make an instance of Model_Application
		$app_menu = new Model_Application();
		$app_result = $app_menu->view_all();
		
		$permissions = array();
		foreach ($menu_result as $menus):
			$permissions[$menus->menu_id] = '';
			$permissions[$menus->menu_id] .= (isset($_POST['C' . $menus->menu_id])) ? 'C,' : '';
			$permissions[$menus->menu_id] .= (isset($_POST['R' . $menus->menu_id])) ? 'R,' : '';
			$permissions[$menus->menu_id] .= (isset($_POST['U' . $menus->menu_id])) ? 'U,' : '';
			$permissions[$menus->menu_id] .= (isset($_POST['D' . $menus->menu_id])) ? 'D,' : '';
			$permissions[$menus->menu_id] .= (isset($_POST['O' . $menus->menu_id])) ? 'O' : '';
		endforeach;
		
		$form = $this->role_model->validate_create($_POST);
		
		if($form->check()){
			$this->role_model->create_role(
					$_POST['role_name'],
					$_POST['role_desc']);
						
			$last_role_id = $this->role_model->get_last_role_id();
			foreach ($menu_result as $menus):
				$privilege_model->create_privileges($last_role_id, $menus->menu_id, $permissions[$menus->menu_id]);
			endforeach;
		
			Request::instance()->redirect(URL::base() . $this->controller);
		}
		else{
			$role_detail_result['role_name'] = $_POST['role_name'];
			$role_detail_result['role_desc'] = $_POST['role_desc'];
			$this->template->title = 'Sistem Informasi Manajemen User Universitas Sriwijaya';
			$this->template->subtitle = 'EDIT ROLE DATA';
			$data = Arr::overwrite($this->template->data, $form->as_array());
			$errors = Arr::overwrite($this->template->errors, $form->errors('role-new'));
			
			$this->template->content = View::factory('role-new')
									->bind('role_id', $role_id)
									->bind('controller', $this->controller)
									->bind('menu_result', $menu_result)
									->bind('app_result', $app_result)
									->bind('errors', $errors)
									->bind('data', $data)
									->bind( 'detail_result', $role_detail_result );
		}
	}
	
	public function action_delete($role_id){
		// make an instance of Model_Role
		$this->role_model = new Model_Role();
		$result = $this->role_model->delete_role($role_id);
		// make an instance of Model_Privilege
		$privilege_model = new Model_Privilege();
		$result = $privilege_model->delete_role_privileges($role_id);
		
		Request::instance()->redirect(URL::base() . $this->controller);
	}
}

?>