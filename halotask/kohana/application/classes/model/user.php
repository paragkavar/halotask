<?php

class Model_User extends ORM{

	protected $_table_name = 'users';
	protected $_primary_key = 'id';

	protected $_has_many = array('roles' => array('model' => 'role', 'through' => 'roles_users'));
	
	//	The rules of 'users' table
	protected $_rules = array(
		'username' => array(
            'not_empty' => NULL
		),
		
		'role' => array(
            'not_empty' => NULL
		),
		'fullname' => array(
            'not_empty' => NULL
		),
		'password' => array(
            'not_empty' => NULL
		),
		'email' => array(
            'not_empty' => NULL,
			'regex'		=> array('/[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}/')
		),
	);	

	/*
		Validate the inserted values before adding to database
	*/
	public function validate_create(&$array) {
		$array = Validate::factory($array)
                        ->filter(TRUE, 'trim')
                        ->rules('username', $this->_rules['username'])
                         ->rules('fullname', $this->_rules['fullname'])
                          ->rules('role', $this->_rules['role'])
                        ->rules('password', $this->_rules['password'])
                        ->rules('email', $this->_rules['email']);
        return $array;
	}
	
	/*
		Validate the inserted values before adding to database
		@param	: array of inserted values
	*/
    public function validate_edit(&$array) {
        $array = Validate::factory($array)
                        ->filter(TRUE, 'trim')
                        ->rules('username', $this->_rules['username'])
                        ->rules('fullname', $this->_rules['fullname'])
                        ->rules('email', $this->_rules['email']);
        return $array;
    }
	
	/*
		Check if an username of user is already exist in database.
	*/
    public function username_available(Validate $array, $field)
    {
        $hasil = (bool) DB::select(array('COUNT("*")', 'total_count'))
                        ->from($this->_table_name)
                        ->where('username', '=', $array[$field])
                        ->execute($this->_db)
                        ->get('total_count');
        if ( $hasil )
        {
            $array->error($field, 'username');
        }
    }
	
	/*
		Check if an email of user is already exist in database.
	*/
    public function email_available(Validate $array, $field)
    {
        $hasil = (bool) DB::select(array('COUNT("*")', 'total_count'))
                        ->from($this->_table_name)
                        ->where('email', '=', $array[$field])
                        ->execute($this->_db)
                        ->get('total_count');
        if ($hasil)
        {
            $array->error($field, 'email');
        }
    }
	
	/*
		View all of users
		use for pagination in view page.
		@param	: limit
		@param	: offset
	*/
	public function view_all($limit, $offset){
		return ORM::factory('user')->limit($limit)->offset($offset)->find_all();
	}
	
	/*
		Count all users of application in database.
	*/
	public function count_user(){
		return ORM::factory('user')->count_all();
	}
	
	/*
		View user data
		@param	: id
	*/
	public function view($id){
		return $this
				->where('id', '=', $id)
				->find();
	}
	
	/*
		Create new user to database
		@param	: user_name
		@param	: user_pass
		@param	: user_email
	*/
	public function create($user_name,$fullname,$role, $user_pass, $user_email){
		$user = $this;
		$user->username = $user_name;
		$user->fullname = $fullname;
		$user->role = $role;
		$user->password = md5($user_pass);
		$user->email	= $user_email;
		$user->logins	= 0;
		$user->last_login = date('Y-m-d');
		$user->save();
	}
	
	/*
		Update  the user data to database
		@param	: id
		@param	: user_name
		@param	: user_pass
		@param	: user_email
	*/
	public function update($user_name,$fullname,$password,$user_email){
		$user = $this;
		$user->username = $user_name;
		$user->fullname = $fullname;
		$user->password = $password;
		$user->email	= $user_email;
		$user->save();
	}
	
	public function edit_password($id, $user_pass){
		$user = ORM::factory('user', $id);
		$user->password = md5($user_pass);
		$user->save();
	}
	
	/*
		Delete a user data from database
		@param	: id
	*/
	public function delete_user($id){
		$user = ORM::factory('user', $id);
		$user->state = 'Inactive';
		$user->save();
	}
	
	/*
		Get all users of application in database.
	*/
	public function get_all_users(){
		return ORM::factory('user')->find_all();
	}
	/*
		Get the last user id from database
	*/
	public function get_last_id(){
		$user_count = ORM::factory('user')->count_all();
		$all_user = $this->get_all_users();
		$last_id = 0;
		
		$i = 0;
		foreach( $all_user as $users ) :
			if ( $i == ($user_count - 1) ) :
				$last_id = $users->id;
			endif;
			$i++;
		endforeach;
		
		return $last_id;
	}
}

?>
