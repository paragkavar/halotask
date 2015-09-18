<?php
defined('SYSPATH') or die('No Direct Script Access allowed');

/*
	File Name 		: login.php
	Type			: Controller
	Author		: Samuel Oloan Raja Napitupulu
	Modified		: 22 October 2010
	Description	: 	Controller of login
					this function of controller has been taken by Controller_Auth (auth.php)
*/
class Controller_Login extends Controller_Template_Default{
	
	protected $controller = 'login';
	
	public function action_index(){
		// sets the title of page.
        $this->template->title = 'Sistem Informasi Manajemen User Universitas Sriwijaya';
		$this->template->subtitle = 'LOG IN';
		
        $this->template->content = View::factory('login')
									->bind('controller', $this->controller);
	}
}

?>