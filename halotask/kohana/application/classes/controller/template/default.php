<?php
defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @copyright 2011
 * @author Rizky Zulkarnaen
 * @package default_template
 */

 class Controller_Template_Default extends Controller_Template
  {
    protected $_ajax = FALSE;

    public $template = 'Default/template';
	protected $controller;
	protected $_a1;
	protected $_a2;
	protected $_user;

    public function before()
    {
        html::$windowed_urls = TRUE;

		parent::before();

		if (Request::$is_ajax OR $this->request !== Request::instance())
		{
				$this->_ajax = TRUE;
		}
		$this->template->styles = array(
			'css/style.css',
            'css/ui-lightness/jquery-ui-1.7.2.custom.css',
            'css/jquery.treeview.css',
		);
		$this->template->scripts = array(
            'js/jquery.js',
			'js/jquery-1.3.2.min.js',
			//'js/jquery-1.4.2.min.js',
			'js/jquery-ui-1.7.2.custom.min.js',
			'js/ui.datepicker-id.js',
            'js/jquery.treeview.js',
            'js/jquery.cookie.js',
            'js/jquery.watermarkinput.js',
            'js/main.js',
		);
		$this->_a2 = A2::instance('hi');
		$this->_a1 = $this->_a2->a1;
		$this->controller = Request::instance()->controller;
		$action = Request::instance()->action;
		$this->_user = $this->_a2->get_user();
		//var_dump($this->_a2->allowed('task'));exit;
		if(!$this->_user && $this->controller!='auth') {
			Request::instance()->redirect(URL::base() . 'auth/login');
			return;
		}else{
		    /*
		    if(!$this->_a2->allowed($this->controller)&& $this->controller!='login'){
			    Request::instance()->redirect(URL::base() . 'errors');
		    }
		    */
		    
		};
		$controllers = array(
			'home'=>'Home',
			'tasks'=>'Hour Registration',
			'report'=>'Report',
			'user'=>'User'
		);
		$menu = array();
		foreach($controllers as $c=>$text){
			//if($this->_a2->allowed($c)){
				$menu[$c] = $text;
			//}
		}
		$this->template->menu = $menu;
		
		$this->template->user_data = $this->_user;
	}

    public function after()
    {
        if ($this->_ajax === TRUE)
		{
            $this->request->response = $this->template->content;
		}
		else
		{
            parent::after();
		}
	}
 }

?>
