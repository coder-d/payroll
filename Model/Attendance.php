<?php

class Attendance extends AppModel {
    public $name = 'Attendance';
    
 function getAttendance($id=null){
 	$today= date('y/m/d');
$attendances = $this->find('first',array('conditions'=>array('Attendance.employee_id'=>$id,'Attendance.date'=>$today),'recursive' => '-1'));
            return $attendances;
       } 
function updateAttendance($data=null){
	
if(isset($data['Attendance']['status'])){	
if($data['Attendance']['status']!=1){
	unset($data['Attendance']['check_in']);
	unset($data['Attendance']['check_out']);
	}}
	$result=$this->save($data);
 
            return $result;
       }         
   

function attendanceSearch($data=null){
$search_date=$data['Attendance']['date']['year'].'-'.$data['Attendance']['date']['month'].'-'.$data['Attendance']['date']['day'];
$attendance = $this->find('first',array('conditions'=>array('Attendance.employee_id'=>$data['Attendance']['employee_id'],'Attendance.date'=>$search_date),'recursive' => '-1'));
            return $attendance;	
	
}
}
?>