<?php
/**
 * User AUTHENTICATION library. Handles user login and logout, as well as secure
 * password hashing.
 *
 * Based on Kohana's AUTH library and Fred Wu's AuthLite library:
 *
 * @package     Auth
 * @author      Kohana Team
 * @copyright   (c) 2007 Kohana Team
 * @license     http://kohanaphp.com/license.html
 *
 * @package     Layerful
 * @subpackage  Modules
 * @author      Layerful Team <http://layerful.org/>
 * @author      Fred Wu <fred@beyondcoding.com>
 * @copyright   BeyondCoding
 * @license     http://layerful.org/license MIT
 * @since       0.3.0
 */
abstract class A1_Core {

	protected $_name;
	protected $_config;
	protected $_cookie_key;

	public $_sess;

	/**
	 * Return a static instance of A1.
	 *
	 * @return  object
	 */
	public static function instance($_name = 'a1')
	{
		static $_instances;

		if ( ! isset($_instances[$_name]))
		{
			$_config = Kohana::config($_name);
			$_driver = isset($_config['driver']) ? $_config['driver'] : 'ORM';
			$_class  = 'A1_' . ucfirst($_driver);

			$_instances[$_name] = new $_class($_name, $_config);
		}

		return $_instances[$_name];
	}

	/**
	 * Loads Session and configuration options.
	 *
	 * @return  void
	 */
	protected function __construct($_name = 'a1', $_config)
	{
		$this->_name       = $_name;
		$this->_config     = $_config;
		$this->_sess       = Session::instance( $this->_config['session_type'] );

		$cookie = isset($this->_config['cookie_key'])
			? $this->_config['cookie_key']
			: 'a1_{name}_autologin';

		$this->_cookie_key = strtr($cookie, array('{name}' => $this->_name));


		// Generate session key
		$this->_config['session_key'] = 'a1_' . $this->_name;
	}

	/**
	 * Returns TRUE is a user is currently logged in
	 *
	 * @return  boolean
	 */
	public function logged_in()
	{
		return is_object($this->get_user());
	}

	/**
	 * Returns the user - if any
	 *
	 * @return  object / FALSE
	 */
	public function get_user()
	{
		// Get the user from the session
		$user = $this->_sess->get($this->_config['session_key']);

		// User found in session, return
		if ( is_object($user))
		{
			if ( $user->loaded())
			{
				return $user;
			}
			else
			{
				// reloading failed - user is deleted but still exists in session
				// logout (so session & cookie are cleared)
				$this->logout();
				return FALSE;
			}
		}

		// Look for user in cookie
		if ( $this->_config['lifetime'])
		{
			if ( ($token = cookie::get($this->_cookie_key)))
			{
				$token = explode('.',$token);

				if ( count($token) === 2 && is_string($token[0]) && !empty($token[1]))
				{
					// Search user on user ID (indexed) and token
					$user = $this->_load_user_by_token($token);

					// Found user, complete login and return
					if ( $user->loaded())
					{
						return $this->complete_login($user,TRUE);
					}
				}
			}
		}

		// No user found, return false
		return FALSE;
	}

	protected function complete_login($user, $remember = FALSE)
	{
		if ( $remember === TRUE && $this->_config['lifetime'])
		{
			// Create token
			$token = text::random('alnum', 32);

			$user->{$this->_config['columns']['token']} = $token;

			cookie::set($this->_cookie_key, $this->_create_user_token($user, $token), $this->_config['lifetime']);
		}

		if ( isset($this->_config['columns']['last_login']))
		{
			$user->{$this->_config['columns']['last_login']} = time();
		}

		if ( isset($this->_config['columns']['logins']))
		{
			$user->{$this->_config['columns']['logins']}++;
		}

		//$this->_save_user($user);

		// Regenerate session (prevents session fixation attacks)
		$this->_sess->regenerate();

		$this->_sess->set($this->_config['session_key'], $user);
		$this->_sess->set($this->_config['session_acl_key'], $this->_config['acl']);

		return $user;
	}
	
	public function get_acl(){
		return $this->_sess->get($this->_config['session_acl_key']);
	}

	/**
	 * Attempt to log in a user.
	 *
	 * @param   string   username to log in
	 * @param   string   password to check against
	 * @param   boolean  enable auto-login
	 * @return  mixed    user if succesfull, FALSE otherwise
	 */
	public function login($username, $password, $remember = FALSE)
	{
		if ( empty($password))
		{
			return FALSE;
		}

		$user = is_object($username)
			? $username
			: $this->_load_user($username);

		if ( $user->loaded())
		{
		
	
			if ( $password=== $user->{$this->_config['columns']['password']})
			{
				return $this->complete_login($user,$remember);
			}
		}

		return FALSE;
	}
	
	public function check_username($username){
		
		$user = is_object($username)
			? $username
			: $this->_load_user($username);

		if ( $user->loaded())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Log out a user by removing the related session variables.
	 *
	 * @param   boolean  completely destroy the session
	 * @return  boolean
	 */
	public function logout($destroy = FALSE)
	{
		if ( cookie::get($this->_cookie_key))
		{
			cookie::delete($this->_cookie_key);
		}

		if ($destroy === TRUE)
		{
			// Destroy the session completely
			$this->_sess->destroy();
		}
		else
		{
			// Remove the user from the session
			$this->_sess->delete($this->_config['session_key']);
			$this->_sess->delete($this->_config['session_acl_key']);

			// Regenerate session_id
			$this->_sess->regenerate();
		}

		return ! $this->logged_in();
	}

	/**
	 * Compiles a user token based on a token and the id value of the user
	 *
	 * @param   object   User object
	 * @param   string   Token
	 * @return  string   Token String
	 */
	protected function _create_user_token($user, $token)
	{
		return $token . '.' . $user->id;
	}

	/**
	 * Saves the user object
	 *
	 * @param   object   User object
	 * @return  void
	 */
	protected function _save_user($user)
	{
		//$user->save();
	}

	/**
	 * Loads the user object from database using username
	 *
	 * @param   string   username
	 * @return  object   User Object
	 */
	abstract protected function _load_user($username);

	/**
	 * Loads the user object from database using the token (restored from cookie)
	 *
	 * @param   array   token (token and ID)
	 * @return  object  User Object
	 */
	abstract protected function _load_user_by_token(array $token);

} // End A1
