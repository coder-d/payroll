<div class="header_box"></div>
<div class="ne_box_background">
<ul>
        
<?php echo $this->Form->create('Employee',array('id'=>'employee_personal_edit_'.$this->data['Employee']['id'],'action' => 'personal_details_edit'));?> 
<?=$this->Form->input('Employee.id', array('type' => 'hidden'));?> 
<?=$this->Form->input('Employee.image', array('type' => 'hidden'));?>
<?=$this->Form->input('Employee.emp_id', array('label' => '','type'=>'hidden'));?> 
  <li><div class="ne_input_box"><?=$this->Form->input('fname', array('label' => 'First Name','id'=>'fname'));?> </div>
      <div style="clear:both;height:20px"></div> 
  </li>
  <li><div class="ne_input_box"><?=$this->Form->input('mname', array('label' => 'Middle Name','id'=>'mname'));?></div>
      <div style="clear:both;height:20px"></div> 
  </li>
  <li><div class="ne_input_box"><?=$this->Form->input('lname', array('label' => 'Last Name','id'=>'lname'));?></div>
      <div style="clear:both;height:20px"></div> 
  </li>
  <li><div class="ne_input_box"><?=$this->Form->input('mobile', array('label' => 'Mobile','id'=>'mobile'));?></div>
      <div style="clear:both;height:20px"></div> 
  </li>
  <li><div class="ne_input_box"><?=$this->Form->input('phone', array('label' => 'Home Phone','id'=>'phone'));?></div>
      <div style="clear:both;height:20px"></div> 
  </li>
  <li><div class="ne_input_box"style="height:110px"><?=$this->Form->input('address', array('label' => 'Address','type'=>'textarea','id'=>'address'));?>
       
    </div>
   <div style="clear:both;height:20px"></div>   
  </li>
  <li><div class="ne_input_box"><?=$this->Form->input('email', array('label' => 'Email','id'=>'email'));?></div>
      <div style="clear:both;height:20px"></div>
  </li>
  <li style="clear:both"><div class="ne_input_box"><?= 

$this->Form->input('dob', array('id'=>'dob',
    'div'=>array('class'=>'ne_dob'),
    'label' => 'Date of birth','type'=>'date',
    'dateFormat' => 'DMY',
    'minYear' => date('Y') - 70,
    'maxYear' => date('Y') - 18,
));?>
  </div></li>
  <li><div class="ne_input_box"><?= $this->Form->input('sex',array('div' => array('class' => 'ne_select'),'options' => array(
        'Male' =>  'Male',       	
        'Female' =>  'Female'
        )));?>
        
      </div></li> 
<li><div class="ne_input_box"><?= $this->Form->input('blood_group',array('div' => array('class' => 'ne_select'),'options' => array(
        'O-' =>  'O-',       	
        'O+' =>  'O+',
        'A-' =>  'A-',
        'A+' =>  'A+',
        'B-' =>  'B-',
        'B+' =>  'B+',
        'AB-' =>  'AB-',
        'AB+' =>  'AB+',
        )));?>
        
      </div></li>

    
      </ul>
<div style="clear:both;float:left;display:inline;margin:35px 0 0 325px">


    <? echo $this->Js->submit('submit.png',
            array('form_id'=>'#employee_personal_edit_'.$this->data['Employee']['id'],
            	
                    'update' => '#personal_details_hide_'.$this->data['Employee']['id'], // element to update
                                             // after form submission
                   //'data' => '$("#employee_employment_edit").closest("form").serialize()',
                   // 'async' => true,
                  //  'dataExpression'=>true,
                    'method' => 'POST',
            
                 
                )
            
        );?>
    <?php
   echo $this->Form->end();
  echo $this->Js->writeBuffer();     
   // echo $this->Form->end('submit.png');?>
  
</div>      
<div style="clear:both;height:20px"></div>
</div>


 <div style="clear:both;height:20px"></div> 
