<?if(count($employees)>0){?>
<div class="paging" style="clear:both;margin-top:15px">
	   <?php
$this->Paginator->options(array(
    'update' => '#employee_list_right',
    'evalScripts' => true,
    'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
    'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)),
));?>

<?php 
if ($this->Paginator->hasPage(2)) {
	 
	echo $this->Paginator->prev();
	echo (" | ");
} ?> 
<?php echo $this->Paginator->numbers(); ?> 
<?php 
if ($this->Paginator->hasPage(2)) { 
	echo (" | ");
	echo $this->Paginator->next();

}
 ?> 
</div>
	<?foreach($employees as $employee):?>

<div class="employee_display_top">
   <p id="employee_display_top_image_<?=$employee['Employee']['id'];?>"> <?= $this->Html->image('/files/pic/small/'.$employee['Employee']['image'],array('alt' => 'Display Image','width'=>'24px','height'=>'31px'));?></p>
    <p><?=$employee['Employee']['fname'].' '.$employee['Employee']['lname'];?></p>
    </div>    
<div class="employee_links">
 <ul> 
     <li class="links_li_<?=$employee['Employee']['id'];?>" id="employee_details_li_<?=$employee['Employee']['id'];?>"><?php
   echo $this->Js->link('Employee Details',
      array('controller' => 'employees', 'action' => 'employee_list','emp'.$employee['Employee']['id'],1),
      array(
         'update' => '#employee_container_'.$employee['Employee']['id'],
         'evalScripts' => true,
        'before' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeOut', array('buffer' => false)),
      )
   );
?></li>
<li>|</li>
    <li class="links_li_<?=$employee['Employee']['id'];?>" id="edit_attendance_li_<?=$employee['Employee']['id'];?>"><?php
    echo $this->Js->link('Update/Edit Attendance Sheet',
      array('controller' => 'employees', 'action' => 'update_attendance',$employee['Employee']['id']),
      array(
         'update' => '#employee_container_'.$employee['Employee']['id'],
         'evalScripts' => true,
        'before' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeOut', array('buffer' => false)),
      )
   );
?></li>
<li>|</li>
    <li class="links_li_<?=$employee['Employee']['id'];?>" id="view_attendance_li_<?=$employee['Employee']['id'];?>"><?php
   echo $this->Js->link('View Attendence Sheet',
      array('controller' => 'employees', 'action' => 'view_attendance',$employee['Employee']['id']),
      array('update' => '#employee_container_'.$employee['Employee']['id'],
         'evalScripts' => true,
        'before' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeOut', array('buffer' => false)),
      )
   );
?></li>
<li>|</li>
    <li class="links_li_<?=$employee['Employee']['id'];?>" id="add_assignment_li_<?=$employee['Employee']['id'];?>"><?php
   echo $this->Js->link('Add Assignment',
      array('controller' => 'employee', 'action' => 'ajax_test'),
      array(
         'update' => '#employee_container',
         'evalScripts' => true,
        'before' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeOut', array('buffer' => false)),
      )
   );
?></li>
<li>|</li>
    <li class="links_li_<?=$employee['Employee']['id'];?>" id="check_assignment_li_<?=$employee['Employee']['id'];?>"><?php
   echo $this->Js->link('Check Assignment',
      array('controller' => 'employee', 'action' => 'ajax_test'),
      array(
         'update' => '#employee_container',
         'evalScripts' => true,
        'before' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeOut', array('buffer' => false)),
      )
   );
?></li>
<li>|</li>
    <li class="links_li_<?=$employee['Employee']['id'];?>" id="view_salary_li_<?=$employee['Employee']['id'];?>"><?php
   echo $this->Js->link('View Salary Records',
      array('controller' => 'employee', 'action' => 'ajax_test'),
      array(
         'update' => '#employee_container',
         'evalScripts' => true,
        'before' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeOut', array('buffer' => false)),
      )
   );
?></li>
<li>|</li>
    <li class="links_li_<?=$employee['Employee']['id'];?>" id="export_pdf_li_<?=$employee['Employee']['id'];?>"><?php
   echo $this->Js->link('Export Details in PDF',
      array('controller' => 'employee', 'action' => 'ajax_test'),
      array(
         'update' => '#employee_container',
         'evalScripts' => true,
        'before' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeOut', array('buffer' => false)),
      )
   );
?></li>
<li>|</li>
    <li class="links_li_<?=$employee['Employee']['id'];?>" id="generate_payslip_li_<?=$employee['Employee']['id'];?>"><?php
   echo $this->Js->link('Generate Payslip',
      array('controller' => 'employees', 'action' => 'generate_payslip',$employee['Employee']['id']),
      array(
         'update' => '#employee_container_'.$employee['Employee']['id'],
         'evalScripts' => true,
        'before' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeOut', array('buffer' => false)),
      )
   );
?></li>
<li>|</li>
    <li class="links_li_<?=$employee['Employee']['id'];?>" id="payslip_advance_li_<?=$employee['Employee']['id'];?>"><?php
   echo $this->Js->link('Advance Salary',
      array('controller' => 'employees', 'action' => 'advance_salary',$employee['Employee']['id']),
      array(
         'update' => '#employee_container_'.$employee['Employee']['id'],
         'evalScripts' => true,
        'before' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeOut', array('buffer' => false)),
      )
   );
?></li>
<li>|</li>
    <li class="links_li_<?=$employee['Employee']['id'];?>" id="loan_li_<?=$employee['Employee']['id'];?>"><?php
   echo $this->Js->link('Loan',
      array('controller' => 'employees', 'action' => 'loan',$employee['Employee']['id']),
      array(
         'update' => '#employee_container_'.$employee['Employee']['id'],
         'evalScripts' => true,
        'before' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#link_busy-indicator'.$employee['Employee']['id'])->effect('fadeOut', array('buffer' => false)),
      )
   );
?></li>
</ul>
<script language="javascript" type="text/javascript">
jQuery(document).ready(function() {                               
jQuery('.links_li_<?=$employee['Employee']['id'];?>').css('font-weight','normal');
jQuery('#employee_details_li_<?=$employee['Employee']['id'];?>').css('font-weight','bold');
});
</script>
<div style="clear:both;float:left;display:inline;margin:5px 0 0 10px"><?=$this->Html->image('updating.gif',array('alt'=>'Updating...','id' => 'link_busy-indicator'.$employee['Employee']['id'],'class'=>'link_busy-indicator'));?></div>
</div>

<div class="employee_contianer" id="employee_container_<?=$employee['Employee']['id'];?>">
    <div class="personal_details" id="personal_details">
        <div class="header_bar" style="line-height:25px;font-size:13px"><b>Personal Details</b>
        <p class="edit"><a href="#" id="personal_edit_<?=$employee['Employee']['id'];?>" onclick="collaspe('personal_edit_<?=$employee['Employee']['id'];?>','personal_details_hide_<?=$employee['Employee']['id'];?>');return false">[-]</a></p>
         <p class="edit">
<?= $this->Js->link('Edit',
      array('controller' => 'employees', 'action' => 'personal_details_edit',$employee['Employee']['id']),
      array(
         'update' => '#personal_details_hide_'.$employee['Employee']['id'],
         'evalScripts' => true,
        'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)),
      )
   );
 echo $this->Js->writeBuffer();  
?>


</p>
        </div>
        <div class="personal_details_hide" id="personal_details_hide_<?=$employee['Employee']['id'];?>">
        <div class="header_box"></div>
        <div class="ne_box_background">
    <div class="employee_pic">
<p id="profile_pic_p_<?=$employee['Employee']['id'];?>"><?= $this->Html->image('/files/pic/medium/'.$employee['Employee']['image'],array('alt' => 'Display Image'));?></p>
      <div class="profile_picture_edit">



<input id="file_upload_<?=$employee["Employee"]["id"];?>"  type="file" name="file_upload_<?=$employee["Employee"]["id"];?>" />

<span><a href="javascript:jQuery('#file_upload_<?=$employee['Employee']['id'];?>').uploadifyUpload()">Upload Image</a></span> 
<script language="javascript" type="text/javascript">
// <![CDATA[

jQuery(document).ready(function() {

  jQuery('#file_upload_<?=$employee["Employee"]["id"];?>').uploadify({
'debug'    : true,
    'uploader'  : '/payroll/swf/uploadify.swf',

    'script'    : "/payroll/employees/upload_pic/<?=$se_id;?>/<?=$employee['Employee']['id'];?>",

    'cancelImg' : '/payroll/img/cancel.png',

    'folder'    : '/payroll/files/pic',

    'auto'      : true,
    
    'fileExt': '*.jpg;*.jpeg;*.png;*.gif',
    'sizeLimit'   : 204800,
    'onComplete': function(event,id,fileObj,response,data){
        //console.log(fileObj);
       // var responseObj = jQuery.parseJSON(response);
       // console.log(responseObj);
        //jQuery('#upload-complete').html(responseObj.message);
        jQuery('#profile_pic_p_<?=$employee['Employee']['id'];?>').html(response);
        jQuery('#VideoName').val(responseObj.name);
        jQuery('.submit input').attr('disabled',false);
    },
    'buttonText': 'Choose image',



  });

});

// ]]>
</script>
</div>  
        
  
    
   
        </div>
  
<div class="employee_personal_info" id="employee_personal_info"> 
    <ul>
  <li><div class="employee_info_box"><p>Employee Id : <?=$employee['Employee']['emp_id'];?></p> </div></li>  	
  <li><div class="employee_info_box"><p>Name : <?=$employee['Employee']['fname'];?> <?=$employee['Employee']['lname'];?></p> </div></li>
  <li><div class="employee_info_box"><p>Sex : <?=$employee['Employee']['sex'];?> </p> </div></li>
  <li><div class="employee_info_box"><p>Phone Number : Home - <?=$employee['Employee']['phone'];?> Mobile - <?=$employee['Employee']['mobile'];?> </p> </div></li>
  <li><div class="employee_info_box"><p>Address : <?=$employee['Employee']['address'];?></p> </div></li>
  <li><div class="employee_info_box"><p>Email : <?=$employee['Employee']['email'];?> </p> </div></li>
  <li><div class="employee_info_box"><p>Date of Birth : <? $dob=explode("-",$employee['Employee']['dob']); echo $dob[2].'/'.$dob[1].'/'.$dob[0];?> 
      Age : <? list($year,$month,$day) = explode("-",$employee['Employee']['dob']);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($day_diff < 0 || $month_diff < 0)
      $year_diff--;       
	   echo  $year_diff;?> </p> </div>             
  </li>
  <li><div class="employee_info_box"><p>Blood Group : <?=$employee['Employee']['blood_group'];?> </p> </div></li>
  </ul>

</div>  

<div style="clear:both;height:20px"></div>   
        </div>
    </div>
    
     
</div>
 <!--personal_details ends-->  

<div class="employment_details" id="employment_details">
  <div class="header_bar" style="line-height:25px;font-size:13px"><b>Employment Details</b>
        <p class="edit"><a href="#" id="employment_edit_<?=$employee['Employee']['id'];?>" onclick="collaspe('employment_edit_<?=$employee['Employee']['id'];?>','employment_details_hide_<?=$employee['Employee']['id'];?>');return false">[-]</a></p>
         <p class="edit">
<?= $this->Js->link('Edit',
      array('controller' => 'employees', 'action' => 'employment_details_edit',$employee['Employee']['id']),
      array(
         'update' => '#employment_details_hide_'.$employee['Employee']['id'],
         'evalScripts' => true,
        'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)),
      )
   );
   echo $this->Js->writeBuffer(); 
?>


</p>
        </div>
        <div class="employment_details_hide" id="employment_details_hide_<?=$employee['Employee']['id'];?>">
        <div class="header_box"></div>
        <div class="ne_box_background">
    
  
<div class="employee_employment_info" id="employee_employment_info"> 
    <ul>
  <li><div class="employee_info_box2"><p>Designation : <?=$employee['Employee']['designation'];?></p> </div></li>
  <li><div class="employee_info_box2"><p>Department : <?=$employee['Employee']['department'];?> </p> </div></li>
  <li><div class="employee_info_box2"><p>Shift Timing : <?=$employee['Employee']['shift'];?> </p> </div></li>
  <li><div class="employee_info_box2"><p>Net Salary : Rs. <?=$employee['Employee']['net_salary'];?> &nbsp;&nbsp;&nbsp;PF : Rs. <?=$employee['Employee']['pf'];?> &nbsp;&nbsp;&nbsp;&nbsp;ESI : Rs. <?=$employee['Employee']['esi'];?> &nbsp;&nbsp;&nbsp;&nbsp;TDS : Rs. <?=$employee['Employee']['income_tax'];?></p> </div></li>
  <li><div class="employee_info_box2"><p>Medical Allowance : Rs. <?=$employee['Employee']['medical_allowance'];?> </p> </div></li>
  <li><div class="employee_info_box2"><p>Tiffin Allowance : Rs. <?=$employee['Employee']['tiffin'];?> </p> </div></li>
  <li><div class="employee_info_box2"><p>House Rent Allowance : Rs. <?=$employee['Employee']['house_rent'];?> </p> </div></li>
  <li><div class="employee_info_box2"><p>Medical Allowance : Rs. <?=$employee['Employee']['medical_allowance'];?> </p> </div></li>
  <li><div class="employee_info_box2"><p>Education Allowance : Rs. <?=$employee['Employee']['education'];?> </p> </div></li>
  <li><div class="employee_info_box2"><p>Entertainment Allowance : Rs. <?=$employee['Employee']['entertainment'];?> </p> </div></li>
  <li><div class="employee_info_box2"><p>Joining Date : <? $jd= explode("-",$employee['Employee']['joining_date']); echo $jd[2].'/'.$jd[1].'/'.$jd[0];?> </p> </div></li>
  <li><div class="employee_info_box"><p>Employment Type : <?=$employee['Employee']['employee_type'];?> </p> </div></li>
  <li><div class="employee_info_box"><p>Current Status : <?=$employee['Employee']['current_status'];?> </p> </div></li>
  </ul>

</div>  

<div style="clear:both;height:20px"></div>   
</div>

    </div>
    
    
</div>
 <!--employment_details ends-->
</div>
<!--employee_contianer ends-->
<div style="clear:both;height:20px"></div>
<?endforeach;}else{?>
<div class="no_result"><p>The search didn't return any result.</p></div>	
<?}?>
