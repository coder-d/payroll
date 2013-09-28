<?if(isset($update_msg)){
	if($update_msg=='success'){?>
<div class="success"><p>Attendance updated successfully</p></div>

<ul style="clear:both">
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
<?if($attendance['Attendance']['check_out']['hour']!=null){?>
<li><div class="employee_info_box"><p>Check Out : <?=$attendance['Attendance']['check_out'];?></p></div></li>
<li><div class="employee_info_box"><p>Overtime : <?if($attendance['Attendance']['overtime']==null){$overtime='No Overtime';}else{$overtime=$attendance['Attendance']['overtime'].' hours';}
	echo $overtime;?>
</p></div></li>
<?}else{?>
<?php echo $this->Form->create('Attendance',array('class'=>'attendance_mark','id'=>'attendance_mark_'.$employee_id,'action' => 'edit_attendance',$attendance['Attendance']['id']));?>
<?=$this->Form->input('status', array('id'=>'AttendanceStatus_'.$employee_id,'type' => 'hidden','value'=>$attendance['Attendance']['status']));?>
<?=$this->Form->input('employee_id', array('type' => 'hidden','value'=>$employee_id));?>
<li class="attendance_time_li_<?=$employee_id;?>" style="margin-top:15px">    <?= 
$this->Form->input('check_out', array(
	'id'=>'attendance_check_out',
    'class'=>'attendance_time',
   'timeFormat'=>'24',
    'label' => 'Check Out','type'=>'time'));?>
</li>
<li class="attendance_time_li_<?=$employee_id;?>"><?=$this->Form->input('overtime', array('type' => 'text','label'=>'Overtime(in hours)'));?></li>   
</ul>
 <div style="clear:both;float:left;display:inline;margin:35px 0 0 300px">
 <div id="#attendance_busy-indicator" style="margin-bottom:5px;display:none"><?=$this->Html->image('updating.gif',array('alt'=>'Updating...'));?></div>  
 	<? echo $this->Js->submit('update.png',
            array('form_id'=>'#attendance_mark_'.$employee_id,
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

<?}elseif($update_msg=='fail'){?>
<div class="error-message"><p>Attendance not updated, please try again</p></div>
<?}}?>
<div style="clear:both;height:10px"></div>