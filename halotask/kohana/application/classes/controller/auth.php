<?php
defined('SYSPATH') or die('No Direct Script access allowed');

/**
 *
 *
 * @copyright 2011
 * @author Rizky Zulkarnaen
 */

class Controller_Auth extends Controller_Template_Default {
	
	public function before()
	{
		$this->template = 'Default/login';
		parent::before();
		$this->template->title = 'HI - Hours Registration';
		$this->template->subtitle = 'Login';
		
        $this->template->content = View::factory('auth')
		->bind('controller', $this->controller);
	}
	public function action_index()
	{
		// sets the title of page.
        
	}
	
	public function action_login()
	{
        $this->template->data = array
        (
            'username' => '',
			'password' => ''
        );
		$this->template->errors = $this->template->data;
		
		if($this->_user) //cannot create new accounts when a user is logged in
			return $this->action_index();

		$post = Validate::factory($_POST)
			->filter(TRUE,'trim')
			->rule('username', 'not_empty')
			->rule('username', 'min_length', array(3))
			->rule('username', 'max_length', array(127))
			->rule('password', 'not_empty');

		if($post->check())
		{
			$check_user = $this->_a1->check_username($post['username']);
			
			if($check_user){
				$hasil_login = $this->_a1->login($post['username'],md5($post['password']), isset($_POST['remember']) ? (bool) $_POST['remember'] : FALSE);
				
				if($hasil_login)
				{
					$this->request->redirect( 'home/index' );
				}
				else
				{
					$data = Arr::overwrite($this->template->data, $post->as_array());
					$errors = Arr::overwrite($this->template->errors, $post->errors('auth'));
					$errors['error_desc'] = 'username dan password tidak sesuai';
					$this->template->content = View::factory('auth')
											->bind('error_desc', $error_desc)
											->bind('controller', $this->controller)
											->bind('errors', $errors)
											->bind('data', $data);
				}
			}
			else
			{
				$data = Arr::overwrite($this->template->data, $post->as_array());
				$errors = Arr::overwrite($this->template->errors, $post->errors('auth'));
				$errors['error_desc'] = 'username tidak terdaftar';
				$this->template->content = View::factory('auth')
										->bind('error_desc', $error_desc)
										->bind('controller', $this->controller)
										->bind('errors', $errors)
										->bind('data', $data);
			}
		}
		else{
			$data = Arr::overwrite($this->template->data, $post->as_array());
			$errors = Arr::overwrite($this->template->errors, $post->errors('auth'));
			$this->template->content = View::factory('auth')
									->bind('controller', $this->controller)
									->bind('errors', $errors)
									->bind('data', $data);
		}
	}

	public function action_logout()
	{
		$this->_a1->logout();
		$this->_user = NULL;
		return $this->action_index();
	}
} 
