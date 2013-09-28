<div class="update_attendance" id="update_attendance_<?=$employee_id;?>">
<div class="header_bar"><b>Attendance for <?=date('d/m/y');?></b>
<p class="edit" id="attendance_edit_<?=$employee_id;?>"><?if($attendance){echo $this->Js->link('Edit',
      array('controller' => 'employees', 'action' => 'edit_attendance',$attendance['Attendance']['id']),
      array(
         'update' => '#today_attendance_'.$employee_id,
         'evalScripts' => true,
        'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)),
      )
   ); 
}?></p></div>
<div class="header_box"></div>
	
        <div class="ne_box_background">	

 <div class="today_attendance" id="today_attendance_<?=$employee_id;?>">   
 	 <?if(!$attendance){?>
 <ul>       	
<?php echo $this->Form->create('Attendance',array('class'=>'attendance_mark','id'=>'attendance_mark_'.$employee_id,'action' => 'update_attendance',$employee_id));?>
<li><?= $this->Form->input('status',array('id'=>'AttendanceStatus_'.$employee_id,'div' => array('class' => 'ne_select'),'options' => array(
        '1' =>  'Mark Present',       	
        '0' =>  'Mark Absent',
        '2' =>  'Mark on Leave'
        )));?>
        
      </li>
<li class="attendance_time_li_<?=$employee_id;?>">    <?= 
$this->Form->input('check_in', array(
	'id'=>'attendance_check_in',
    'class'=>'attendance_time',
   'timeFormat'=>'24',
    'label' => 'Check In','type'=>'time'));?>
</li>
<li class="attendance_time_li_<?=$employee_id;?>">    <?= 
$this->Form->input('check_out', array(
	'id'=>'attendance_check_out',
    'class'=>'attendance_time',
   'timeFormat'=>'24',
    'label' => 'Check Out','type'=>'time','empty' => 'Enter Latter'));?>
</li>
<li class="attendance_time_li_<?=$employee_id;?>"><?=$this->Form->input('overtime', array('type' => 'text','label'=>'Overtime(in hours)'));?> </li>   
 </ul>     	
 <div style="clear:both;float:left;display:inline;margin:35px 0 0 300px">
 <div id="#attendance_busy-indicator" style="margin-bottom:5px;display:none"><?=$this->Html->image('updating.gif',array('alt'=>'Updating...'));?></div>  
 	<? echo $this->Js->submit('update.png',
            array('form_id'=>'#attendance_mark_'.$employee_id,
            	'url'=>array('action'=>'update_attendance',$employee_id),
                    'update' => '#today_attendance_'.$employee_id,
                    'method' => 'POST',
        'before' => $this->Js->get('#attendance_busy-indicator')->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#attendance_busy-indicator')->effect('fadeOut', array('buffer' => false)),
            
                 
                )
            
        );?>
    <?php
   echo $this->Form->end();?>
 </div>
 <?}else{?>
<ul> 
 	<li><div class="employee_info_box"><p>Status : <?
	switch ($attendance['Attendance']['status']) {
	   case "0":
	    $status ='Absent';
	  break;
	   case "1":
	    $status ='Present';
	  break;
	   case "2":
	    $status ='On Leave';
	  break;
  }
echo $status;?></p> </div></li>  
	<?if($attendance['Attendance']['status']==1){?>
<li><div class="employee_info_box"><p>Check In : <?=$attendance['Attendance']['check_in'];?></p></div></li>
<?
if($attendance['Attendance']['check_out']['hour']!=null){?>
<li><div class="employee_info_box"><p>Check Out : <?=$attendance['Attendance']['check_out'];?></p></div></li>
<li><div class="employee_info_box"><p>Overtime : <?if($attendance['Attendance']['overtime']==null){$overtime='No Overtime';}else{$overtime=$attendance['Attendance']['overtime'].' hours';}
	echo $overtime;?>
</p></div></li>
</ul>

<?}else{?>
<?php echo $this->Form->create('Attendance',array('class'=>'attendance_mark','id'=>'attendance_mark','action' => 'edit_attendance',$attendance['Attendance']['id']));?>
<?=$this->Form->input('status', array('id'=>'AttendanceStatus_'.$employee_id,'type' => 'hidden','value'=>$attendance['Attendance']['status']));?>
<?=$this->Form->input('employee_id', array('type' => 'hidden','value'=>$employee_id));?>
<li class="attendance_time_li_<?=$employee_id;?>" style="margin-top:15px">    <?= 
$this->Form->input('check_out', array(
	'id'=>'attendance_check_out',
    'class'=>'attendance_time',
   'timeFormat'=>'24',
    'label' => 'Check Out','type'=>'time'));?>
</li> 
<li class="attendance_time_li_<?=$employee_id;?>"><?=$this->Form->input('overtime', array('type' => 'text','label'=>'Overtime(in hours)'));?> </li>   
</ul>
 <div style="clear:both;float:left;display:inline;margin:35px 0 0 300px">
 <div id="#attendance_busy-indicator" style="margin-bottom:5px;display:none"><?=$this->Html->image('updating.gif',array('alt'=>'Updating...'));?></div>  
 	<? echo $this->Js->submit('update.png',
            array('form_id'=>'#attendance_mark',
            	'url'=>array('action'=>'edit_attendance',$attendance['Attendance']['id']),
                    'update' => '#today_attendance_'.$employee_id,
                    'method' => 'POST',
        'before' => $this->Js->get('#attendance_busy-indicator')->effect('fadeIn', array('buffer' => false)),
 	    'complete' => $this->Js->get('#attendance_busy-indicator')->effect('fadeOut', array('buffer' => false)),
            
                 
                )
            
        );?>
    <?php
   echo $this->Form->end();?>
  </div>
<?}}?>
<?}?>	
     	 
 </div>
