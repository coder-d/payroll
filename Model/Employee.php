<?php

class Employee extends AppModel {
    public $name = 'Employee';
    
 var $hasMany = array(	
		   
		'Attendance'=> array(
			'className' => 'Attendance',
			'foreignKey' => 'employee_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'limit' => 1,
			'order'=>'Attendance.id DESC',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
        		),
        	'SalaryRecord'=> array(
			'className' => 'SalaryRecord',
			'foreignKey' => 'employee_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'limit' => 1,
			'order'=>'SalaryRecord.id DESC',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
        		),	
			        );
	var $hasOne = array(	
		   
		'Loan'=> array(
			'className' => 'Loan',
			'foreignKey' => 'employee_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
        		)
        		);		        
        		
        		   
    public $validate = array(
        'fname' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'First Name is required'
            )
        ),
        'lname' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'last Name is required'
            )
        ),
        'mobile' => array(
            'Numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter a valid Mobile Number',
                'allowEmpty' => false
            ),
            'minLength' => array(
            'rule'    => array('minLength', 10),
            'message' => 'Please enter a valid Mobile Number'
        ),
         'maxLength' => array(
            'rule'    => array('maxLength', 10),
            'message' => 'Please enter a valid Mobile Number'
        )
        
        ),
        'phone' => array(
           'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please enter a valid Phone Number'
            )
        ),
         'address' => array(
           'Length' => array(
            'rule'    => array('minLength', 5),
                'message' => 'Please enter a valid Address'
            )
        ),
         'email' => array(
           'Email' => array(
            'rule'    => array('email'),
                'message' => 'Please enter a valid Email Id'
            )
        ),
        'net_salary' => array(
           'Numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter a valid Net Salary amount',
                'allowEmpty' => false
            )
        ),
        'pf' => array(
           'Numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter a valid Provident Fund amount',
                'allowEmpty' => true
            )
        ),
        'esi' => array(
           'Numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter a valid ESI amount',
                'allowEmpty' => true
            )
        ),
         'income_tax' => array(
         	
         	 'Between' => array(
                'rule' => array('percent'),
                'message' => 'Please enter a valid Income Tax percentssss',
                'allowEmpty' => false
            ),
           'Numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter a valid Income Tax percent',
                'allowEmpty' => false
            )
           
            ), 
       
        'medical_allowance' => array(
           'Numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter a valid Medical Allowance amount',
                'allowEmpty' => true
            )
        ),
         'tiffin' => array(
           'Numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter a valid Tiffin Allowance amount',
                'allowEmpty' => true
            )
        ),
         'house_rent' => array(
           'Numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter a valid House Rent Allowance amount',
                'allowEmpty' => true
            )
        ),
         'education' => array(
           'Numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter a valid Education Allowance amount',
                'allowEmpty' => true
            )
        ),
         'entertainment' => array(
           'Numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter a valid Entertainment Allowance amount',
                'allowEmpty' => true
            )
        ),
        
        
    );
    
    function percent(){
    	if($this->data['Employee']['income_tax']<0||$this->data['Employee']['income_tax']>100){
    		
    		return false;
    	}
    	return true;
    }
    function employeeSearch($id=null){
$employee = $this->find('first',array('conditions'=>array('Employee.id'=>$id),'recursive' => '-1'));
            return $employee;	
	
}
function employeeSalarySearch($id=null,$salary_date=null){
$this->unbindModel(array('hasMany' => array('Attendance'),'hasOne'=>array('Loan')));


	$employee = $this->find('first',array('conditions'=>array('Employee.id'=>$id),'contain'=>array('SalaryRecord'=>array(
                             'conditions' => array('SalaryRecord.salary_date' =>$salary_date))
                    )));
            return $employee;
	
}
function employeeLoanSearch($id=null){
$this->unbindModel(array('hasMany' => array('Attendance','SalaryRecord')));	

$employee = $this->find('first',array('conditions'=>array('Employee.id'=>$id)));
            return $employee;	
}
}
?>