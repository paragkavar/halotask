<?php

defined('SYSPATH') or die('No direct script access.');


class Controller_Tasks extends Controller_Template_Default{
	protected $_controller = 'tasks';
	/**
	 * Action Index
	 */
	public function before()
    {
        parent::before();
		$this->template->title = 'Tasks';
        View::bind_global('controller',  $this->_controller);	
    }
    
    protected function _list($uid,$date)
    {
        $model = new Model_Tasks();
		$tasklist = $model->get_by_uid_date($uid,$date);
		//$daterange = $model->get_date_range_by_uid($uid);
		$selection_hours = array(1,2,3,4,5,6,7,8,9,10,11,12);
		$this->template->content = View::factory('task/list')
		                            ->bind('tasklist', $tasklist)
		                            ->bind('errors', $errors )
		                            ->bind('date',$date)
		                            ->bind('selection_hours',$selection_hours)
		                            //->bind('date',$daterange)
		                            ->bind('data', $data );
    }
    
	
	public function action_index()
	{		
		$this->template->subtitle = 'Task - List';
		$date = date('Y-m-d');
		if(isset($_REQUEST['date'])){
		    $date = $_REQUEST['date'];
		    if($date>date('Y-m-d')) {
		        $errors['invalid-date'] =  'invalid date';
		        $date = date('Y-m-d');
		    }
		}
		if($_POST){
		    $uid = $this->_user->id;
		    if(isset($_POST['uid']) /*&& $this->_user->allowed('task')*/){
		        $uid = $_POST['uid'];
		    }
		    $model = new Model_Tasks();
		    $date = $_POST['date'];
		    if($date>date('Y-m-d')) {
		        $errors['invalid-date'] =  'invalid date';
		        $this->_list($this->_user->id,$date);
		        $this->template->content = View::factory('task/add')
		                ->bind('date',$date)
						->bind('errors', $errors )
						->bind('data', $data );
				return;
		    }
		    $data = array_merge($_POST,
		                        array(
		                            'uid'=>$uid,
					                'uid_modified'=>$this->_user->id,
		                            'date'=>$date
		                            ));
		    $form = $model->validate_create($data);
			if($form->check()){
				$model->create(
						$_POST['project'],
						$_POST['activity'],
						$_POST['hours'],
						$_POST['achievement'],
						$uid,
						$this->_user->id,
						$date);
				$added = true;
				$this->_list($this->_user->id,$date);
				$this->template->content->bind('added', $added);
			}
			else{
				$data =  $form->as_array();
				$errors =  $form->errors('task-add');
				$this->_list($this->_user->id,$date);
				$this->template->content->bind( 'errors', $errors )
						->bind('data', $data );
			}
		}else{
		    $this->_list($this->_user->id,$date);
		}
	}
	

 	public function action_edit($id=null){
		$this->template->subtitle = 'Task - Edit';
		$model = new Model_Tasks();
		if($_POST){
		    $data = $model->view($_POST['id']);
		    
		    $form = $model->validate_edit(array_merge($_POST,array('uid_modified'=>$this->_user->id)));
		    $uid = $this->_user->id;
		    if(isset($_POST['uid']) /*&& $this->_user->allowed('task')*/){
		        $uid = $_POST['uid'];
		    }
			if($form->check()){
				$model->update(
				        $id,
						$_POST['project'],
						$_POST['activity'],
						$_POST['hours'],
						$_POST['achievement'],
						$uid,$this->_user->id);
                
				Request::instance()->redirect(URL::base() . $this->controller);
			}
			else{
				$this->template->title = 'HI - Hour Registration';
				$this->template->subtitle = 'Edit Task/Activity';
				$data =  $form;
				$errors =  $form->errors('task-edit');
				$this->template->content = View::factory('task/edit')
						->bind( 'errors', $errors )
						->bind( 'data', $data );
			}
		}else{
		    $data = $model->view($id);
		    /*

		    $data['project'] = $data->project;
		    $data['activity'] = $data->activity;
		    $data['hours'] = $data->hours;

		    $data['achievement'] = $data->achievement;
		    $data['uid'] = $data->uid;
		    $data['date'] = $data->date;

		    */
		    $this->template->content = View::factory('task/edit')
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
		$model = new Model_Tasks();
		$result = $model->delete($id);
		
		Request::instance()->redirect(URL::base() . $this->controller);	
	}
	
	
}

?>