<div style="clear:both;height:10px"></div>  
</div>
<!--today_attendance ends-->

</div>
</div>
<!--update_attendance ends-->
<div class="search_attendance" id="search_attendance">
<div class="header_bar"><b>Search Atttendance</b></div>

<div class="header_box"></div>
	
        <div class="ne_box_background">	

 <div class="search_attendance_edit" id="search_attendance_edit_<?=$employee_id;?>"> 
 <ul>       	
<?php echo $this->Form->create('Attendance',array('class'=>'attendance_mark','id'=>'attendance_search_'.$employee_id,'action' => 'attendance_search'));?>
<?=$this->Form->input('employee_id', array('type' => 'hidden','value'=>$employee_id));?> 
<li><div class="ne_input_box"><?= 
$this->Form->input('date', array(
    'div'=>array('class'=>'ne_joining_date'),
    'dateFormat' => 'DMY',
    'label' => 'Attendance Date','type'=>'date'));?>  </div></li>
  </ul>
<div style="clear:both;float:left;display:inline;margin:35px 0 0 325px">
	
  <? echo $this->Js->submit('search.png',
            array('form_id'=>'#attendance_search_'.$employee_id,
            	'url'=>array('action'=>'attendance_search',),
                    'update' => '#search_attendance_result_'.$employee_id, // element to update
                                             // after form submission
                   //'data' => '$("#employee_employment_edit").closest("form").serialize()',
                   // 'async' => true,
                  //  'dataExpression'=>true,
                    'method' => 'POST',
            
                 
                )
            
        );?>
    <?php
   echo $this->Form->end();?>  
 </div>
 
 </div>
 <!--search_attendance_edit ends-->	
 <div style="clear:both;height:10px"></div>
 </div>
 
<div class="header_box"></div>
 
  <div class="ne_box_background">
 <div class="search_attendance_results" id="search_attendance_result_<?=$employee_id;?>">
 	
 
 </div>
  <!--search_attendance_results ends-->	
 <div style="clear:both;height:10px"></div>
 </div>
 
 </div>
<script type="text/javascript">
jQuery('#AttendanceStatus_<?=$employee_id;?>').change(function(){
if(jQuery(this).val()!=1){
	jQuery('.attendance_time_li_<?=$employee_id;?>').css('display','none');
}
else{jQuery('.attendance_time_li_<?=$employee_id;?>').css('display','');}

});
 jQuery(document).ready(function() {
jQuery('.links_li_<?=$employee_id;?>').css('font-weight','normal');
jQuery('#edit_attendance_li_<?=$employee_id;?>').css('font-weight','bold');
});	
</script>