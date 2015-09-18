<?php

/*
	File Name 		: role-user.php
	Type			: Model
	Author		: Samuel Oloan Raja Napitupulu
	Modified		: 10 October 2010
	Description	: use for modelling the 'roles_users' table from database.
				  add and delete a role from a user and vice versa.
*/

class Model_RoleUser extends ORM{
	
	protected $_table_name = 'roles_users';
	protected $_primary_key = 'id';
	
	protected $_belongs_to = array('role' => array(), 'user' => array());
	
	/*
		Adding a new role to a user
		@param	: role_id
		@param	: user_id
	*/
	public function create_role_user($role_id, $user_id){
		$role_user = ORM::factory('roleuser');
		$role_user->role_id = $role_id;
		$role_user->user_id = $user_id;
		$role_user->save();
	}
	
	/*
		Delete all users of a role
		this function is used if there is a deleted role of user
		@param	: role_id
	*/
	public function delete_user_of_role($role_id){
		return ORM::delete($role_id)
					->where('role_id', '=', $role_id)
					->delete_all();
	}
	
	/*
		Delete all roles of a user
		this function is used if there is a deletion of a user and the updated role of a user
		@param	: role_id
	*/
	public function delete_role_of_user($user_id){
		return ORM::factory('roleuser')
					->where('user_id', '=', $user_id)
					->delete_all();
	}
}

?>