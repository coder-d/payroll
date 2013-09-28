<?php

App::uses('AppController', 'Controller');

class GroupsController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Groups';
	var $uses = array();
	
public $helpers = array('Html', 'Form', 'Session','Js' => array('Jquery'));
public $components = array('Session','RequestHandler','Fileupload');	

public function beforeFilter() {
parent::beforeFilter();
        $this->Auth->allow('add');
    }
function add() {
       if ($this->request->is('post')) {
            $this->Group->create();
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash(__('The group has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The group could not be saved. Please, try again.'));
            }
        }
    }


}
?>