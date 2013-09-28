<?php
class Loan extends AppModel {
    public $name = 'Loan';
    
     public $validate = array(
     	'loan_amount' => array(
            'Numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter a valid Loan Amount',
                'allowEmpty' => false
            )),
            'interest_percent' => array(
            'Numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter a valid Loan Interest Percent',
                'allowEmpty' => false
            )),
            
          'repay_period' => array(
            'Numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter a valid Repay Period',
                'allowEmpty' => false
            ))  
     	);
     	
 function LoanEntry($data=null){
$res=$this->find('first',array('conditions'=>array('Loan.employee_id'=>$data['employee_id'])));
if($data['interest_percent']!=0){
$data['loan_amount']+=($data['loan_amount']*$data['interest_percent'])/100;
}
if($res['Loan']['id']){
$this->id=$res['Loan']['id'];
$data['loan_amount']+=$res['Loan']['loan_amount'];
$data['repay_period']+=$res['Loan']['repay_period'];
}
else{$this->create();};
$data['loan_date']=date('y-m-d');
$result=$this->save($data);
return $result;
}   

function loanEntryUpdate($data=null){
$result=$this->updateAll(array('Loan.loan_amount' =>'Loan.loan_amount - '.$data['loan_amount']), array('Loan.employee_id' => $data['employee_id']));	
 return $result;	
} 	
}
?>