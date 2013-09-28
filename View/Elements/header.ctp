<div class="top">
<div class="top_left">Company Logo Here</div>
<div class="top_right">
    <ul><?$user=$this->Session->read('Auth.User');?>
        <li>Signed in as :<?=$user['username'];?> ( <?if($user['role']==1)$status='Admin';else $status='Super Admin';echo $status;?> )</li>
        <li><?= $this->Html->link(
    'Change Password',
    array('controller' => 'super_admin', 'action' => 'index', 'full_base' => true));?></li>
    <li><?= $this->Html->link(
    'SignOut',
    array('controller' => 'users', 'action' => 'logout', 'full_base' => true));?></li>
    </ul>
</div>
<div class="nav">
    <ul>
        <li><?= $this->Html->link(
    'New Employee',
    array('controller' => 'employees', 'action' => 'new_employee', 'full_base' => true));?></li>
    <li><?= $this->Html->link(
    'Employee',
    array('controller' => 'employees', 'action' => 'employee_list', 'full_base' => true));?></li>
    <li><?= $this->Html->link(
    'Department',
    array('controller' => 'departments', 'action' => 'list', 'full_base' => true));?></li>
    <li><?= $this->Html->link(
    'Generate Salary Slip',
    array('controller' => 'departments', 'action' => 'list', 'full_base' => true));?></li>
    <li><?= $this->Html->link(
    'Email',
    array('controller' => 'departments', 'action' => 'list', 'full_base' => true));?></li>
    <li><?= $this->Html->link(
    'Admin',
    array('controller' => 'departments', 'action' => 'list', 'full_base' => true));?></li>
    <li><?= $this->Html->link(
    'Super Admin',
    array('controller' => 'departments', 'action' => 'list', 'full_base' => true));?></li>
    </ul>
    </div>
<div class="nav_line"></div>

</div>