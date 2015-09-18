<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Errors extends Controller
  {
      public function action_index()
      {
          $styles = array(
			'css/style.css',
                        'css/ui-lightness/jquery-ui-1.7.2.custom.css',
                        'css/jquery.treeview.css',
		);
          $scripts = array(
                        'js/jquery.js',
			'js/jquery-1.3.2.min.js',
			'js/jquery-ui-1.7.2.custom.min.js',
			'js/ui.datepicker-id.js',
                        'js/jquery.treeview.js',
                        'js/jquery.cookie.js',
                        'js/jquery.watermarkinput.js',
                        'js/main.js',
		);
          $this->request->response = View::factory('errors')
                                     ->bind('styles', $styles)
                                     ->bind('scripts', $scripts);
      }
  }
  ?>