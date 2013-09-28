<?if($advance_available==0){echo $this->element('generated_salaryslip');}
else{?>
<div class="generate_payslip">
<div class="header_bar" style="line-height:25px;font-size:13px"><b>Advance Salary</b></div>
<div class="header_box"><p style="font-size:12px;margin-left:35px">Advance Salary for <?=$salary_date;?></p></div>
 <div class="ne_box_background">
 
 	<div class="generate_payslip_info"> 
	<ul>
 <li><div class="employee_info_box2"><p>Name : <?=$employee['Employee']['fname'];?> <?if($employee['Employee']['mname']!=null){echo $employee['Employee']['mname'];}?> <?=$employee['Employee']['lname'];?></p> </div></li>
 <li><div class="employee_info_box2"><p>Employee Id : <?=$employee['Employee']['emp_id'];?></p> </div></li>
 <li><div class="employee_info_box2"><p>Department : <?=$employee['Employee']['department'];?></p> </div></li>
 <li><div class="employee_info_box2"><p>Designation : <?=$employee['Employee']['designation'];?></p> </div></li>
 <li><div class="employee_info_box2"><p>Previous Advanced Amount : <?if($salaryrecord['advance_amount']){$advanced_amount=$salaryrecord['advance_amount'];}
 	else{$advanced_amount=0;}echo 'Rs. '.$advanced_amount;?></p> </div></li>

 </ul>
 <?if($advance_available==1){?>
 <div class="salary_calc">
 <?php echo $this->Form->create('SalaryRecord',array('id'=>'advance_salary_form_'.$employee_id,'action' => 'advance_salary_update','onclick'=>'return false'));?>
 <?=$this->Form->input('employee_id', array('type' => 'hidden','value' => $employee['Employee']['id']));?>
<?$allowed_amount=$employee['Employee']['net_salary']-$advanced_amount;?>
 <ul>
<li style="margin-left:30px"><div class="employee_info_box2" style="border:none"><p><?=$this->Form->input('advance_amount', array('class'=>'salary_record_field_add','type' => 'number','label' => 'Enter Advance Amount (Not more than '.$allowed_amount.') ','value'=>0));?></p> </div></li>
</ul>

<div style="clear:both;float:left;display:inline;margin:25px 0 0 250px;">
<div id="advance_salary_busy-indicator_<?=$employee_id;?>" style="margin-bottom:5px;display:none"><?=$this->Html->image('updating.gif',array('alt'=>'Updating...'));?></div>	
<? echo $this->Js->submit('generateadvance.png',
            array('form_id'=>'#advance_salary_form_'.$employee_id,
            	
                    'update' => '#employee_container_'.$employee['Employee']['id'], 
                    
                    'url'=>array('controller'=>'employees','action'=>'advance_salary_update'),
                    // element to update
                                             // after form submission
                   //'data' => '$("#employee_employment_edit").closest("form").serialize()',
                   // 'async' => true,
                  //  'dataExpression'=>true,
                    'method' => 'POST',
	                    'before' =>$this->Js->get('#advance_salary_busy-indicator_'.$employee_id)->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#advance_salary_busy-indicator_'.$employee_id)->effect('fadeOut', array('buffer' => false)),
            
                 
                )
        );?>
    <?php
   echo $this->Form->end();?>
  </div>
 <div style="clear:both;height:5px"></div>
 </div><!--salary_calc ends-->
 <?}?>		
 </div><!--generate_payslip_info ends--> 	
 
 <?if(isset($update_msg)){
	if($update_msg=='success'){?>
<div class="success"><p>Advance Salary updated successfully</p></div>
<?}else{?><div class="error-message"><p>Advance Salary not updated</p></div>
<?}}?>	
 <div style="clear:both;height:20px"></div> 	
 </div><!--ne_box_background ends--> 	
</div><!--generate payslip ends-->
<?}?>
<script type="text/javascript">
jQuery(document).ready(function() {
jQuery('.links_li_<?=$employee_id;?>').css('font-weight','normal');
jQuery('#payslip_advance_li_<?=$employee_id;?>').css('font-weight','bold');	
});
</script>