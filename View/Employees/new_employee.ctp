<div class="new_employee">
 <div class="header_bar" style="font-size:12px">Enter New Employee Details</div>
  <div class="header_box"></div>
  <div class="ne_box_background">
      <ul>
<?php echo $this->Form->create('Employee',array('action' => 'new_employee'));?>  
  <li><div class="ne_input_box"><?=$this->Form->input('fname', array('label' => 'First Name'));?> </div>
      <div style="clear:both;height:20px"></div> 
      
  </li>
  <li><div class="ne_input_box"><?=$this->Form->input('mname', array('label' => 'Middle Name'));?></div>
      <div style="clear:both;height:20px"></div> 
  </li>    
  </li>
  <li><div class="ne_input_box"><?=$this->Form->input('lname', array('label' => 'Last Name'));?></div>
      <div style="clear:both;height:20px"></div> 
  </li>
  <li><div class="ne_input_box"><?=$this->Form->input('mobile', array('label' => 'Mobile'));?></div>
      <div style="clear:both;height:20px"></div> 
  </li>
  <li><div class="ne_input_box"><?=$this->Form->input('phone', array('label' => 'Home Phone'));?></div>
      <div style="clear:both;height:20px"></div> 
  </li>
  <li><div class="ne_input_box"style="height:110px"><?=$this->Form->input('address', array('label' => 'Address','type'=>'textarea'));?>
       
    </div>
   <div style="clear:both;height:20px"></div>   
  </li>
  <li><div class="ne_input_box"><?=$this->Form->input('email', array('label' => 'Email'));?></div>
      <div style="clear:both;height:20px"></div>
  </li>
  <li style="clear:both"><div class="ne_input_box"><?= 

$this->Form->input('dob', array(
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
<li><div class="ne_input_box"><?= $this->Form->input('department',array('div' => array('class' => 'ne_select'),'options'=>$departments));?></li>
<li><div class="ne_input_box"><?= $this->Form->input('designation',array('div' => array('class' => 'ne_select'),'options'=>$designations));?></li>
<li><div class="ne_input_box"><?= $this->Form->input('shift',array('div' => array('class' => 'ne_select'),'options'=>$shifts));?></li>
<li><div class="ne_input_box"><?= $this->Form->input('net_salary',array('label'=>'Net Salary(Rs.)'));?></div>
    <div style="clear:both;height:20px"></div>
</li>
<li><div class="ne_input_box"><?= $this->Form->input('pf',array('label'=>'PF(Rs.)','value'=>0));?></div>
    <div style="clear:both;height:20px"></div>
</li>
<li><div class="ne_input_box"><?= $this->Form->input('esi',array('label'=>'ESI(Rs.)','value'=>0));?></div>
    <div style="clear:both;height:20px"></div>
</li>
<li><div class="ne_input_box"><?= $this->Form->input('income_tax',array('label'=>'TDS(%)'));?></div>
    <div style="clear:both;height:20px"></div>
</li>
<li><div class="ne_input_box"><?= $this->Form->input('medical_insurance',array('options'=>$medical_insurances,'empty' => '(choose one)'));?></div>
    <div style="clear:both;height:20px"></div>
</li>
<li><div class="ne_input_box"><?= 
$this->Form->input('joining_date', array(
    'div'=>array('class'=>'ne_joining_date'),
    'dateFormat' => 'DMY',
    'label' => 'Joining Date','type'=>'date'));?>  </div></li>
<li style="clear:both"><div class="ne_input_box"><?= $this->Form->input('employee_type',array('options'=>array(
    'Permanent'=>'Permanent',
    'Temporary'=>'temporary',
    'Contract'=>'Contract'
    )));?></div></li>
<li><div class="ne_input_box"><?= $this->Form->input('current_status',array('options'=>array(
    'Active'=>'Active',
    'Not Active'=>'Not Active',
    'On Leave'=>'On Leave',
    'Suspended'=>'Suspended',
    'Terminated'=>'Terminated',
    )));?></div></li>
<li style="margin:15px 0 10px 25px"><a id="allowance_display" style="color:#ff0000" href="#" onclick="allowance();return false"><b>Show more allowances [+]</b></a></li>
<li style="clear:both"class="allowance_field_li"><div class="ne_input_box"><?= $this->Form->input('medical_allowance',array('label'=>'Medical Allowance(Rs.)','value'=>0,'class'=>'allowance_field'));?></div>
    <div style="clear:both;height:20px"></div>
</li>
<li class="allowance_field_li"><div class="ne_input_box"><?= $this->Form->input('tiffin',array('label'=>'Tiffin Allowance(Rs.)','value'=>0,'class'=>'allowance_field'));?></div>
    <div style="clear:both;height:20px"></div>
</li>
<li class="allowance_field_li"><div class="ne_input_box"><?= $this->Form->input('house_rent',array('label'=>'House Rent Allowance(Rs.)','value'=>0,'class'=>'allowance_field'));?></div>
    <div style="clear:both;height:20px"></div>
</li>
<li class="allowance_field_li"><div class="ne_input_box"><?= $this->Form->input('education',array('label'=>'Education Allowance(Rs.)','value'=>0,'class'=>'allowance_field'));?></div>
    <div style="clear:both;height:20px"></div>
</li>
<li class="allowance_field_li"><div class="ne_input_box"><?= $this->Form->input('entertainment',array('label'=>'Entertainment Allowance(Rs.)','value'=>0,'class'=>'allowance_field'));?></div>
    <div style="clear:both;height:20px"></div>
</li>


      </ul>
<div style="clear:both;float:left;display:inline;margin:35px 0 0 350px"><?php echo $this->Form->end('submit.png');?></div>      
<div style="clear:both;height:20px"></div>

 </div>
 
 
</div>
<script type='text/javascript'>
jQuery(document).ready(function() {
jQuery('.allowance_field_li').css('display','none');	
});
function allowance(){
var display_text=jQuery('#allowance_display').html();
if(display_text=='<b>Show more allowances [+]</b>'){
jQuery('#allowance_display').html('<b>Hide more allowances [-]</b>');	
jQuery('.allowance_field_li').css('display','');	
}
else if(display_text=='<b>Hide more allowances [-]</b>'){
jQuery('#allowance_display').html('<b>Show more allowances [+]</b>');	
jQuery('.allowance_field_li').css('display','none');
jQuery('.allowance_field').val(0);	
}
	
}
</script>