<div class="generate_payslip">
<div class="header_bar" style="line-height:25px;font-size:13px"><b>Generated Salary Slip</b></div>
<div class="header_box"><p style="font-size:12px;margin-left:35px">Payslip for <?=$salaryrecord['salary_date'];?></p></div>
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
 <ul> 	
 <li><p class="pleft">Fields</p><p class="pmiddle">Full(Rs.)</p><p class="pright">Actual(Rs.)</p></li>
 <li style="margin-top:10px"><p class="pleft">Basic</p><p class="pmiddle"><?=$employee['Employee']['net_salary'];?></p><p class="pright"><?=$salaryrecord['basic'];?></p></li>
 <li style="margin-top:10px"><p class="pleft">DA</p><p class="pmiddle"><?=$employee['Employee']['da'];?></p><p class="pright"><?=$salaryrecord['da'];?></p></li>
 <li style="margin-top:10px"><p class="pleft">Bonus</p><p class="pmiddle"><?=$employee['Employee']['bonus'];?></p><p class="pright"><?=$salaryrecord['bonus'];?></p></li>
 <li style="margin-top:10px"><p class="pleft">Medical Allowance</p><p class="pmiddle"><?=$employee['Employee']['medical_allowance'];?></p><p class="pright"><?=$salaryrecord['medical_allowance'];?></p></li>
 <li style="margin-top:10px"><p class="pleft">Tiffin Allowance</p><p class="pmiddle"><?=$employee['Employee']['tiffin'];?></p><p class="pright"><?=$salaryrecord['tiffin'];?></p></li>
 <li style="margin-top:10px"><p class="pleft">Houese Rent Allowance</p><p class="pmiddle"><?=$employee['Employee']['house_rent'];?></p><p class="pright"><?=$salaryrecord['house_rent'];?></p></li>
 <li style="margin-top:10px"><p class="pleft">Education Allowance</p><p class="pmiddle"><?=$employee['Employee']['education'];?></p><p class="pright"><?=$salaryrecord['education'];?></p></li>
 <li style="margin-top:10px"><p class="pleft">Entertainment Allowance</p><p class="pmiddle"><?=$employee['Employee']['entertainment'];?></p><p class="pright"><?=$salaryrecord['entertainment'];?></p></li>
 </ul>
 <div class="employee_info_box2" style="margin:20px 0 0 0;width:628px"><p>Deductions</p></div>
 <ul>
 <li style="margin-top:10px"><p class="pleft">PF</p><p class="pmiddle"><?=$employee['Employee']['pf'];?></p><p class="pright"><?=$salaryrecord['pf'];?></p></li>
 <li style="margin-top:10px"><p class="pleft">ESI</p><p class="pmiddle"><?=$employee['Employee']['esi'];?></p><p class="pright"><?=$salaryrecord['esi'];?></p></li>
 <li style="margin-top:10px"><p class="pleft">TDS</p><p class="pmiddle"><?$tds=($employee['Employee']['net_salary']*$employee['Employee']['income_tax'])/100;echo $tds;?></p><p class="pright"><?=$salaryrecord['income_tax'];?></p></li>
 <li style="margin-top:10px"><p class="pleft">Advance</p><p class="pmiddle"><?=$salaryrecord['advance_amount'];?></p><p class="pright"><?=$salaryrecord['advance_amount'];?></p></li>
 <li style="margin-top:10px"><p class="pleft">Loan</p><p class="pmiddle"><?=$salaryrecord['expected_loan_amount'];?></p><p class="pright"><?=$salaryrecord['loan_amount'];?></p></li>
 </ul>
 <div class="employee_info_box2" style="margin:20px 0 0 0;width:628px"><p style="margin-left:255px;float:left;display:inline;width:185px">Total Earnings : Rs <?=$expected_earnings;?></p><p style="float:left;display:inline;width:175px">Actual Earnings : Rs <span id="actual_earnings_<?=$employee_id;?>"><?=$earnings;?></span></p></div>
 <div style="clear:both;"></div>
 </div><!--salary_calc ends-->
 <div style="clear:both;float:left;display:inline;margin:15px 0 0 485px">
 <?php echo $this->Form->create('SalaryRecord',array('id'=>'printsalaryslip_'.$employee_id,'action' => 'print_salaryslip','onsubmit' =>'print_salary();return false'));?>
 <?=$this->Form->input('employee_id', array('type' => 'hidden','value' => $employee['Employee']['id']));?>
 <?=$this->Form->input('salary_date', array('type' => 'hidden','value' => $salaryrecord['salary_date']));?>
 <?php 
 $options = array('id'=>'printsalary_button_'.$employee_id,
    'label' => 'printsalaryslip.png',
    'value' => 'PrintSalarySlip',
);
echo $this->Form->end($options);?>	
 </div>
<div style="margin:20px 0 0 10px;clear:both;font-size:12px"><b>Payslip is generated based on data provided in Actual Earnings fields</b></div>
  
</div><!--generate_payslip_info ends--> 
<div style="clear:both;height:20px"></div> 	
 </div><!--ne_box_background ends--> 	
</div><!--generate payslip ends-->
<script type="text/javascript">
function print_salary() {
var formData = jQuery('#printsalaryslip_<?=$employee_id;?>').serialize();
jQuery.post('print_salaryslip',formData,function (result) {
            var win = window.open();
            win.document.write(result);
        });
return false;
};
</script>