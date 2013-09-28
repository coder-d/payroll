<?php

class SalaryRecord extends AppModel {
    public $name = 'SalaryRecord';

function salarySearch($id=null,$date=null){
$salary_record = $this->find('first',array('conditions'=>array('SalaryRecord.employee_id'=>$id,'SalaryRecord.salary_date'=>$date),'recursive' => '-1'));
            return $salary_record;	
	
}
function salaryPrintcopyUpdate($id=null,$print_copy=null){
$this->id=$id;
$update['SalaryRecord']['print_copy']=$print_copy;
$result=$this->save($update);
return $result;
}
function salaryRecordCreate($data=null){
$this->create();
$result=$this->save($data);
return $result;
}
function salaryRecordUpdate($id=null,$data=null){
$this->id=$id;
$result=$this->save($data);
return $result;
}

}
?>