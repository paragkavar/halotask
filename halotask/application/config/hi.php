<?php

return array(
    
	/*
	 * The Authentication library to use
	 * Make sure that the library supports:
	 * 1) A get_user method that returns FALSE when no user is logged in
	 *	  and a user object that implements Acl_Role_Interface when a user is logged in
	 * 2) A static instance method to instantiate a Authentication object
	 *
	 * array(CLASS_NAME,array $arguments)
	 */
	'lib' => array(
		'class'  => 'A1', // (or AUTH)
		'params' => array('a1')
	),

	'exception' => FALSE,
	/**
	 * The ORM library you're using.
	 */
	'driver' => 'ORM',

	/**
	 * Set the auto-login (remember me) cookie lifetime, in seconds. The default
	 * lifetime is two weeks.
	 */
	'lifetime' => 1209600,

	/**
	 * User model
	 */
	'user_model' => 'Auth_Users',
 
	/**
	 * Table column names
	 */
	'columns' => array(
		'username'  => 'username',   //username
		'password'  => 'password',   //password
		'token'     => 'token',      //token
		'last_login'=> 'last_login', //last login (optional)
		'logins'    => 'logins'      //login count (optional)
	),

	/**
	 * Session type - native or database
	 */
	'session_type' => 'native',
	'session_key' => 'acl',

	/**
	 * Cookie name to store autologin token
	 *
	 * '{name}' will be replaced by the A1 instance name
	 */
	'cookie_key' => 'a1_{name}_autologin',
	

	/*
	 * The ACL Roles (String IDs are fine, use of ACL_Role_Interface objects also possible)
	 * Use: ROLE => PARENT(S) (make sure parent is defined as role itself before you use it as a parent)
	 */
	'roles' => array
	(
		'admin' => 'admin',
		'engineer' => 'engineer',
		'guest' => 'guest'
	),

	/*
	 * The name of the guest role 
	 * Used when no user is logged in.
	 */
	'guest_role' => 'guest',

	/*
	 * The ACL Resources (String IDs are fine, use of ACL_Resource_Interface objects also possible)
	 * Use: ROLE => PARENT (make sure parent is defined as resource itself before you use it as a parent)
	 */
	'resources' => array
	(
		'home' => NULL,
		'user' => NULL,
		'report' => NULL,
		'tasks' => NULL
	),

	/*
	 * The ACL Rules (Again, string IDs are fine, use of ACL_Role/Resource_Interface objects also possible)
	 * Split in allow rules and deny rules, one sub-array per rule:
		 array( ROLES, RESOURCES, PRIVILEGES, ASSERTION)
	 *
	 * Assertions are defined as follows :
			array(CLASS_NAME,$argument) // (only assertion objects that support (at most) 1 argument are supported
										//  if you need to give your assertion object several arguments, use an array)
	 */
	'rules' => array
	(
		'allow' => array
		(
			'admin1' => array(
				'role'      => 'admin',
				'resource'  => array('home','tasks','report','user'),
			    'privilege' => NULL
			),
			'user' => array(
			    'role'      => 'engineer',
			    'resource'  => array('home','tasks'),
			    'privilege' => NULL
		    ),
			'task_edit' => array(
			    'role'      => 'engineer',
			    'resource'  => 'tasks',
			    'privilege' => 'edit',
			    'assertion' => array('Acl_Assert_Argument', array('uid'=>'id')),
		    ),
			'user_edit' => array(
			    'role'      => 'engineer',
			    'resource'  => 'user',
			    'privilege' => 'profil',
			    'assertion' => array('Acl_Assert_Argument', array('id'=>'id')),
		    ),
			'engineer3' => array(
			    'role'      => 'engineer',
			    'resource'  => 'tasks',
			    'privilege' => 'edit',
			    'assertion' => array('Acl_Assert_Argument', array('uid'=>'id')),
		    ),
		),
		
		'deny' => array
		(
			'user' => array(
			    'role'      => 'engineer',
			    'resource'  => array('report','user')
		    )
		)
	)
	
);
