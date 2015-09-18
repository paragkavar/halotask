<?php

class Model_Auth_Users extends Model_A1_User_ORM implements Acl_Role_Interface {

	protected $_table_name = 'users';
	protected $_primary_key = 'id';

	
	protected $_callbacks = array(
		'username' => array('username_available')
	);

	// Columns to ignore
	protected $_ignored_columns = array('password_confirm');
	
	public function get_role_id()
	{
		return $this->role;
	}
	
	public function get_username()
	{
		$this->username;
	}
	
	/**
	 * Tests if a username exists in the database. This can be used as a
	 * Valdidation callback.
	 *
	 * @param   object    Validate object
	 * @param   string    Field
	 * @param   array     Array with errors
	 * @return  array     (Updated) array with errors
	 */
	public function username_available(Validate $array, $field)
	{
		if ($this->loaded() AND $this->_object[$field] === $array[$field])
		{
			// This value is unchanged
			return TRUE;
		}

		if( ORM::factory($this->_user_model)->where($field,'=',$array[$field])->find_all(1)->count() )
		{
			$array->error($field,'username_available');
		}
	}
} // End User Model
