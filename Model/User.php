<?php

class User extends AppModel {
    public $name = 'User';
    public $belongsTo = array('Group');
public $actsAs = array('Acl' => array('type' => 'requester','enabled' 
=> false));


public function beforeSave($options = array()) {
        $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);

        return true;
    }
 
   
public function parentNode() {
if (!$this->id && empty($this->data)) {
return null;
}
if (isset($this->data['User']['group_id'])) {
$groupId = $this->data['User']['group_id'];
} else {
$groupId = $this->field('group_id');
}
if (!$groupId) {
return null;
} else {
return array('Group' => array('id' => $groupId));
}
}


    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('superadmin', 'admin','user')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );
}
?>