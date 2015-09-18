<?php

defined('SYSPATH') or die('No direct script access.');

/**
 *
 *
 * @copyright 2010
 * @author Rizky Zulkarnaen
 * @package api
 * @modified Okt 19, 2010
 */
class Controller_Unsri_Api extends Controller {

    public function __construct() {
        header('Content-type: text/xml');
        parent::__construct();
    }

    public function __call($entity, $params) {
        $entity = ORM::factory($entity, $params[0]);

        $get = $this->input->get();
        $post = $this->input->post();

        if (count($post) == 0) {
            return $this->get($entity);
        } else {

            switch ($post['action']) {
                case 'delete':
                    $this->delete($entity);
                    break;

                case 'update':
                    $this->update($entity, $post);
                    break;

                case 'create':
                    $this->create($entity, $params[0], $post);
                    break;

                default:
                //throw an error
            }
        }
    }

    protected function get(ORM $entity) {

    }

    protected function update(ORM $entity, Array $post) {

    }

    protected function create(ORM $entity, $identifier, Array $post) {

    }

    public function delete() {
        
    }

}

