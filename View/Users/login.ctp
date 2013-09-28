<div class="login_box">
<div class="header_bar">HR Management &amp; Payroll System login</div>
<div class="header_box"></div>
<div class="login">
    <?echo $this->Session->flash('auth');?>
<?php echo $this->Form->create('User',array('action' => 'login'));?>    
  <div class="username"><?=$this->Form->input('username', array('label' => 'Username'));?>  </div>
  <div class="ppassword"><?=$this->Form->input('password', array('label' => 'password'));?>  </div>
 <div style="float:left;display:inline;margin:25px 0 0 250px"><?php echo $this->Form->end('sign_in.png');?></div>
</div>
    
</div>