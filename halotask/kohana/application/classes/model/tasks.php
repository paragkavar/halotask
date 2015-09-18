<?php

class Model_Tasks extends ORM{

	protected $_table_name = 'tasks';
	protected $_primary_key = 'id';
	protected $sorting= array('date'=>'asc');
	protected $_rules = array(
		'project' => array(
            'not_empty' => NULL
		),
		'activity' => array(
            'not_empty' => NULL
		),
		'hours' => array(
            'not_empty' => NULL
		),
		'achievement' => array(
            'not_empty' => NULL
		),
		'uid' => array(
            'not_empty' => NULL
		),
		'uid_modified' => array(
            'not_empty' => NULL
		),
		'date' => array(
            'not_empty' => NULL
		)
	);	
	
	/*
		Validate the inserted values before adding to database
	*/
	public function validate_create(&$array) {
		$array = Validate::factory($array)
                        ->filter(TRUE, 'trim')
                        ->rules('project', $this->_rules['project'])
                        ->rules('activity', $this->_rules['activity'])
                        
                        ->rules('hours', $this->_rules['hours'])
			->rules('achievement', $this->_rules['achievement'])
			->rules('uid', $this->_rules['uid'])
			->rules('uid_modified', $this->_rules['uid_modified'])
			->rules('date', $this->_rules['date']);
        return $array;
	}
	

    public function validate_edit(&$array) {
	    $array = Validate::factory($array)
                ->filter(TRUE, 'trim')
                ->rules('project', $this->_rules['project'])
                ->rules('activity', $this->_rules['activity'])
			    ->rules('achievement', $this->_rules['achievement'])
			    ->rules('uid_modified', $this->_rules['uid_modified'])
	            ->rules('hours', $this->_rules['hours']);
	    return $array;
    }
	
	
	public function view_all($limit, $offset){
		return $this->limit($limit)->offset($offset)->find_all();
	}

	public function count(){
		return $this->count_all();
	}
	
	public function view($id){
		return $this
				->where('id', '=', $id)
				->find();
	}

	public function create($project, $activity, $hours,$achievement,$uid,$uid_modified,$date){
		$this->project = $project;
		$this->activity	= $activity;
		$this->hours = $hours;
		$this->achievement = $achievement;
		$this->uid = $uid;
		$this->uid = $uid_modified;
		$this->date = $date;
		$this->save();
	}
	
	public function update($id, $project, $activity, $hours,$achievement,$uid,$uid_modified){
		$task = ORM::factory('tasks', $id);
		$this->project = $project;
		$this->activity	= $activity;
		$this->hours = $hours;
		$this->achievement = $achievement;
		$this->uid = $uid;
		$this->uid = $uid_modified;
		$this->save();
	}

	public function get_all(){
		return $this->find_all();
	}
	
	public function get_by_uid($uid,$date=array()){
	    $this->sorting = array('date'=>'asc');
	    if(count($date)){
	        $tasks = $this->where('uid','=', $uid)
	                    ->where('date','>=', $date[0])
	                    ->where('date','<=', $date[1])
	                     ->find_all();
	    }else{
	       $tasks = $this->where('uid','=', $uid)
	                    ->find_all();
	    }
	   return $tasks;
	}
	
	public function get_date_range_by_uid($uid){
	    $this->sorting = array('date'=>'asc');
	    $res = $this->where('uid','=', $uid)
	                ->find()->as_array();
	    $range['begin'] = $res['date'];
	    $range['end'] = date('Y-m-d');
		return $range;
	}

	public function get_by_uid_date($id,$date){
		return  $this
				->where('uid', '=', $id)
				->where('date', '=', $date)
				->find_all();
		/*
		$ret = $this
				->where('uid', '=', $id)
				->find_all();
		$arr = array();
		foreach($ret as $x){
		    $arr[] = array($x);
		}
		return $arr;
		*/
	}

}

?>
