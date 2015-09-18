<?php
defined('SYSPATH') or die('No direct script access.');
/**
 *
 *
 * @copyright 2010
 * @author Muhammad Arifin Siregar
 * @package search
 * @modified Oct 1, 2010
 */

class Controller_Search extends Controller_Template_Default {

    public function action_index(){
        $this->template->title = 'Hasil Pencarian';
        $this->template->judul = 'Hasil Pencarian';
    }
}
?>
