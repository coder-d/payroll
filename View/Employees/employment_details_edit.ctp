
<div class="header_box"></div>
        <div class="ne_box_background">
    
  
<div class="employee_employment_info" id="employee_employment_info"> 
    <ul>
<?php echo $this->Form->create('Employee',array('id'=>'employee_employment_edit_'.$this->data['Employee']['id'],'action' => 'employment_details_edit'));?> 
<?=$this->Form->input('Employee.id', array('type' => 'hidden'));?> 
<li><div class="ne_input_box"><?= $this->Form->input('department',array('div' => array('class' => 'ne_select'),'options'=>$departments));?></div></li>
<li><div class="ne_input_box"><?= $this->Form->input('designation',array('div' => array('class' => 'ne_select'),'options'=>$designations));?></div></li>
<li><div class="ne_input_box"><?= $this->Form->input('shift',array('div' => array('class' => 'ne_select'),'options'=>$shifts));?></div></li>
<li><div class="ne_input_box"><?= $this->Form->input('net_salary',array('label'=>'Net Salary(Rs.)'));?></div>
    <div style="clear:both;height:20px"></div>
</li>
<li><div class="ne_input_box"><?= $this->Form->input('pf',array('label'=>'PF(Rs.)'));?></div>
    <div style="clear:both;height:20px"></div>
</li>
<li><div class="ne_input_box"><?= $this->Form->input('esi',array('label'=>'ESI(Rs.)'));?></div>
    <div style="clear:both;height:20px"></div>
</li>
<li><div class="ne_input_box"><?= $this->Form->input('income_tax',array('label'=>'TDS(Rs.)'));?></div>
    <div style="clear:both;height:20px"></div>
</li>
<li><div class="ne_input_box"><?= $this->Form->input('medical_allowance',array('label'=>'Medical Allowance(Rs.)'));?></div>
    <div style="clear:both;height:20px"></div>
</li>
<li><div class="ne_input_box"><?= $this->Form->input('tiffin',array('label'=>'Tiffin Allowance(Rs.)'));?></div>
    <div style="clear:both;height:20px"></div>
</li>
<li><div class="ne_input_box"><?= $this->Form->input('house_rent',array('label'=>'House Rent Allowance(Rs.)'));?></div>
    <div style="clear:both;height:20px"></div>
</li>
<li><div class="ne_input_box"><?= $this->Form->input('education',array('label'=>'Education Allowance(Rs.)'));?></div>
    <div style="clear:both;height:20px"></div>
</li>
<li><div class="ne_input_box"><?= $this->Form->input('entertainment',array('label'=>'Entertainment Allowance(Rs.)'));?></div>
    <div style="clear:both;height:20px"></div>
</li>
<li><div class="ne_input_box"><?= $this->Form->input('medical_insurance',array('options'=>$medical_insurances));?></div>
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
  </ul>
<div style="clear:both;float:left;display:inline;margin:35px 0 0 325px">
	
  <? echo $this->Js->submit('submit.png',
            array('form_id'=>'#employee_employment_edit_'.$this->data['Employee']['id'],
            	
                    'update' => '#employment_details_hide_'.$this->data['Employee']['id'], // element to update
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
   // echo $this->Form->end('submit.png');?></div>   
</div>  

 
<div style="clear:both;height:20px"></div>   
</div>