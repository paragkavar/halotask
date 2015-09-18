<?php
defined('SYSPATH') or die('No direct script access.');

 class Controller_Template_Default extends Auth
  {
     protected $_ajax = FALSE;

    public $template = 'template';

    public function before()
    {
        html::$windowed_urls = TRUE;

		parent::before();

		if (Request::$is_ajax OR $this->request !== Request::instance())
		{
				$this->_ajax = TRUE;
		}

		$this->template->title		= 'Default';
                $this->template->subtitle	= 'Default';
                // $this->template->content 	= 'home';
		$this->template->content 	= '';
                $this->template->menu 	= View::factory('menu');
		$this->template->styles = array(
			'css/style.css',
                        'css/ui-lightness/jquery-ui-1.7.2.custom.css',
                        'css/jquery.treeview.css',
		);
		$this->template->scripts = array(
                        'js/jquery.js',
			'js/jquery-1.3.2.min.js',
			'js/jquery-ui-1.7.2.custom.min.js',
			'js/ui.datepicker-id.js',
                        'js/jquery.treeview.js',
                        'js/jquery.cookie.js',
                        'js/jquery.watermarkinput.js',
                        'js/main.js',
		);
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
