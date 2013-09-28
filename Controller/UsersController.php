<?php

class UsersController extends AppController {
    
    
    public $name = 'Users';
	
public $helpers = array('Html', 'Form', 'Session','Js' => array('Jquery'));	


 public function beforeFilter() {
 	
        parent::beforeFilter();
        $this->Auth->allow('login', 'logout','initDB','add','build_acl');
    }
public function initDB() {
$group = $this->User->Group;
//Allow admins to everything
$group->id = 1;
$this->Acl->deny($group, 'controllers');
echo "all done 1";
//allow managers to posts and widgets
$group->id = 2;
$this->Acl->deny($group, 'controllers');
$this->Acl->allow($group, 'controllers/Employees');
echo "all done 2";
//allow users to only add and edit on posts and widgets
$group->id = 3;
$this->Acl->deny($group, 'controllers');
$this->Acl->allow($group, 'controllers/Employees/employee_list');
echo "all done 3";
//we add an exit to avoid an ugly "missing views" error message
echo "all done";

}

function add() {
       if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }
function  login(){
    
   if ($this->request->is('post')) {
      
        if ($this->Auth->login()) {
        $this->loginUser = AuthComponent::user();  // Here $this->loginUser is defined so we can get the user values here.
//$se=$this->Session->read('Auth');
//debug($se);

      return $this->redirect($this->Auth->redirect());

        } else {//debug($this->request);
            $this->set('invalid',1);
            $this->Session->setFlash(__('Invalid username or password, try again'));
            
        }
    }
   }
 public function logout() {
    $this->redirect($this->Auth->logout());
}  
 
function build_acl() {
    if (!Configure::read('debug')) {
        return $this->_stop();
    }
    $log = array();

    $aco = & $this->Acl->Aco;
    $root = $aco->node('controllers');
    if (!$root) {
        $aco->create(array('parent_id' => null, 'model' => null, 'alias' => 'controllers'));
        $root = $aco->save();
        $root['Aco']['id'] = $aco->id;
        $log[] = 'Created Aco node for controllers';
    } else {
        $root = $root[0];
    }

    App::uses('File', 'Utility');
    $ControllersFresh = App::objects('Controller');

    foreach ($ControllersFresh as $cnt) {
        $Controllers[] = str_replace('Controller', '', $cnt);
    }
    $appIndex = array_search('App', $Controllers);
    if ($appIndex !== false) {
        unset($Controllers[$appIndex]);
    }
    $baseMethods = get_class_methods('Controller');
    $baseMethods[] = 'build_acl';

    $appcontr = get_class_methods('AppController');

    foreach ($appcontr as $appc) {
        $baseMethods[] = $appc;
    }

    $baseMethods = array_unique($baseMethods);

    $Plugins = $this->_getPluginControllerNames();
    $Controllers = array_merge($Controllers, $Plugins);

    // look at each controller in app/controllers
    foreach ($Controllers as $ctrlName) {
        $methods = $this->_getClassMethods($this->_getPluginControllerPath($ctrlName));

        // Do all Plugins First
        if ($this->_isPlugin($ctrlName)) {
            $pluginNode = $aco->node('controllers/' . $this->_getPluginName($ctrlName));
            if (!$pluginNode) {
                $aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $this->_getPluginName($ctrlName)));
                $pluginNode = $aco->save();
                $pluginNode['Aco']['id'] = $aco->id;
                $log[] = 'Created Aco node for ' . $this->_getPluginName($ctrlName) . ' Plugin';
            }
        }
        // find / make controller node
        $controllerNode = $aco->node('controllers/' . $ctrlName);
        if (!$controllerNode) {
            if ($this->_isPlugin($ctrlName)) {
                $pluginNode = $aco->node('controllers/' . $this->_getPluginName($ctrlName));
                $aco->create(array('parent_id' => $pluginNode['0']['Aco']['id'], 'model' => null, 'alias' => $this->_getPluginControllerName($ctrlName)));
                $controllerNode = $aco->save();
                $controllerNode['Aco']['id'] = $aco->id;
                $log[] = 'Created Aco node for ' . $this->_getPluginControllerName($ctrlName) . ' ' . $this->_getPluginName($ctrlName) . ' Plugin Controller';
            } else {
                $aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $ctrlName));
                $controllerNode = $aco->save();
                $controllerNode['Aco']['id'] = $aco->id;
                $log[] = 'Created Aco node for ' . $ctrlName;
            }
        } else {
            $controllerNode = $controllerNode[0];
        }

        //clean the methods. to remove those in Controller and private actions.
        foreach ($methods as $k => $method) {
            if (strpos($method, '_', 0) === 0) {
                unset($methods[$k]);
                continue;
            }
            if (in_array($method, $baseMethods)) {
                unset($methods[$k]);
                continue;
            }
            $methodNode = $aco->node('controllers/' . $ctrlName . '/' . $method);
            if (!$methodNode) {
                $aco->create(array('parent_id' => $controllerNode['Aco']['id'], 'model' => null, 'alias' => $method));
                $methodNode = $aco->save();
                $log[] = 'Created Aco node for ' . $method;
            }
        }
    }
    if (count($log) > 0) {
        debug($log);
    }

    exit;
}

