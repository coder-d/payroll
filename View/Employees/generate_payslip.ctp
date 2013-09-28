<?if($salaryrecord==0){?>
<div class="attendance_summary">
<div class="header_bar" style="line-height:25px;font-size:13px"><b>Attendance Summary for <?=$salary_month;?> <?=$salary_year;?> 
	( <?= $this->Js->link('Click to view Attendance Calendar',
      array('controller' => 'employees', 'action' => 'attendance_popup',$employee_id,$salary_month.'-'.$salary_year),
      array(
         'update' => '#personal_details_hide_'.$employee_id,
         'evalScripts' => true,
        'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)),
      )
   );
 echo $this->Js->writeBuffer();  
?> )</b></div>
<div class="header_box"></div>
 <div class="ne_box_background">
 	
 <div class="attendance_summary_info"> 
    <ul>
 <li><div class="employee_info_box2"><p>Number of Leaves this month : <?if($leave_count==0){echo 'None';}else{echo $leave_count;}?></p> </div></li>
 <li><div class="employee_info_box2"><p>Number of days Absent this month : <?if($absent_count==0){echo 'None';}else{echo $absent_count;}?></p> </div></li>
 <li><div class="employee_info_box2"><p>Total Overtime hour(s) : <?if($overtime_count==0){echo $overtime_count;}?></p> </div></li>
 </ul>
</div>
<div style="clear:both;height:20px"></div> 	
 </div><!--ne_box_background ends-->
</div><!--attendance_summary ends-->

<div class="generate_payslip">
<div class="header_bar" style="line-height:25px;font-size:13px"><b>Generate Salary Slip</b></div>
<div class="header_box"><p style="font-size:12px;margin-left:35px">Payslip for <?=$salary_month;?> <?=$salary_year;?></p></div>
 <div class="ne_box_background">

<div class="generate_payslip_info"> 
	<ul>
 <li><div class="employee_info_box2"><p>Name : <?=$employee['Employee']['fname'];?> <?if($employee['Employee']['mname']!=null){echo $employee['Employee']['mname'];}?> <?=$employee['Employee']['lname'];?></p> </div></li>
 <li><div class="employee_info_box2"><p>Employee Id : <?=$employee['Employee']['emp_id'];?></p> </div></li>
 <li><div class="employee_info_box2"><p>Department : <?=$employee['Employee']['department'];?></p> </div></li>
 <li><div class="employee_info_box2"><p>Designation : <?=$employee['Employee']['designation'];?></p> </div></li>
 </ul>
 
 <div class="salary_calc">
 <div class="employee_info_box2" style="margin:0 0 0 0;width:628px"><p>Earnings</p></div>
<?php echo $this->Form->create('SalaryRecord',array('class'=>'salary_record','id'=>'salary_record_'.$employee_id,'action' => 'payslip_update'));?>
<?=$this->Form->input('employee_id', array('type' => 'hidden','value'=>$employee_id));?>
<?=$this->Form->input('salary_date', array('type' => 'hidden','value'=>$salary_date));?>
<?=$this->Form->input('expected_loan_amount', array('type' => 'hidden','value'=>$expected_loan_amount));?>
<?=$this->Form->input('fname', array('type' => 'hidden','value'=>$employee['Employee']['fname']));?>
<?=$this->Form->input('mname', array('type' => 'hidden','value'=>$employee['Employee']['mname']));?>
<?=$this->Form->input('lname', array('type' => 'hidden','value'=>$employee['Employee']['lname']));?>
<?=$this->Form->input('department', array('type' => 'hidden','value'=>$employee['Employee']['department']));?>
<?=$this->Form->input('designation', array('type' => 'hidden','value'=>$employee['Employee']['designation']));?>
<?=$this->Form->input('email', array('type' => 'hidden','value'=>$employee['Employee']['email']));?>
 <ul> 	
 <li><p class="pleft">Fields</p><p class="pmiddle">Full(Rs.)</p><p class="pright">Actual(Rs.)</p></li>
 <li style="margin-top:10px"><p class="pleft">Basic</p><p class="pmiddle"><?=$employee['Employee']['net_salary'];?></p><p class="pright"><?=$this->Form->input('basic', array('class'=>'salary_record_field_add_'.$employee_id,'id'=>'basic_salary_'.$employee_id,'type' => 'text','label'=>'','value'=>$employee['Employee']['net_salary']));?>
 	<?=$this->Form->input('tds_percent', array('id'=>'tds_percent_'.$employee_id,'type' => 'hidden','value'=>$employee['Employee']['income_tax']));?>
 </p></li>
 <li style="margin-top:10px"><p class="pleft">DA</p><p class="pmiddle"><?=$employee['Employee']['da'];?></p><p class="pright"><?=$this->Form->input('da', array('class'=>'salary_record_field_add_'.$employee_id,'type' => 'text','label'=>'','value'=>$employee['Employee']['da']));?></p></li>
 <li style="margin-top:10px"><p class="pleft">Bonus</p><p class="pmiddle"><?=$employee['Employee']['bonus'];?></p><p class="pright"><?=$this->Form->input('bonus', array('class'=>'salary_record_field_add_'.$employee_id,'type' => 'text','label'=>'','value'=>$employee['Employee']['bonus']));?></p></li>
 <li style="margin-top:10px"><p class="pleft">Medical Allowance</p><p class="pmiddle"><?=$employee['Employee']['medical_allowance'];?></p><p class="pright"><?=$this->Form->input('medical_allowance',array('class'=>'salary_record_field_add_'.$employee_id,'medical_allowance','type' => 'text','label'=>'','value'=>$employee['Employee']['medical_allowance']));?></p></li>
 <li style="margin-top:10px"><p class="pleft">Tiffin Allowance</p><p class="pmiddle"><?=$employee['Employee']['tiffin'];?></p><p class="pright"><?=$this->Form->input('tiffin', array('class'=>'salary_record_field_add_'.$employee_id,'type' => 'text','label'=>'','value'=>$employee['Employee']['tiffin']));?></p></li>
 <li style="margin-top:10px"><p class="pleft">Houese Rent Allowance</p><p class="pmiddle"><?=$employee['Employee']['house_rent'];?></p><p class="pright"><?=$this->Form->input('house_rent', array('class'=>'salary_record_field_add_'.$employee_id,'type' => 'text','label'=>'','value'=>$employee['Employee']['house_rent']));?></p></li>
 <li style="margin-top:10px"><p class="pleft">Education Allowance</p><p class="pmiddle"><?=$employee['Employee']['education'];?></p><p class="pright"><?=$this->Form->input('education', array('class'=>'salary_record_field_add_'.$employee_id,'type' => 'text','label'=>'','value'=>$employee['Employee']['education']));?></p></li>
 <li style="margin-top:10px"><p class="pleft">Entertainment Allowance</p><p class="pmiddle"><?=$employee['Employee']['entertainment'];?></p><p class="pright"><?=$this->Form->input('entertainment', array('class'=>'salary_record_field_add_'.$employee_id,'type' => 'text','label'=>'','value'=>$employee['Employee']['entertainment']));?></p></li>
 </ul>
 <div class="employee_info_box2" style="margin:20px 0 0 0;width:628px"><p>Deductions</p></div>
 <ul>
 <li style="margin-top:10px"><p class="pleft">PF</p><p class="pmiddle"><?=$employee['Employee']['pf'];?></p><p class="pright"><?=$this->Form->input('pf', array('class'=>'salary_record_field_minus_'.$employee_id,'type' => 'text','label'=>'','value'=>$employee['Employee']['pf']));?></p></li>
 <li style="margin-top:10px"><p class="pleft">ESI</p><p class="pmiddle"><?=$employee['Employee']['esi'];?></p><p class="pright"><?=$this->Form->input('esi', array('class'=>'salary_record_field_minus_'.$employee_id,'type' => 'text','label'=>'','value'=>$employee['Employee']['esi']));?></p></li>
 <li style="margin-top:10px"><p class="pleft">TDS</p><p class="pmiddle"><?$tds=($employee['Employee']['net_salary']*$employee['Employee']['income_tax'])/100;echo $tds;?></p><p class="pright"><?=$this->Form->input('income_tax', array('class'=>'salary_record_field_minus_'.$employee_id,'id'=>'tds_'.$employee_id,'type' => 'text','label'=>'','value'=>$tds));?></p></li>
 <li style="margin-top:10px"><p class="pleft">Advance</p><p class="pmiddle"><?if($advance_amount){$advance=$advance_amount;}
 	else{$advance=0;}echo $advance;?></p><p class="pright"><?=$this->Form->input('advance_amount', array('class'=>'salary_record_field_minus_'.$employee_id,'type' => 'text','label'=>'','value'=>$advance));?></p></li>
 <li style="margin-top:10px"><p class="pleft">Loan</p><p class="pmiddle"><?=$expected_loan_amount;?></p><p class="pright"><?=$this->Form->input('loan_amount', array('class'=>'salary_record_field_minus_'.$employee_id,'type' => 'text','label'=>'','value'=>$expected_loan_amount));?></p></li>
 </ul>
 <div class="employee_info_box2" style="margin:20px 0 0 0;width:628px"><p style="margin-left:255px;float:left;display:inline;width:185px">Total Earnings : Rs <?=$expected_earnings;?></p><p style="float:left;display:inline;width:175px">Actual Earnings : Rs <span id="actual_earnings_<?=$employee_id;?>"><?=$expected_earnings;?></span></p></div>
 <div style="clear:both;"></div>
 </div><!--salary_calc ends-->
 <div style="clear:both;float:left;display:inline;margin:15px 0 0 485px">
 <? $image = $this->Html->image(
    'recalsalary.png', 
    array(
        'alt'=>'Recalculate Salary'
    )
);

echo $this->Html->link(
    $image,
    '#', 
    array('onclick'=>'recalculate_'.$employee_id.'();return false', 
        'escape' => false
    )
); ?> 
  </div>
  <div style="margin:20px 0 0 10px;clear:both;font-size:12px"><b>Payslip is generated based on data provided in Actual Earnings fields</b></div>
  <div style="clear:both;float:left;display:inline;margin:35px 0 0 300px">
 <div id="#generate_payslip_busy-indicator" style="margin-bottom:5px;display:none"><?=$this->Html->image('updating.gif',array('alt'=>'Updating...'));?></div>  
 	<? echo $this->Js->submit('generatesalary.png',
            array('form_id'=>'#salary_record_'.$employee_id,
            	
                    'update' => '#employee_container_'.$employee['Employee']['id'], 
                    
                    'url'=>array('controller'=>'employees','action'=>'payslip_update'),
                    // element to update
                                             // after form submission
                   //'data' => '$("#employee_employment_edit").closest("form").serialize()',
                   // 'async' => true,
                  //  'dataExpression'=>true,
                    'method' => 'POST',
                    'before' => $this->Js->get('#generate_payslip_busy-indicator')->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#generate_payslip_busy-indicator')->effect('fadeOut', array('buffer' => false)),
            
                 
                )
        );?>
    <?php
   echo $this->Form->end();?>      
  </div>
</div><!--generate_payslip_info ends--> 
<div style="clear:both;height:20px"></div> 	
 </div><!--ne_box_background ends--> 	
</div><!--generate payslip ends-->

<script type="text/javascript">

function recalculate_<?=$employee_id;?>(){
var earnings = 0;
         //iterate through each textboxes and add the values
         jQuery(".salary_record_field_add_<?=$employee_id;?>").each(function() {
            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                earnings += parseFloat(this.value);
            }
            else{alert('Please Enter a Valid Number');}

        });
        jQuery(".salary_record_field_minus_<?=$employee_id;?>").each(function() {
            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                earnings -= parseFloat(this.value);
            }
        else{alert('Please Enter a Valid Number');}
        });
        
        //.toFixed() method will roundoff the final sum to 2 decimal places
       
        jQuery("#actual_earnings_<?=$employee_id;?>").html(earnings.toFixed(2));
}
jQuery('#basic_salary_<?=$employee_id;?>').change(function() {
var tds=((jQuery('#basic_salary_<?=$employee_id;?>').val()*jQuery('#tds_percent_<?=$employee_id;?>').val())/100).toFixed(2);
jQuery('#tds_<?=$employee_id;?>').val(tds);
});
</script>
<?}else{echo $this->element('generated_salaryslip');}?>

<script type="text/javascript">
jQuery(document).ready(function() {
jQuery('.links_li_<?=$employee_id;?>').css('font-weight','normal');
jQuery('#generate_payslip_li_<?=$employee_id;?>').css('font-weight','bold');
});
</script>