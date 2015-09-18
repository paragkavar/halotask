<?php

defined('SYSPATH') or die('No direct script access.');


class Controller_Report extends Controller_Template_Default{
	protected $_controller = 'report';

	private function array_sort($array, $on, $order=SORT_ASC)
	{
	    $new_array = array();
	    $sortable_array = array();

	    if (count($array) > 0) {
		foreach ($array as $k => $v) {
		    if (is_array($v)) {
		        foreach ($v as $k2 => $v2) {
		            if ($k2 == $on) {
		                $sortable_array[$k] = $v2;
		            }
		        }
		    } else {
		        $sortable_array[$k] = $v;
		    }
		}

		switch ($order) {
		    case SORT_ASC:
		        asort($sortable_array);
		    break;
		    case SORT_DESC:
		        arsort($sortable_array);
		    break;
		}

		foreach ($sortable_array as $k => $v) {
		    $new_array[$k] = $array[$k];
		}
	    }

	    return $new_array;
	}
	public function before()
	    {
		parent::before();
			$this->template->title = 'Report';
		View::bind_global('controller',  $this->_controller);	
	    }
    
	
	public function action_index()
	{		
		$this->template->subtitle = 'Report - List';
		
		$date = date('Y-m-d',time()-24*3600);
		if(isset($_REQUEST['date'])){
		    $date = $_REQUEST['date'];
		    if($date>date('Y-m-d')) {
		        $errors['invalid-date'] =  'invalid date';
		        $date = date('Y-m-d');
		    }
		}
		$date2 = date('Y-m-d');
		if(isset($_REQUEST['date2'])){
		    $date2 = $_REQUEST['date2'];
		    if($date2>date('Y-m-d')) {
		        $errors['invalid-date'] =  'invalid date';
		        $date2 = date('Y-m-d');
		    }
		}
		if(isset($_REQUEST['uid'])){
		    $uid = $_REQUEST['uid'];
		}else{
		    $uid = 0;
		}

		//$daterange = $model->get_date_range_by_uid($uid);
		
		/*if(isset($_REQUEST['date'])){
		    $date = $_REQUEST['date'];
		    if($date>date('Y-m-d')) {
			$errors['invalid-date'] =  'invalid date';
			$date = date('Y-m-d');
		    }
		}
		*/
		$task = new Model_Tasks();
		$user = new Model_User();
		if($uid!=null){
			$tasklist = $task->get_by_uid($uid,array($date,$date2));
			/*
			$arr = array();
			foreach($tasklist as $task){
				$x = array();
				$x['id'] = $task->id;	
				$x['project'] = $task->project;
				$x['activity'] = $task->activity;
				$x['achievement'] = $task->achievement;
				$x['hours'] = $task->hours;
				$x['date'] = $task->date;
				$arr[] = $x;			
			}
			*/
		}
		else $uid=null;
		//$daterange = $model->get_date_range_by_uid($uid);
		$users = $user->get_all_users();
		$selection_user = array('0'=>'--select--');
		foreach($users as $u){
			if(!empty($u->fullname)){
				$user = array($u->id => $u->fullname);
			}else{
				$user = array($u->id => $u->username);			
			}
		      	$selection_user = array_merge($selection_user,$user);		
		};
		$selected_user = $uid;
		$this->template->content = View::factory('report/list')
	                    ->bind('tasklist', $tasklist)
	                    ->bind('errors', $errors )
		                            ->bind('date',$date)
				->bind('date2',$date2)
				 ->bind('uid',$uid)
				->bind('selected_user', $selected_user )
				->bind('selection_user', $selection_user );
	}
	
}

?>
