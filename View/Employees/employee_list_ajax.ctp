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

<?$employee_id=$employee['Employee']['id'];?>
<script language="javascript" type="text/javascript">
// <![CDATA[

jQuery(document).ready(function() {
	
jQuery('.links_li_<?=$employee_id;?>').css('font-weight','normal');
jQuery('#employee_details_li_<?=$employee_id;?>').css('font-weight','bold');

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
