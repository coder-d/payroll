<div class="header_box"></div>
        <div class="ne_box_background">
    <div class="employee_pic">
<p id="profile_pic_p"><?= $this->Html->image('/files/pic/medium/'.$employee['Employee']['image'],array('alt' => 'Display Image'));?></p>
      <div class="profile_picture_edit">

<input id="file_upload"  type="file" name="file_upload" />

<span><a href="javascript:jQuery('#file_upload').uploadifyUpload()">Upload Image</a></span> 

</div>  
        
  
    
   
        </div>
  
<div class="employee_personal_info" id="employee_personal_info"> 
    <ul>
  <li><div class="employee_info_box"><p>Employee Id : <?=$employee['Employee']['emp_id'];?></p> </div></li>  	
  <li><div class="employee_info_box"><p>Name : <?=$employee['Employee']['fname'];?> <?if($employee['Employee']['mname']!=null){echo $employee['Employee']['mname'];}?> <?=$employee['Employee']['lname'];?></p> </div>
  <li><div class="employee_info_box"><p>Sex : <?=$employee['Employee']['sex'];?> </p> </div>
  <li><div class="employee_info_box"><p>Phone Number : Home - <?=$employee['Employee']['phone'];?> Mobile - <?=$employee['Employee']['mobile'];?> </p> </div>
  <li><div class="employee_info_box"><p>Address : <?=$employee['Employee']['address'];?></p> </div>
  <li><div class="employee_info_box"><p>Email : <?=$employee['Employee']['email'];?> </p> </div>
  <li><div class="employee_info_box"><p>Date of Birth : <?  echo $employee['Employee']['dob']['day'].'/'.$employee['Employee']['dob']['month'].'/'.$employee['Employee']['dob']['year'];?> 
      Age : <? 
      $employee['Employee']['dob']=$employee['Employee']['dob']['day'].'-'.$employee['Employee']['dob']['month'].'-'.$employee['Employee']['dob']['year'];
      list($day,$month,$year) = explode("-",$employee['Employee']['dob']);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($day_diff < 0 || $month_diff < 0)
      $year_diff--;       
	   echo  $year_diff;?> </p> </div>      
  </li>
  <li><div class="employee_info_box"><p>Blood Group : <?=$employee['Employee']['blood_group'];?> </p> </div>
  </ul>

</div>  

<div style="clear:both;height:20px"></div>  

<script language="javascript" type="text/javascript">


// <![CDATA[

jQuery(document).ready(function() {

  jQuery('#file_upload').uploadify({
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
        jQuery('#profile_pic_p').html(response);
        jQuery('#VideoName').val(responseObj.name);
        jQuery('.submit input').attr('disabled',false);
    },
    'buttonText': 'Choose image',



  });

});

// ]]>
</script> 