<style>
.error-message{margin-left:-35px;width:195px}
	
</style>
<div class="generate_payslip">
<div class="header_bar" style="line-height:25px;font-size:13px"><b>Loan</b></div>
<div class="header_box"><p style="font-size:12px;margin-left:35px">Loan</p></div>
 <div class="ne_box_background">
 <div class="generate_payslip_info"> 
	<ul>
 <li><div class="employee_info_box2"><p>Name : <?=$employee['Employee']['fname'];?> <?if($employee['Employee']['mname']!=null){echo $employee['Employee']['mname'];}?> <?=$employee['Employee']['lname'];?></p> </div></li>
 <li><div class="employee_info_box2"><p>Employee Id : <?=$employee['Employee']['emp_id'];?></p> </div></li>
 <li><div class="employee_info_box2"><p>Department : <?=$employee['Employee']['department'];?></p> </div></li>
 <li><div class="employee_info_box2"><p>Designation : <?=$employee['Employee']['designation'];?></p> </div></li>
 <li><div class="employee_info_box2"><p>Previous Loan Amount : Rs. <?if($employee['Loan']['loan_amount']){$loan_amount=$employee['Loan']['loan_amount'];}
 else{$loan_amount=0;}echo $loan_amount;?></p> </div></li>
 <?if($employee['Loan']['loan_amount']){?><li><div class="employee_info_box2"><p>Previous Loan Repay Period : <?=$employee['Loan']['repay_period'];?></p></div></li><?}?> 
 </ul>	


<div class="salary_calc">
 <?php echo $this->Form->create('Loan',array('class'=>'loan_form','id'=>'loan_form_'.$employee_id,'action' => 'loan','onclick'=>'return false'));?>
 <?=$this->Form->input('employee_id', array('type' => 'hidden','value' => $employee['Employee']['id']));?>
 <ul>
<li style="margin-left:210px"><div class="employee_info_box2" style="border:none"><p><?=$this->Form->input('loan_amount', array('class'=>'loan','type' => 'number','label' => 'Enter Loan Amount<br/>'));?></p> </div></li>
<li style="margin-left:210px"><div class="employee_info_box2" style="border:none"><p><?=$this->Form->input('interest_percent', array('class'=>'loan','type' => 'number','label' => 'Enter Interest(%)<br/>','value'=>0));?></p> </div></li>
<li style="margin-left:210px"><div class="employee_info_box2" style="border:none"><p><?=$this->Form->input('repay_period', array('class'=>'loan','type' => 'number','label' => 'Enter Repay Period(in months)<br/>'));?></p> </div></li>
</ul>

<div style="clear:both;float:left;display:inline;margin:25px 0 0 250px;">
<div id="loan_busy-indicator_<?=$employee_id;?>" style="margin-bottom:5px;display:none"><?=$this->Html->image('updating.gif',array('alt'=>'Updating...'));?></div>	
<? echo $this->Js->submit('generateloan.png',
            array('form_id'=>'#loan_form_'.$employee_id,
            	
                    'update' => '#employee_container_'.$employee['Employee']['id'], 
                    
                    'url'=>array('controller'=>'employees','action'=>'loan'),
                    // element to update
                                             // after form submission
                   //'data' => '$("#employee_employment_edit").closest("form").serialize()',
                   // 'async' => true,
                  //  'dataExpression'=>true,
                    'method' => 'POST',
	                    'before' =>$this->Js->get('#loan_busy-indicator_'.$employee_id)->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#loan_busy-indicator_'.$employee_id)->effect('fadeOut', array('buffer' => false)),
            
                 
                )
        );?>
    <?php
   echo $this->Form->end();?>
  </div>
  <?if(isset($update_msg)){
	if($update_msg=='success'){?>
<div class="success" style="float:left;display:inline;margin:15px 0 0 0;width:600px"><p>Loan updated successfully</p></div>
<?}else{?><div class="error-message" style="float:left;display:inline;margin:15px 0 0 0;width:600px"><p>Loan not updated</p></div>
<?}}?>	
 <div style="clear:both;height:5px"></div>
 </div><!--salary_calc ends-->		
 </div><!--generate_payslip_info ends--> 
<div style="clear:both;height:20px"></div> 	
 </div><!--ne_box_background ends--> 	
</div><!--generate payslip ends-->
<script type="text/javascript">
jQuery(document).ready(function() {
jQuery('.links_li_<?=$employee_id;?>').css('font-weight','normal');
jQuery('#loan_li_<?=$employee_id;?>').css('font-weight','bold');	
});
</script>