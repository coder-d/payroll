<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
 
    public $components = array('Auth','Acl','Session','Cookie','RequestHandler');
 
function beforeFilter(){
$this->Auth->authorize = array(
        'Controller',
        'Actions' => array('actionPath' => 'controllers')
    );
$this->Auth->authenticate = array('Form' => array('fields' => array('username' => 'username', 'password' => 'password')));   
$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
$this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
$this->Auth->loginRedirect = array('controller' => 'employees', 'action' => 'employee_list');
     
        
    
//$this->Acl->Aco->create(array('parent_id' => null, 'alias' => 'controllers')); 
//$this->Acl->Aco->save(); 
 

}
 function isAuthorized($user) {
        // return false;
        return $this->Auth->loggedIn();
    }


}
?>