 <ul>    	
<?php echo $this->Form->create('Attendance',array('class'=>'attendance_mark','id'=>'attendance_mark_'.$this->request->data['Attendance']['employee_id'],'action' => 'edit_attendance',$id));?>
<?=$this->Form->input('Attendance.id', array('type' => 'hidden'));?> 
<?=$this->Form->input('Attendance.employee_id', array('type' => 'hidden'));?> 
<li><?= $this->Form->input('status',array('div' => array('class' => 'ne_select'),'options' => array(
        '1' =>  'Mark Present',       	
        '0' =>  'Mark Absent',
	        '2' =>  'Mark on Leave'
        )));?>
        
      </li> 
<li class="attendance_time_li">    <?= 
$this->Form->input('check_in', array(
	'id'=>'attendance_check_in',
    'class'=>'attendance_time',
   'timeFormat'=>'24',
    'label' => 'Check In','type'=>'time'));?>
</li>
<li class="attendance_time_li">    <?= 
$this->Form->input('check_out', array(
	'id'=>'attendance_check_out',
    'class'=>'attendance_time',
   'timeFormat'=>'24',
    'label' => 'Check Out','type'=>'time','empty' => 'Enter Latter'));?>
</li>
<li class="attendance_time_li"><?=$this->Form->input('overtime', array('type' => 'text','label'=>'Overtime(in hours)'));?> </li>   
 </ul>     	
 <div style="clear:both;float:left;display:inline;margin:35px 0 0 300px">
 <div id="#attendance_busy-indicator" style="margin-bottom:5px;display:none"><?=$this->Html->image('updating.gif',array('alt'=>'Updating...'));?></div>  
 	<? echo $this->Js->submit('update.png',
            array('form_id'=>'#attendance_mark_'.$this->request->data['Attendance']['employee_id'],
            	
                    'update' => '#today_attendance_'.$this->request->data['Attendance']['employee_id'], // element to update
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
<script type="text/javascript">
jQuery('#AttendanceStatus').change(function(){
if(jQuery(this).val()!=1){
	jQuery('.attendance_time_li').css('display','none');
}
else{jQuery('.attendance_time_li').css('display','');}

});
 jQuery(document).ready(function() {
if(jQuery('#AttendanceStatus').val()!=1){
jQuery('.attendance_time_li').css('display','none');
}
});	
</script>  