<?php
defined('SYSPATH') or die('No direct script access allowed');

/*
	File Name 		: home.php
	Type			: Controller
	Author		: Rizky Zulkarnaen
	Description	: 	Controller of index page
					use to render the index page of user management application
*/

class Controller_Home extends Controller_Template_Default{

	public function action_index(){
		// sets the title of page.
        $this->template->title = 'HI - Hours Registration';
		$this->template->subtitle = 'HOME';
		
        $this->template->content = View::factory('home');
	}
}
?>
