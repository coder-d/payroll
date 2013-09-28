<style>
	table{float:left;display:inline;width:800px;clear:both;margin-top:25px;border:none;border-collapse:collapse;
	border-spacing: 0;}
	th{font-size:12px;height:10px;font-size:22px!important;border-bottom:0px solid black}
	td{text-align:center;width:50%;border:1px solid black;cellpadding="0" cellspacing="0" border="0"}
	.no_border{border:none;text-align:left;border-bottom:1px solid #000000;border-right:1px solid #000000}
	td p{float:left;display:inline;height:5px;}
	.fields{margin-left:25px;width:175px!important;}
	.field_values{width:95px}
	.clear_p{clear:both}
	.slip{clear:both;float:left;display:inline;width:800px;border:1px solid #000000;margin-top:25px;}
	.heading{font-size:16px;font-weight:bold;text-align:center;border-bottom:1px solid #000000;margin: 0 0 0 0!important}
	.slip ul{margin-left:-35px}
	.slip li{list-style-type: none!important;}
	.p_left{float:left;display:inline;width:210px;height:5px}
	.p_mid{float:left;display:inline;width:100px;height:5px;text-align:center}
	.p_right{float:left;display:inline;width:80px;height:5px;text-align:center}
	
</style>
<?if($salaryrecord!=null):?>
<div style="font-size:20px;float:left;display:inline;width:175px">Company Logo</div>
<div style="font-size:20px;float:left;display:inline">Company Name</div>

<div style="clear:both;float:left;display:inline;margin-top:50px"><b>Payslip for the month of <?=$salaryrecord['SalaryRecord'][0]['salary_date'];?></b></div>

<table>
<tr>
	<td>Name : <?$name=$salaryrecord['Employee']['fname'];
if($salaryrecord['Employee']['mname']!=null){$name.=' '.$salaryrecord['Employee']['mname'];}
$name.=' '.$salaryrecord['Employee']['lname'];echo $name;?></td>
<td>Employee Id : <?=$salaryrecord['Employee']['emp_id'];?></td>
</tr>
<tr>
<td class="left_td">Department : <?=$salaryrecord['Employee']['department'];?></td>
<td>Designation : <?=$salaryrecord['Employee']['designation'];?></td>
</tr>
</table>

<div class="slip">
<div style="float:left;display:inline;width:398px;border-right:1px solid #000000">
<p class="heading">Earnings</p>
<ul>
	<li><p class="p_left"></p><p class="p_mid">Full (Rs.)</p><p class="p_right">Actual (Rs.)</p></li>
	<li><p class="p_left">Basic</p><p class="p_mid"><?=$salaryrecord['Employee']['net_salary'];?></p><p class="p_right"><?=$salaryrecord['SalaryRecord'][0]['basic'];?></p></li>
	<li><p class="p_left">DA</p><p class="p_mid"><?=$salaryrecord['Employee']['da'];?></p><p class="p_right"><?=$salaryrecord['SalaryRecord'][0]['da'];?></p></li>
	<li><p class="p_left">Medical Allowance</p><p class="p_mid"><?=$salaryrecord['Employee']['medical_allowance'];?></p><p class="p_right"><?=$salaryrecord['SalaryRecord'][0]['medical_allowance'];?></p></li>
	<li><p class="p_left">Tiffin Allowance</p><p class="p_mid"><?=$salaryrecord['Employee']['tiffin'];?></p><p class="p_right"><?=$salaryrecord['SalaryRecord'][0]['tiffin'];?></p></li>
	<li><p class="p_left">House Rent Allowance</p><p class="p_mid"><?=$salaryrecord['Employee']['house_rent'];?></p><p class="p_right"><?=$salaryrecord['SalaryRecord'][0]['house_rent'];?></p></li>
	<li><p class="p_left">Education Allowance</p><p class="p_mid"><?=$salaryrecord['Employee']['education'];?></p><p class="p_right"><?=$salaryrecord['SalaryRecord'][0]['education'];?></p></li>
	<li><p class="p_left">Entertainment Allowance</p><p class="p_mid"><?=$salaryrecord['Employee']['entertainment'];?></p><p class="p_right"><?=$salaryrecord['SalaryRecord'][0]['entertainment'];?></p></li>
</ul>
</div>

<div style="float:left;display:inline;width:398px">
<p class="heading">Deductions</p>
<ul>
	<li><p class="p_left"></p><p class="p_mid">Full (Rs.)</p><p class="p_right">Actual (Rs.)</p></li>
	<li><p class="p_left">PF</p><p class="p_mid"><?=$salaryrecord['Employee']['pf'];?></p><p class="p_right"><?=$salaryrecord['SalaryRecord'][0]['pf'];?></p></li>
	<li><p class="p_left">ESI</p><p class="p_mid"><?=$salaryrecord['Employee']['esi'];?></p><p class="p_right"><?=$salaryrecord['SalaryRecord'][0]['esi'];?></p></li>
	<li><p class="p_left">TDS</p><p class="p_mid"><?$tds=($salaryrecord['Employee']['net_salary']*$salaryrecord['Employee']['income_tax'])/100;echo $tds;?></p><p class="p_right"><?=$salaryrecord['SalaryRecord'][0]['income_tax'];?></p></li>
	<li><p class="p_left">Advance</p><p class="p_mid">0</p><p class="p_right">0</p></li>
	<li><p class="p_left">Loan</p><p class="p_mid">0</p><p class="p_right">0</p></li>
</ul>
</div>
<div style="clear:both"></div>

<div style="margin:0px 0 0 0px;width:398px;height:22px;border:1px solid #000000;border-left:none;float:left;display:inline">
<p style="margin:0px 0 0 2px"class="p_left">Total Earnings (Rs.) :</p><p style="margin-top:0px" class="p_mid"><?=$expected_earnings;?></p><p style="margin-top:0px" class="p_right"><?=$earnings;?></p>

</div>
<div style="margin:0px 0 0 0px;width:400px;height:22px;border:1px solid #000000;border-left:none;border-right:none;float:left;display:inline">
<p style="margin:0px 0 0 2px"class="p_left">Total Deductions (Rs.) :</p><p style="margin-top:0px" class="p_mid"><?=$expected_deductions;?></p><p style="margin-top:0px" class="p_right"><?=$deductions;?></p>

<div style="clear:both"></div>
</div>
<div style="clear:both"></div>
<p style="margin:0px 0 0 2px;width:396px;height:22px;border-right:1px solid #000000;">Net Salary : Rs. <?=$net_salary;?></p>
</div><!--slip ends-->

<div style="clear:both;margin-top:15px;float:left;display:inline">
	<?if($salaryrecord['SalaryRecord'][0]['print_copy']>1){?>
	<p style="font-size:16px!important;color:#cccccc"><b>This is a copy of the original salary slip</b></p><?}?>
	<p style="font-size:16px!important;color:#cccccc"><b>This is a computer-generated salary slip. Does not require a Signature</b></p>
</div>



<?endif;?>