function _getClassMethods($ctrlName = null) {
    if($this->_isPlugin($ctrlName)){
        App::uses($this->_getPluginControllerName ($ctrlName), $this->_getPluginName ($ctrlName). 'Controller');
    }
    else
        App::uses($ctrlName . 'Controller', 'Controller');


    if (strlen(strstr($ctrlName, '.')) > 0) {
        // plugin's controller
        $ctrlName = str_replace('Controller', '', $this->_getPluginControllerName ($ctrlName));
    }
    $ctrlclass = $ctrlName . 'Controller';
    $methods = get_class_methods($ctrlclass);

    // Add scaffold defaults if scaffolds are being used
    $properties = get_class_vars($ctrlclass);
    if (array_key_exists('scaffold', $properties)) {
        if ($properties['scaffold'] == 'admin') {
            $methods = array_merge($methods, array('admin_add', 'admin_edit', 'admin_index', 'admin_view', 'admin_delete'));
        } else {
            $methods = array_merge($methods, array('add', 'edit', 'index', 'view', 'delete'));
        }
    }
    return $methods;
}

function _isPlugin($ctrlName = null) {
    $arr = String::tokenize($ctrlName, '.');
    if (count($arr) > 1) {
        return true;
    } else {
        return false;
    }
}

function _getPluginControllerPath($ctrlName = null) {
    $arr = String::tokenize($ctrlName, '/');
    if (count($arr) == 2) {
        return $arr[0] . '.' . $arr[1];
    } else {
        return $arr[0];
    }
}

function _getPluginName($ctrlName = null) {
    $arr = String::tokenize($ctrlName, '.');
    if (count($arr) == 2) {
        return $arr[0];
    } else {
        return false;
    }
}

function _getPluginControllerName($ctrlName = null) {
    $arr = String::tokenize($ctrlName, '/');
    if (count($arr) == 2) {
        return $arr[1];
    } else {
        return false;
    }
}

/**
 * Get the names of the plugin controllers ...
 *
 * This function will get an array of the plugin controller names, and
 * also makes sure the controllers are available for us to get the
 * method names by doing an App::import for each plugin controller.
 *
 * @return array of plugin names.
 *
 *
 */
function _getPluginControllerNames() {
    App::uses('Folder', 'Utility');
    $folder = & new Folder();
    $folder->cd(APP . 'Plugin');

    // Get the list of plugins
    $Plugins = $folder->read();
    $Plugins = $Plugins[0];
    $arr = array();

    // Loop through the plugins
    foreach ($Plugins as $pluginName) {
        // Change directory to the plugin
        $didCD = $folder->cd(APP . 'Plugin' . DS . $pluginName . DS . 'Controller');
        if ($didCD) {
            // Get a list of the files that have a file name that ends
            // with controller.php
            $files = $folder->findRecursive('.*Controller\.php');

            // Loop through the controllers we found in the plugins directory
            foreach ($files as $fileName) {
                // Get the base file name
                $file = basename($fileName);

                // Get the controller name
                //$file = Inflector::camelize(substr($file, 0, strlen($file) - strlen('Controller.php')));
                if (!preg_match('/^' . Inflector::humanize($pluginName) . 'App/', $file)) {
                    $file = str_replace('.php', '', $file);

                    /// Now prepend the Plugin name ...
                    // This is required to allow us to fetch the method names.
                    $arr[] = Inflector::humanize($pluginName) . "." . $file;
                }

            }
        }
    }


    return $arr;
    }
    

}?>