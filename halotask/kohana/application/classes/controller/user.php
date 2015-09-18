<?php

defined('SYSPATH') or die('No direct script access.');


class Controller_User extends Controller_Template_Default{
	protected $_controller = 'user';
	/**
	 * Action Index
	 */
	public function before()
    {
        parent::before();
		$this->template->title = 'Users';
        View::bind_global('controller',  $this->_controller);	
    }
    
    protected function _list()
    {
        	$model = new Model_User();
		
		// Get the total count of user records in the database
		$count = $model->count_user();
		
		// Create an instance of Pagination class and set values
		$pagination = Pagination::factory(array(
				'total_items'    => $count,
			));
		
		// Load specific results for current page
		$users = $model->view_all($pagination->items_per_page, $pagination->offset);

		// Render the pagination links
		$page_links = $pagination->render();

		$role_model = new Model_Role();
		$role_result = $role_model->get_all_roles();
		$selection_role = array('admin'=>'admin','engineer'=>'engineer');
		
		$this->template->content = View::factory('user/list')
			->bind('controller', $this->controller)
			->bind('users', $users)
			->bind('page_links', $page_links)
			->bind('selection_role', $selection_role)
			->bind('data', $data );
    }
    
	
	public function action_index()
	{		
		$this->template->subtitle = 'User - List';
		if($_POST){
		    $model = new Model_User();
		
			$form = $model->validate_create($_POST);
		
			if($form->check()){
				$model->create(
						$_POST['username'],
						
						$_POST['fullname'],
						$_POST['role'],
						$_POST['password'],
						$_POST['email']);
					
				$last_user_id = $model->get_last_id();

				$this->_list();
			}
			else{
				$data =  $form->as_array();
				$errors =  $form->errors('user-add');
				$this->_list();
				$this->template->content->bind( 'errors', $errors )
						->bind( 'data', $data );
			}
		}else{
		    $this->_list();
		}
	}
	

 	public function action_edit($id=null){
		$this->template->subtitle = 'User - Edit';
		$model = new Model_User();
		if($_POST/*&& $this->_user->allowed('user','edit')*/){
		    $uid = $this->_user->id;
		    if(isset($_POST['uid']) /*&& $this->_user->allowed('task')*/){
		        $uid = $_POST['uid'];
		    }
		    $data = $model->view($uid);
		    if(!empty($_POST['password'])) {
			$password = md5($_POST['password']);
		}else{
			$password =   $data->password;			
		}
		    $form = $model->validate_edit($_POST);
			if($form->check()){
				
				$model->update(
						$_POST['username'],
						$_POST['fullname'],
						$password,
						$_POST['email']);
				$data = $model->view($id);
		   		$data->password = ''; 
				$edited = true;
				$this->template->content = View::factory('user/edit')
					->bind('selection_role', $selection_role)
					->bind('edited', $edited )
					->bind('data', $data );
				//Request::instance()->redirect(URL::base() . $this->controller);
			}
			else{
				$this->template->subtitle = 'Edit User';
				$data =  $form;
				$errors =  $form->errors('user/edit');
				$this->template->content = View::factory('user/edit')
						->bind( 'errors', $errors )
						->bind( 'id', $errors )
						->bind( 'data', $data );
			}
		}else{
		    $data = $model->view($id);
		    $data->password = ''; 
		    /*

		    $data['project'] = $data->project;
		    $data['activity'] = $data->activity;
		    $data['hours'] = $data->hours;

		    $data['achievement'] = $data->achievement;
		    $data['uid'] = $data->uid;
		    $data['date'] = $data->date;

		    */
		    $this->template->content = View::factory('user/edit')
			->bind('selection_role', $selection_role)
			->bind('data', $data );
		}
	}

	public function action_passwd($id=null){
		$this->template->subtitle = 'User - Change Password';
		$model = new Model_User();
		if($_POST/*&& $this->_user->allowed('user','edit')*/){
		    $uid = $this->_user->id;
		   
		    $data = $model->view($uid);
		    if(!empty($_POST['password'])) {
			$password = md5($_POST['password']);
		}else{
			$password =   $data->password;			
		}
		    $form = $model->validate_edit($_POST);
			if($form->check()){
				
				$model->change_password(
						$password);
				$data = $model->view($id);
		   		$data->password = ''; 
				$this->template->content = View::factory('user/passwd')
					->bind('data', $data );
				//Request::instance()->redirect(URL::base() . $this->controller);
			}
			else{
				$this->template->subtitle = 'Change Password';
				$data =  $form;
				$errors =  $form->errors('user/passwd');
				$this->template->content = View::factory('user/passwd')
					->bind('data', $data );
			}
		}else{
		    $data = $model->view($id);
		    $data->password = ''; 
		    /*


		    $data['project'] = $data->project;
		    $data['activity'] = $data->activity;
		    $data['hours'] = $data->hours;


		    $data['achievement'] = $data->achievement;
		    $data['uid'] = $data->uid;
		    $data['date'] = $data->date;


		    */
		    $this->template->content = View::factory('user/passwd')
			->bind('data', $data );
		}
	}
		
	/*
	public function action_add(){
		$this->template->subtitle = 'Task - Add';
		if($_POST){
		    $uid = $this->_user->id;
		    if(isset($_POST['uid']) && $this->_user->allowed('task')){
		        $uid = $_POST['uid'];
		    }
		    $model = new Model_Tasks();
		    $date = $_POST['date'];
		    if($date>date('Y-m-d')) {
		        $errors['invalid-date'] =  'invalid date';
		        $this->template->content = View::factory('task/add')
						->bind( 'errors', $errors )
						->bind( 'data', $data );
				return;
		    }
		    $data = array_merge($_POST,
		                        array(
		                            $uid,
		                            $date
		                            ));
		    $form = $model->validate_create($data);
			if($form->check()){
				$model->create(
						$_POST['project'],
						$_POST['activity'],
						$_POST['hours'],
						$_POST['achievement'],
						$uid,
						$date);
                
				Request::instance()->redirect(URL::base() . $this->controller);
			}
			else{
				$this->template->title = 'HI - Hour Registration';
				$this->template->subtitle = 'Add Task/Activity';
				$data =  $form->as_array();
				$errors =  $form->errors('task-add');
				$this->template->content = View::factory('task/add')
						->bind( 'errors', $errors )
						->bind( 'data', $data );
			}
		}else{
		    $this->template->content = View::factory('task/add')
									->bind('data', $data );
		}
	}
	*/

	
	public function action_delete($id)
	{
		$model = new Model_User();
		$result = $model->delete($id);
		
		Request::instance()->redirect(URL::base() . $this->controller);	
	}
	
	
}

?>
