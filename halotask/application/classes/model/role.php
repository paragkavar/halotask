<?php


class Model_Role extends ORM{
	
	protected $_table_name = 'roles';
	protected $_primary_key = 'id';
	
	protected $_has_many = array('users' => array('model' => 'user', 'through' => 'roles_users'));
	
	/*
		Rules of 'role' table
	*/
	protected $_rules = array(
		'name' => array(
            'not_empty' => NULL
		),
		'desc' => array(
            'not_empty' => NULL
		),
	);
	
	public function get_resource_id()
	{
		return 'role';
	}
	/*
		Validate the inserted values before adding to database
		@param	: array of inserted values
	*/
	public function validate_create(&$array) {
		$array = Validate::factory($array)
                        ->filter(TRUE, 'trim')
                        ->rules('name', $this->_rules['name'])
                        ->rules('desc', $this->_rules['desc'])
                        ->callback('name', array($this, 'name_available'));
        return $array;
	}
	
	/*
		Validate the inserted values before the data is updating to database
		@param	: array of inserted values
	*/
	public function validate_edit(&$array) {
		$array = Validate::factory($array)
                        ->filter(TRUE, 'trim')
                        ->rules('name', $this->_rules['name'])
                        ->rules('desc', $this->_rules['desc']);
        return $array;
	}
	
	/*
		Checking the inserted role name is already exist in role tabel or not.
	*/
    public function name_available(Validate $array, $field)
    {
        $hasil = (bool) DB::select(array('COUNT("*")', 'total_count'))
                        ->from($this->_table_name)
                        ->where('name', '=', $array[$field])
                        ->execute($this->_db)
                        ->get('total_count');
        if ( $hasil )
        {
            $array->error($field, 'name');
        }
    }
	
	/*
		Create a new role into database.
		@param 	: role name
		@param	: role description.
	*/
	public function create_role($name, $desc){
		$roles = ORM::factory('role');
		$roles->name = $name;
		$roles->description = $desc;
		$roles->save();
	}
	
	/*
		Create a new role into database.
		@param 	: role id
		@param 	: role name
		@param	: role description.
	*/
	public function update_role($role_id, $name, $desc){
		$roles = ORM::factory('role', $role_id);
		$roles->name = $name;
		$roles->description = $desc;
		$roles->save();
	}
	
	/*
		Create a new role into database.
		@param 	: role name
		@param	: role description.
	*/
	public function count_all_roles(){
		return ORM::factory('role')->count_all();
	}
	
	/*
		View all roles in database
		use for pagination in view.
		@param	: limit
		@param	: offset
	*/
	public function view_all($limit, $offset){
		return ORM::factory('role')->limit($limit)->offset($offset)->find_all();
	}
	
	/*
		View all roles in database
	*/
	public function get_all_roles(){
		return ORM::factory('role')->find_all()->as_array();
	}
	
	/*
		View a detail infornation about a role.
	*/
	public function view_role_detail($role_id){
		return ORM::factory('role')
				->where('role_id', '=', $role_id)
				->find();
	}
	
	/*
		Get the last id of roles
	*/
	public function get_last_role_id(){
		$role_count = $this->count_all_roles();
		$all_role = $this->get_all_roles();
		$last_id = 0;
		
		$i = 0;
		foreach( $all_role as $roles ) :
			if ( $i == ($role_count - 1) ) :
				$last_id = $roles->role_id;
			endif;
			$i++;
		endforeach;
		
		return $last_id;
	}
	
	/*
		Delete role according to it's id.
	*/
	public function delete_role($role_id){
		return ORM::delete($role_id);
	}	
}

?>
