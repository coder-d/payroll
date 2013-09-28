<?= $this->Html->css('jquery-ui-1.8.4.custom');?>
<?= $this->Html->script('swfobject');?>
<?php echo $this->Html->css('uploadify');?>
<? echo $this->Html->script('jquery.uploadify.v2.1.4.min');?>
<div class="employee_list">
<div class="employee_list_left">
<div class="employee_search_bar">
<p>Search Employee</p>
<ul>
<?php echo $this->Form->create('Employee',array('id'=>'employee_search','action' => 'employee_search'));?>
<li><label>Employee ID</label>
	<?=$this->Form->input('emp_id', array('label' => '','type'=>'text'));?> 
</li> 	
<li><label>First Name</label>
	<?=$this->Form->input('fname', array('label' => ''));?> 
</li>
<li><label>Middle Name</label>
	<?=$this->Form->input('mname', array('label' => ''));?> 
</li>
<li><label>Last Name</label>
	<?=$this->Form->input('lname', array('label' => ''));?> 
</li>
<li><label>Designation</label>
	<?=$this->Form->input('designation', array('class' => 'search_dropdown','label' => '','empty' => 'All'));?> 
</li>
<li><label>Department</label>
<?= $this->Form->input('department',array('class' => 'search_dropdown','label' => '','empty' => 'All'));?>
</li>
<li><label>Shift Timing</label>
<?= $this->Form->input('shift',array('class' => 'search_dropdown','label' => '','empty' => 'All'));?>
</li>
<li id="more_filters"><a href="" onclick="more_filters();return false"><p>More Filters</p></a>
</li>
<li class="more_filter"><label>Email</label>
<?= $this->Form->input('email',array('label' => ''));?>
</li>
<li class="more_filter"><label>Blood Group</label>
<?= $this->Form->input('blood_group',array('class' => 'search_dropdown','options' => array(
        'O-' =>  'O-',       	
        'O+' =>  'O+',
        'A-' =>  'A-',
        'A+' =>  'A+',
        'B-' =>  'B-',
        'B+' =>  'B+',
        'AB-' =>  'AB-',
        'AB+' =>  'AB+',
        ),'empty' => 'All','label'=>''));?>
</li>
<li class="more_filter"><label>Medical Insurance</label>
<?= $this->Form->input('medical_insurance',array('class' => 'search_dropdown','label'=>'','options'=>$medical_insurances,'empty' => 'All'));?>
</li>
<li class="more_filter"><label>Joining Date</label>
<?= 
$this->Form->input('joining_date', array(
	'id'=>'search_joining_date',
	'empty' => 'All',
    'class'=>'search_dropdown',
    'dateFormat' => 'DMY',
    'label' => '','type'=>'date'));?> 
</li>
<li class="more_filter"><label>Employment Type</label>
<?= $this->Form->input('employee_type',array('class' => 'search_dropdown','options'=>array(
    'Permanent'=>'Permanent',
    'Temporary'=>'temporary',
    'Contract'=>'Contract'
    ),'empty' => 'All','label'=>'',));?></li>
<li class="more_filter"><label>Current Status</label>
<?= $this->Form->input('current_status',array('class' => 'search_dropdown','options'=>array(
    'Active'=>'Active',
    'Not Active'=>'Not Active',
    'On Leave'=>'On Leave',
    'Suspended'=>'Suspended',
    'Terminated'=>'Terminated',
    ),'empty' => 'All','label'=>'',));?></li>

  </ul>
 <div style="margin:25px 0 0 60px">  
<?=$this->Html->image('updating.gif',array('alt'=>'Updating...','id' => 'search_busy-indicator'));?>
 	<? echo $this->Js->submit('search.png',
            array('form_id'=>'#employee_search',
            	'url'=>array('action'=>'employee_search'),
                    'update' => '#employee_list_right', // element to update
                    'method' => 'POST',
       'before' => $this->Js->get('#search_busy-indicator')->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#search_busy-indicator')->effect('fadeOut', array('buffer' => false)),    
            
                 
                )
            
        );?>
    <?php 
   echo $this->Form->end();?>
 </div>
</div>   
</div>

<div class="employee_list_right" id="employee_list_right">
<?if(isset($employee)){?>
<div class="employee_display_top">
   <p id="employee_display_top_image_<?=$employee['Employee']['id'];?>"> <?= $this->Html->image('/files/pic/small/'.$employee['Employee']['image'],array('alt' => 'Display Image','width'=>'24px','height'=>'31px'));?></p>
    <p><?$employee_name=$employee['Employee']['fname'];
    	 if($employee['Employee']['mname']!=null){$employee_name.=' '.$employee['Employee']['mname'];}
    	 $employee_name.=' '.$employee['Employee']['lname'];   	
    echo $employee_name;?></p>
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
      array(
         'update' => '#employee_container_'.$employee['Employee']['id'],
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
      array('controller' => 'employees', 'action' => 'ajax_test'),
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
<div style="clear:both;float:left;display:inline;margin:5px 0 0 10px"><?=$this->Html->image('updating.gif',array('alt'=>'Updating...','id' => 'link_busy-indicator'.$employee['Employee']['id'],'class' => 'link_busy-indicator'));?></div>
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



<input id="file_upload_<?=$employee['Employee']['id'];?>"  type="file" name="file_upload_<?=$employee['Employee']['image'];?>" />

<span><a href="javascript:jQuery('#file_upload_<?=$employee['Employee']['id'];?>').uploadifyUpload()">Upload Image</a></span> 
<script language="javascript" type="text/javascript">
// <![CDATA[

jQuery(document).ready(function() {

  jQuery('#file_upload_<?=$employee['Employee']['id'];?>').uploadify({
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
  <li><div class="employee_info_box"><p>Name : <?=$employee['Employee']['fname'];?> <?if($employee['Employee']['mname']!=null){echo $employee['Employee']['mname'];}?> <?=$employee['Employee']['lname'];?></p> </div></li>
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
    
    
</div><!--employment_details ends-->
</div><!--employee_contianer ends-->
<?}?>
</div><!--employee_list_right ends-->
</div><!--employee_list ends-->
<script language="javascript" type="text/javascript">

function collaspe(divid,tagname){

		var collaspe =jQuery('#'+divid).text();
		
		if(collaspe=='[-]'){
	
		jQuery('#'+tagname).css('display','none');
		jQuery('#'+divid).text('[+]');
		
		                    }
		else if(collaspe=='[+]'){
		jQuery('#'+divid).text('[-]');
		jQuery('#'+tagname).css('display','');
		
		                        }
		
                                }
                                
 jQuery(document).ready(function() {                               
jQuery('.more_filter').css('display','none');
jQuery('.links_li').css('font-weight','normal');
jQuery('#employee_details_li').css('font-weight','bold');


});
function more_filters(){
jQuery('#more_filters').css('display','none');
jQuery('.more_filter').css('display','');	
}
</script>

