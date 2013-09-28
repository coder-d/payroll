<?php

class EmployeesController extends AppController {
    
    public $components = array('Security','Email');
   public $helpers = array('Js','Paginator',);
    public $name = 'Employees';
    
 function beforeFilter(){ 
 	parent::beforeFilter();  
     if ($this->request->params['action'] == 'upload_pic') {
             $this->Session->id($this->request->params['pass'][0]);
            //$this->Session->start();
           /// $this->Security->validatePost = false;
          $this->Security->unlockedActions = array('upload_pic');
            
        }
 
 
  
  if ($this->RequestHandler->isAjax()||$this->request->params['action'] == 'upload_pic') {
    $this->Security->validatePost = false;
    $this->Security->csrfCheck = false; 
    //$this->Security->csrfExpires = false;
    //$this->Security->csrfUseOnce = false; 
}

}

  function index(){
      
      
  } 
function new_employee(){
    $this->loadModel('Department');
    $this->loadModel('Designation');
    $this->loadModel('ShiftTiming');
    $this->loadModel('MedicalInsurance');
    $this->set('departments', $this->Department->find('list',array('fields'=>array('dep_type','dep_type'))));
    $this->set('designations', $this->Designation->find('list',array('fields'=>array('desg_type','desg_type'))));
    $this->set('shifts',$this->ShiftTiming->find('list',array('fields'=>array('timing','timing'))));
    $this->set('medical_insurances',$this->MedicalInsurance->find('list',array('fields'=>array('type','type'))));
    if($this->request->data){
        $this->request->data['Employee']['image']='default.jpg';
        if($this->Employee->save($this->request->data)){
        $this->Employee->id;
        $this->request->data['Employee']['emp_id']='emp'.$this->Employee->id;
        
        if($this->Employee->save($this->request->data)){
    $this->redirect(array('action' => 'employee_list',$this->request->data['Employee']['emp_id']));  
                                                      }
                                                      }
        
    }  
                      }
function employee_list($emp_id=null,$ajax_req=null){
	$this->loadModel('Department');
    $this->loadModel('Designation');
    $this->loadModel('ShiftTiming');
    $this->loadModel('MedicalInsurance');
    $this->set('departments', $this->Department->find('list',array('fields'=>array('dep_type','dep_type'))));
    $this->set('designations', $this->Designation->find('list',array('fields'=>array('desg_type','desg_type'))));
    $this->set('shifts',$this->ShiftTiming->find('list',array('fields'=>array('timing','timing'))));
    $this->set('medical_insurances',$this->MedicalInsurance->find('list',array('fields'=>array('type','type'))));	

    if($emp_id){
$this->set('employee',$this->Employee->find('first',array('conditions'=>array('Employee.emp_id'=>$emp_id))));
        
    }
    
$this->set('se_id',$this->Session->id()); 

if($ajax_req==1){$this->render('employee_list_ajax','ajax');}
}
function upload_pic($session_id=null,$user_id=null){

$this->autoLayout = false;
//$this->autoRender = false;
 $this->set('employee_id',$user_id);
 
   if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	//$ext = substr($_FILES['Filedata']['name'], strrpos($_FILES['Filedata']['name'], '.') + 1);
	$image_info = getimagesize($_FILES['Filedata']['tmp_name']);
	//print_r($image_info);
	$file_new_name=time();
	
	if($image_info['mime']=='image/jpeg'){$original = imagecreatefromjpeg($_FILES['Filedata']['tmp_name']);}
elseif($image_info['mime']=='image/png'){$original = imagecreatefrompng($_FILES['Filedata']['tmp_name']);

 
}
elseif($image_info['mime']=='image/gif'){$original = imagecreatefromgif($_FILES['Filedata']['tmp_name']);}
else{exit();}


$new_images[0]='medium';
$new_images[1]='small';
foreach($new_images as $image):	
if($image=='medium'){$small=99;$large=111;}
else{$small=45;$large=47;}

 $ratioOrig = $image_info[0] / $image_info[1];
   if($ratioOrig<1){$width=$small;$height=$large;}
   elseif($ratioOrig==1){$width=$large;$height=$large;}
   else{$width=$large;$height=$small;}
	
		

$new_image = imagecreatetruecolor($width, $height);			
if($image_info['mime']=='image/png'){
		
		 $kek=imagecolorallocate($new_image, 255, 255, 255);
          imagefill($new_image,0,0,$kek);
	                                }
      imagecopyresampled($new_image, $original, 0, 0, 0, 0, $width, $height, $image_info[0], $image_info[1]);
      $createJpg = imagejpeg($new_image, $_SERVER['DOCUMENT_ROOT'] .'/payroll/webroot/files/pic/'.$image.'/'.$file_new_name.'.jpg', 80);
     ImageDestroy($new_image);
      
 endforeach;
  
     $original_upload = imagecreatetruecolor($image_info[0], $image_info[1]);   
  $kek=imagecolorallocate($original_upload, 255, 255, 255);
          imagefill($original_upload,0,0,$kek);	
          
     imagecopyresampled($original_upload, $original, 0, 0, 0, 0, $image_info[1], $image_info[1], $image_info[0], $image_info[1]);
    $createJpg = imagejpeg($original_upload, $_SERVER['DOCUMENT_ROOT'] .'/payroll/webroot/files/pic/'.$file_new_name.'.jpg', 80);
      
		
$this->Employee->id=$user_id;
$this->request->data['Employee']['image']=$file_new_name.'.jpg';
$this->Employee->save($this->request->data);
//$path='/files/pic/'.$file_new_name.'.jpg';


//App::import('Helper', 'Html');
$this->set('file_new_name',$file_new_name);
//path='/files/pic/'.$file_new_name.'.jpg';
//$html = new HtmlHelper(new View(null));
//echo $html->image($path,array('alt'=>'Profile pic'));
	
	

	
	
	// $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	// $fileTypes  = str_replace(';','|',$fileTypes);
	// $typesArray = split('\|',$fileTypes);
	// $fileParts  = pathinfo($_FILES['Filedata']['name']);
	
	// if (in_array($fileParts['extension'],$typesArray)) {
		// Uncomment the following line if you want to make the directory if it doesn't exist
		// mkdir(str_replace('//','/',$targetPath), 0755, true);
		
		//move_uploaded_file($tempFile,$targetFile);
		//echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
	// } else {
	// 	echo 'Invalid file type.';
	// }
}
}
function personal_details_edit($id=null){    
$this->loadModel('Department');
    $this->loadModel('Designation');
    $this->loadModel('ShiftTiming');
    $this->loadModel('MedicalInsurance');
    $this->set('departments', $this->Department->find('list',array('fields'=>array('dep_type','dep_type'))));
    $this->set('designations', $this->Designation->find('list',array('fields'=>array('desg_type','desg_type'))));
    $this->set('shifts',$this->ShiftTiming->find('list',array('fields'=>array('timing','timing'))));
    $this->set('medical_insurances',$this->MedicalInsurance->find('list',array('fields'=>array('type','type'))));    
$this->Employee->id = $id; 
   if (empty($this->data)) { 
    $this->data = $this->Employee->read(); 
      
  
                           }
            else {  
              if ($this->Employee->save($this->data)) 
                {  $this->set('employee',$this->data);
                   $this->set('se_id',$this->Session->id());
                    $this->render('personal_details_edit_success','ajax');
                
                    } 
                       
          
                 }    
    
    
}
function employment_details_edit($id=null){ 
    
    $this->loadModel('Department');
    $this->loadModel('Designation');
    $this->loadModel('ShiftTiming');
    $this->loadModel('MedicalInsurance');
    $this->set('departments', $this->Department->find('list',array('fields'=>array('dep_type','dep_type'))));
    $this->set('designations', $this->Designation->find('list',array('fields'=>array('desg_type','desg_type'))));
    $this->set('shifts',$this->ShiftTiming->find('list',array('fields'=>array('timing','timing'))));
    $this->set('medical_insurances',$this->MedicalInsurance->find('list',array('fields'=>array('type','type'))));    
$this->Employee->id = $id; 
   if (empty($this->data)) { 
    $this->data = $this->Employee->read(); 
 
  
                           }
            else { 
              if ($this->Employee->save($this->data)) 
                {  $this->set('employee',$this->data);
                
                    $this->render('employment_details_edit_success','ajax');
                
                    } 
                     
          
                 }    
    

   
}
function employee_search(){
$this->set('se_id',$this->Session->id()); 

if(empty($this->request->data['Employee']['fname'])){
$condition1=array( "Employee.fname LIKE" => "%" );}
else{$condition1=array( "Employee.fname LIKE" => "%{$this->request->data['Employee']['fname']}%" );}

if(empty($this->request->data['Employee']['lname'])){
$condition2=array( "Employee.lname LIKE" => "%" );}
else{$condition2=array( "Employee.lname LIKE" => "%{$this->request->data['Employee']['lname']}%" );}

if(empty($this->request->data['Employee']['designation'])){
$condition3=array( "Employee.designation LIKE" => "%" );}
else{$condition3=array( "Employee.designation LIKE" => "%{$this->request->data['Employee']['designation']}%" );}


if(empty($this->request->data['Employee']['department'])){
$condition4=array( "Employee.department LIKE" => "%" );}
else{$condition4=array( "Employee.department LIKE" => "%{$this->request->data['Employee']['department']}%" );}


if(empty($this->request->data['Employee']['shift'])){
$condition5=array( "Employee.shift LIKE" => "%" );}
else{$condition5=array( "Employee.shift LIKE" => "%{$this->request->data['Employee']['shift']}%" );}


if(empty($this->request->data['Employee']['email'])){
$condition6=array( "Employee.email LIKE" => "%" );}
else{$condition6=array( "Employee.email LIKE" => "%{$this->request->data['Employee']['email']}%" );}


if(empty($this->request->data['Employee']['blood_group'])){
$condition7=array( "Employee.blood_group LIKE" => "%" );}
else{$condition7=array( "Employee.blood_group LIKE" => "%{$this->request->data['Employee']['blood_group']}%" );}


if(empty($this->request->data['Employee']['medical_insurance'])){
$condition8=array( "Employee.medical_insurance LIKE" => "%" );}
else{$condition8=array( "Employee.medical_insurance LIKE" => "%{$this->request->data['Employee']['medical_insurance']}%" );}

if(empty($this->request->data['Employee']['joining_date']['day'])||empty($this->request->data['Employee']['joining_date']['month'])||empty($this->request->data['Employee']['joining_date']['year'])){
$condition9=array( "Employee.joining_date LIKE" => "%" );}
else{$condition9=array( "Employee.joining_date" =>$this->request->data['Employee']['joining_date']['year'].'-'.$this->request->data['Employee']['joining_date']['month'].'-'.$this->request->data['Employee']['joining_date']['day']);}

if(empty($this->request->data['Employee']['employee_type'])){
$condition10=array( "Employee.employee_type LIKE" => "%" );}
else{$condition10=array( "Employee.employee_type LIKE" => "%{$this->request->data['Employee']['employee_type']}%" );}

if(empty($this->request->data['Employee']['current_status'])){
$condition11=array( "Employee.current_status LIKE" => "%" );}
else{$condition11=array( "Employee.current_status LIKE" => "%{$this->request->data['Employee']['current_status']}%" );}

if(empty($this->request->data['Employee']['emp_id'])){
$condition12=array( "Employee.emp_id LIKE" => "%" );}
else{$condition12=array( "Employee.emp_id LIKE" => "%{$this->request->data['Employee']['emp_id']}%" );}

$esconditions =array($condition1,$condition2,$condition3,$condition4,$condition5,$condition6,$condition7,$condition8,$condition9,$condition10,$condition11,$condition12);

$this->paginate = array(
'conditions'=>$esconditions,
'limit' => 2,
'order'=>'Employee.created DESC'
);
    	
    	$this->set('employees',$this->paginate('Employee'));


 } 
function update_attendance($id=null,$attendance_id=null){
$this->set('employee_id',$id);
$this->set('attendance',$this->Employee->Attendance->getAttendance($id));

if($this->request->data){//debug($this->data);
	$this->request->data['Attendance']['employee_id']=$id;
	$se=$this->Session->read("Auth");
	if($attendance_id!=null){$this->request->data['Attendance']['id']=$attendance_id;}
	$this->request->data['Attendance']['user_id']=$se['User']['id'];
	if(!isset($this->request->data['Attendance']['date'])){$this->request->data['Attendance']['date']=date('y/m/d');}
if($this->Employee->Attendance->updateAttendance($this->request->data)){
	    $this->set('update_msg','success');
		$this->set('attendance',$this->Employee->Attendance->getAttendance($id));
		
		}else{
	    $this->set('update_msg','fail');
		$this->request->data = $this->request->data;}		
$this->render('update_attendance_ajax','ajax');
	
}
} 

function edit_attendance($id=null){
$this->set('id',$id);
$this->Employee->Attendance->id = $id; 
   if (empty($this->request->data)) { 
    $this->request->data = $this->Employee->Attendance->read(); 
      
  
                           }
            else {
              if ($this->Employee->Attendance->updateAttendance($this->request->data)) 
                {  
                   $this->set('attendance_id',$id);
	               $this->set('update_msg','success');
		           $this->set('attendance',$this->Employee->Attendance->read());
		           $this->set('employee_id',$this->request->data['Attendance']['employee_id']);
                   $this->render('update_attendance_ajax','ajax');        
                    } 
                       
          
                 }  
}
function attendance_search(){
$this->set('employee_id',$this->request->data['Attendance']['employee_id']);
$search_date=$this->request->data['Attendance']['date']['year'].'-'.$this->request->data['Attendance']['date']['month'].'-'.$this->request->data['Attendance']['date']['day'];
$this->set('search_date',$search_date);	
$res=$this->Employee->Attendance->attendanceSearch($this->request->data);
$this->request->data=$res;
}
 function view_attendance($id=null){
 $this->set('employee_id',$id);
 	

}
function view_attendance_calendar($id=null){
//http://www.debanjansg.com/payroll/employees/view_attendance/mycal?_=1300282786365&start=1304188200&end=1307817000
$mysqlstart = date( 'Y-m-d H:i:s',$this->request->query['start']);
     
$mysqlend = date( 'Y-m-d H:i:s',$this->request->query['end']);	
$attendances= $this->Employee->Attendance->find('all',array('conditions'=>array('Attendance.employee_id'=>$id,'Attendance.date BETWEEN ? AND ?'
=> array($mysqlstart,$mysqlend)
)));
       $rows = array();
     foreach($attendances as $attendance):
     switch ($attendance['Attendance']['status']) {
	   case "0":
	    $status ='Absent';$check_in='';$check_out='';$overtime='';$title_class='title_absent';
	  break;
	   case "1":
	    $status ='Present';$check_in='Check In : '.$attendance['Attendance']['check_in'];$check_out='Check Out : '.$attendance['Attendance']['check_out'];
	    if($attendance['Attendance']['overtime']==null){$ot=0;}else{$ot=$attendance['Attendance']['overtime'];}
	    $overtime='Overtime : '.$ot.' hour(s)';$title_class='title_present';
	  break;
	   case "2":
	    $status ='On Leave';$check_in='';$check_out='';$overtime='';$title_class='title_leave';
	  break;
  }
$rows[] = array('id' => $attendance['Attendance']['id'],
'title' => '<p class="'.$title_class.'">'.$status.'<br/><br/>'.$check_in.'<br/><br/>'.$check_out.'<br/><br/>'.$overtime.'</p>',
'start' => date('Y-m-d H:i', strtotime($attendance['Attendance']['date'])),
'end' => date('Y-m-d H:i',strtotime($attendance['Attendance']['date'])),
'allDay' =>1
//'url'=>'/spare/events/profile/'.$events[$a]['Event']['name'].'/'.$events[$a]['Event']['id'],
    );	
 endforeach;   
 //Return as a json array
Configure::write('debug',0);
$this->autoRender = false;
$this->autoLayout = false;
$this->header('Content-Type: application/json');
echo json_encode($rows);   
} 

function generate_payslip($id=null){
$this->set('employee_id',$id);	
$salary_date= date('m-Y',strtotime("-1months"));
$this->set('salary_date',$salary_date);
$employee=$this->Employee->employeeLoanSearch($id);
$this->set('employee',$employee);
$res=$this->Employee->SalaryRecord->salarySearch($id,$salary_date);
//This is useful if advance is taken,otherwise salaryrecord would be null
$this->set('advance_amount',$res['SalaryRecord']['advance_amount']);
if($res['SalaryRecord']['payslip_generated']==0){
$this->set('salaryrecord',0);

}
else{$this->set('salaryrecord',$res['SalaryRecord']);
$earnings=$res['SalaryRecord']['basic']+$res['SalaryRecord']['da']+$res['SalaryRecord']['bonus']+$res['SalaryRecord']['medical_allowance']+$res['SalaryRecord']['tiffin']+$res['SalaryRecord']['house_rent']+$res['SalaryRecord']['education']+$res['SalaryRecord']['entertainment'];
$deductions=$res['SalaryRecord']['pf']+$res['SalaryRecord']['esi']+$res['SalaryRecord']['income_tax']+$res['SalaryRecord']['advance_amount']+$res['SalaryRecord']['loan_amount'];
$actual_total_earnings=$earnings-$deductions;
$this->set('earnings',$actual_total_earnings);
}

$earnings=$employee['Employee']['net_salary']+$employee['Employee']['da']+$employee['Employee']['bonus']+$employee['Employee']['medical_allowance']+$employee['Employee']['tiffin']+$employee['Employee']['house_rent']+$employee['Employee']['education']+$employee['Employee']['entertainment'];
$tds=($employee['Employee']['net_salary']*$employee['Employee']['income_tax'])/100;
$tds=round($tds,2);
if($employee['Loan']['loan_amount']){
$loan_date=date("y-m-d",strtotime($employee['Loan']['loan_date']));
$current_date=date('y-m-d');
$diff = abs(strtotime($current_date) - strtotime($loan_date));
$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$loan_amount=$employee['Loan']['loan_amount']/$employee['Loan']['repay_period'];
$loan_amount=round($loan_amount,2);
}
else{$loan_amount=0;}
$deductions=$employee['Employee']['pf']+$employee['Employee']['esi']+$tds+$res['SalaryRecord']['advance_amount']+$loan_amount;
$this->set('expected_earnings',$earnings-$deductions);

$salary_date_split = explode("-",$salary_date);
$this->set('salary_month',date("F",mktime(0,0,0,$salary_date_split[0],1,2000)));
$this->set('salary_year',$salary_date_split[1]);

$mysqlstart = date($salary_date_split[1].'-'.$salary_date_split[0].'-01');

$mysqlend = date('y-m-t', strtotime($mysqlstart));
$attendances= $this->Employee->Attendance->find('all',array('conditions'=>array('Attendance.employee_id'=>$id,'Attendance.date BETWEEN ? AND ?'
=> array($mysqlstart,$mysqlend)
)));
$leave_count=0;$absent_count=0;$overtime_count=0;
foreach($attendances as $attendace){
if($attendace['Attendance']['status']==0){$absent_count+=1;}
elseif($attendace['Attendance']['status']==2){$leave_count+=1;}
$overtime_count+=$attendace['Attendance']['overtime'];
}
$this->set('leave_count',0);
$this->set('absent_count',0);
$this->set('overtime_count',0);

if($res['SalaryRecord']['payslip_generated']==0){
$this->set('expected_loan_amount',$loan_amount);}
else{$this->set('expected_loan_amount',$res['SalaryRecord']['expected_loan_amount']);}
}
function payslip_update(){
 if($this->request->data){
$this->set('employee_id',$this->request->data['SalaryRecord']['employee_id']); 	
$res=$this->Employee->SalaryRecord->salarySearch($this->request->data['SalaryRecord']['employee_id'],$this->request->data['SalaryRecord']['salary_date']);
if($res['SalaryRecord']['payslip_generated']!=1){//debug($this->request->data);
$earnings=$this->request->data['SalaryRecord']['basic']+$this->request->data['SalaryRecord']['da']+$this->request->data['SalaryRecord']['bonus']+$this->request->data['SalaryRecord']['medical_allowance']+$this->request->data['SalaryRecord']['tiffin']+$this->request->data['SalaryRecord']['house_rent']+$this->request->data['SalaryRecord']['education']+$this->request->data['SalaryRecord']['entertainment'];
$deductions=$this->request->data['SalaryRecord']['pf']+$this->request->data['SalaryRecord']['esi']+$this->request->data['SalaryRecord']['income_tax'];
$this->request->data['SalaryRecord']['net_salary']=$earnings-$deductions;
$se=$this->Session->read("Auth");
$this->request->data['SalaryRecord']['user_id']=$se['User']['id'];
$this->request->data['SalaryRecord']['print_copy']=1;
$this->request->data['SalaryRecord']['payslip_generated']=1;
//debug($this->request->data['SalaryRecord']);exit();
if($res['SalaryRecord']['id']){
$this->Employee->SalaryRecord->id=$res['SalaryRecord']['id'];	
}
else{$this->Employee->SalaryRecord->create();}
if($this->Employee->SalaryRecord->save($this->request->data)){
	
//update the loan amount
if($this->request->data['SalaryRecord']['loan_amount']>0){
$this->request->data['Loan']['loan_amount']=$this->request->data['SalaryRecord']['loan_amount'];
$this->request->data['Loan']['employee_id']=$this->request->data['SalaryRecord']['employee_id'];
$loan_save=$this->Employee->Loan->loanEntryUpdate($this->request->data['Loan']);
	}
	
$this->set('salary_saved',1);
$name=$this->request->data['SalaryRecord']['fname'];
if($this->request->data['SalaryRecord']['mname']!=null){$name.=' '.$this->request->data['SalaryRecord']['mname'];}
$name.=' '.$this->request->data['SalaryRecord']['lname'];
	
App::import('Vendor','xtcpdf');  
$tcpdf = new XTCPDF(); 
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans' 

$tcpdf->SetAuthor("Company Name"); 
$tcpdf->SetAutoPageBreak( false ); 
$tcpdf->setPrintHeader(false); 
$tcpdf->setPrintFooter(false); 
//$tcpdf->setHeaderFont(array($textfont,'',40)); 
//$tcpdf->xheadercolor = array(0,0,0); 
//$tcpdf->xheadertext = ''; 
//$tcpdf->xfootertext = ''; 

// add a page (required with recent versions of tcpdf) 
$tcpdf->AddPage(); 

// Now you position and print your page content 
// example: 
$fill = 0; 
$tcpdf->SetTextColor(0, 0, 0); 
$tcpdf->SetFont($textfont,'B',20); 
$header_html='<span>Company Logo</span>';
$header_html2='<span>Company Address</span>';
$payslip_date='<p style="font-size:20px!important">Playslip for the month of '.$this->request->data['SalaryRecord']['salary_date'].'</p>';
$emp_name = '<p style="font-size:20px!important">Name : '.$name.'</p>';
$employee_id = '<p style="font-size:20px!important">Employee Id : emp'.$this->request->data['SalaryRecord']['employee_id'].'</p>';
$department = '<p style="font-size:20px!important">Department : '.$this->request->data['SalaryRecord']['department'].'</p>';
$designation = '<p style="font-size:20px!important">Designation : '.$this->request->data['SalaryRecord']['designation'].'</p>';
$employee=$this->Employee->employeeSearch($this->request->data['SalaryRecord']['employee_id']);
$expected_earnings=$employee['Employee']['net_salary']+$employee['Employee']['da']+$employee['Employee']['bonus']+$employee['Employee']['medical_allowance']+$employee['Employee']['tiffin']+$employee['Employee']['house_rent']+$employee['Employee']['education']+$employee['Employee']['entertainment'];
$expected_deductions=$employee['Employee']['pf']+$employee['Employee']['esi']+$employee['Employee']['income_tax'];
$earnings_content='
<style>
	table{width:100%;border:none}
	th{font-size:12px;height:10px;font-size:22px!important;border-bottom:0px solid black}
	td{font-size:20px!important;width:100%;}
	.total{border-top:0px solid black}
</style>
<table>
 <tr>
  <th><b>Earnings</b></th>
 </tr>
 <tr>
 <td width="50%"></td>
  <td width="25%">Full (Rs.)</td>
  <td width="25%">Actual (Rs.)</td>
 </tr>
 <tr>
 <td width="50%">Basic</td>
  <td width="25%">'.$employee['Employee']['net_salary'].'</td>
  <td width="25%">'.$this->request->data['SalaryRecord']['basic'].'</td>
 </tr>
 <tr>
  <td width="50%">DA</td>
  <td width="25%">'.$employee['Employee']['da'].'</td>
  <td width="25%">'.$this->request->data['SalaryRecord']['da'].'</td>
 </tr>
 <tr>
  <td width="50%">Bonus</td>
  <td width="25%">'.$employee['Employee']['bonus'].'</td>
  <td width="25%">'.$this->request->data['SalaryRecord']['bonus'].'</td>
 </tr>
 <tr>
  <td width="50%">Medical Allowance</td>
  <td width="25%">'.$employee['Employee']['medical_allowance'].'</td>
  <td width="25%">'.$this->request->data['SalaryRecord']['medical_allowance'].'</td>
 </tr>
  <tr>
  <td width="50%">Tiffin Allowance</td>
  <td width="25%">'.$employee['Employee']['tiffin'].'</td>
  <td width="25%">'.$this->request->data['SalaryRecord']['tiffin'].'</td>
 </tr>
  <tr>
  <td width="50%">House Rent Allowance</td>
  <td width="25%">'.$employee['Employee']['house_rent'].'</td>
  <td width="25%">'.$this->request->data['SalaryRecord']['house_rent'].'</td>
 </tr>
 <tr>
  <td width="50%">Education Allowance</td>
  <td width="25%">'.$employee['Employee']['education'].'</td>
  <td width="25%">'.$this->request->data['SalaryRecord']['education'].'</td>
 </tr>
  <tr>
  <td width="50%">Entertainment Allowance</td>
  <td width="25%">'.$employee['Employee']['entertainment'].'</td>
  <td width="25%">'.$this->request->data['SalaryRecord']['entertainment'].'</td>
 </tr>
 <tr>
  <td width="50%"  class="total"><b>Total Earnings (Rs.) :</b></td>
  <td width="25%"  class="total"><b>'.$expected_earnings.'</b></td>
  <td width="25%"  class="total"><b>'.$earnings.'</b></td>
 </tr>
	 </table>';

$deductions_content='
<style>
	table{width:100%;border:none}
	th{font-size:12px;height:10px;font-size:22px!important;border-bottom:0px solid black}
	td{font-size:20px!important;width:100%;}
	.total{border-top:0px solid black}

</style>
<table>
 <tr>
  <th><b>Deductions</b></th>
 </tr>
 <tr>
 <td width="50%"></td>
  <td width="25%">Full (Rs.)</td>
  <td width="25%">Actual (Rs.)</td>
 </tr>
 <tr>
 <td width="50%">PF</td>
  <td width="25%">'.$employee['Employee']['pf'].'</td>
  <td width="25%">'.$this->request->data['SalaryRecord']['pf'].'</td>
 </tr>
 <tr>
  <td width="50%">ESI</td>
  <td width="25%">'.$employee['Employee']['esi'].'</td>
  <td width="25%">'.$this->request->data['SalaryRecord']['esi'].'</td>
 </tr>
 <tr>
  <td width="50%">TDS</td>
  <td width="25%">'.$employee['Employee']['income_tax'].'</td>
  <td width="25%">'.$this->request->data['SalaryRecord']['income_tax'].'</td>
 </tr>
  <tr>
  <td width="50%">Advance</td>
  <td width="25%">0</td>
  <td width="25%">0</td>
 </tr>
  <tr>
  <td width="50%">Loan</td>
  <td width="25%">0</td>
  <td width="25%">0</td>
 </tr>
 <tr>
  <td width="50%"></td>
  <td width="25%"></td>
  <td width="25%"></td>
 </tr>
 <tr>
  <td width="50%"></td>
  <td width="25%"></td>
  <td width="25%"></td>
 </tr>
 <tr>
  <td width="50%"></td>
  <td width="25%"></td>
  <td width="25%"></td>
 </tr>
 <tr>
  <td width="50%"  class="total"><b>Total Deductions (Rs.) :</b></td>
  <td width="25%"  class="total"><b>'.$expected_deductions.'</b></td>
  <td width="25%"  class="total"><b>'.$deductions.'</b></td>
 </tr>
	 </table>';
$net_earnings=$earnings-$deductions;
$net_salary='<p style="font-size:20px!important"><b>Net Salary : Rs. '.$net_earnings.'</b></p>';

$auto_text='<p style="font-size:22px!important;color:#cccccc">This is a computer-generated salary slip. Does not require a Signature</p>';
$tcpdf->SetFillColor(155,100,0);
$tcpdf->writeHTMLCell(50,0, '', 10, $header_html, 0, 1, 0, true, 'L', true);
$tcpdf->writeHTMLCell(50, 0, 55, 10, $header_html2, 0, 0, 0, true, 'R', true);
$tcpdf->writeHTMLCell(0, 0, '', 35, $payslip_date, 0, 1, 0, true, 'L', true);
$tcpdf->writeHTMLCell(80, 5, '', 40, $emp_name, 'LRTB', 1, 0, true, 'C', true);
$tcpdf->writeHTMLCell(80, 5, 85,40,$employee_id, 'RTB', 1, 0, true, 'C', true);
$tcpdf->writeHTMLCell(80, 5, '', 45,$department, 'LRB', 1, 0, true, 'C', true);
$tcpdf->writeHTMLCell(80, 5, 85, 45,$designation, 'RB', 1, 0, true, 'C', true);
$tcpdf->writeHTMLCell(80, '', '', 55,$earnings_content, 'LRTB', 1, 0, true, 'C', true);
$tcpdf->writeHTMLCell(80, '', 85, 55,$deductions_content, 'RTB', 1, 0, true, 'C', true);
$tcpdf->writeHTMLCell(155,3, '', '',$net_salary, 'LRTB', 1, 0, true, 'L', true);
$tcpdf->writeHTMLCell(155,'', '', 105,$auto_text, '', 1, 0, true, 'L', true);
// ... 
// etc. 
// see the TCPDF examples
$file_name=time().'.pdf';  
echo $tcpdf->Output($file_name, 'F');



//setting view variables before sending email so that if email is not sent generated salry slip will still be viewed
$this->set('salaryrecord',$this->request->data['SalaryRecord']);
$this->set('employee',$employee);
$this->set('earnings',$earnings);
$this->set('deductions',$deductions);
$this->set('expected_earnings',$expected_earnings);
$this->set('net_earnings',$net_earnings);


   App::uses('CakeEmail', 'Network/Email');
     $Email = new CakeEmail();
     $Email->to($this->request->data['SalaryRecord']['email']);
     $Email->bcc($se['User']['email']);
     $Email->subject('Salary Slip of '.$name.' [ emp'.$this->request->data['SalaryRecord']['employee_id'].' ] for '.$this->request->data['SalaryRecord']['salary_date']);
     $Email->replyTo($se['User']['email']);
     $Email->from($se['User']['email']);
     $Email->emailFormat('html');
     $Email->viewVars(array('salary_record' => $this->request->data['SalaryRecord']));
     $Email->attachments($file_name);
     $Email->template('salaryslip');
	 //$Email->send();
	 App::uses('File', 'Utility');
$file = new File($file_name);
   $file->delete();

}
else{$this->set('salary_saved',0);}
	
}
 	}	

	}	
	
function print_salaryslip(){
if($this->RequestHandler->isAjax()){	
if($this->request->data){	
$salaryrecord=$this->Employee->employeeSalarySearch($this->request->data['SalaryRecord']['employee_id'],$this->request->data['SalaryRecord']['salary_date']);
$print_copy=$salaryrecord['SalaryRecord'][0]['print_copy']+1;
$this->Employee->SalaryRecord->salaryPrintcopyUpdate($salaryrecord['SalaryRecord'][0]['id'],$print_copy);
$this->set('salaryrecord',$salaryrecord);
$expected_earnings=$salaryrecord['Employee']['net_salary']+$salaryrecord['Employee']['da']+$salaryrecord['Employee']['bonus']+$salaryrecord['Employee']['medical_allowance']+$salaryrecord['Employee']['tiffin']+$salaryrecord['Employee']['house_rent']+$salaryrecord['Employee']['education']+$salaryrecord['Employee']['entertainment'];
$tds=($salaryrecord['Employee']['net_salary']*$salaryrecord['Employee']['income_tax'])/100;
$expected_deductions=$salaryrecord['Employee']['pf']+$salaryrecord['Employee']['esi']+$tds;
$this->set('expected_earnings',$expected_earnings);
$this->set('expected_deductions',$expected_deductions);
$earnings=$salaryrecord['SalaryRecord'][0]['basic']+$salaryrecord['SalaryRecord'][0]['da']+$salaryrecord['SalaryRecord'][0]['bonus']+$salaryrecord['SalaryRecord'][0]['medical_allowance']+$salaryrecord['SalaryRecord'][0]['tiffin']+$salaryrecord['SalaryRecord'][0]['house_rent']+$salaryrecord['SalaryRecord'][0]['education']+$salaryrecord['SalaryRecord'][0]['entertainment'];
$deductions=$salaryrecord['SalaryRecord'][0]['pf']+$salaryrecord['SalaryRecord'][0]['esi']+$salaryrecord['SalaryRecord'][0]['income_tax'];
$this->set('earnings',$earnings);
$this->set('deductions',$deductions);
$this->set('net_salary',$earnings-$deductions);

}
}
else{exit;}
}
function advance_salary($id=null){
$this->set('employee_id',$id);
$salary_date= date('m-Y',strtotime("-1months"));
$this->set('salary_date',$salary_date);
$employee=$this->Employee->employeeSearch($id);
$this->set('employee',$employee);
$res=$this->Employee->SalaryRecord->salarySearch($id,$salary_date);
$this->set('salaryrecord',$res['SalaryRecord']);
if($res['SalaryRecord']['payslip_generated']!=1){
if($res['SalaryRecord']['advance_amount']<$employee['Employee']['net_salary']){
$this->set('advance_available',1);
	}
else{$this->set('advance_available',2);}	
	}
else{$this->set('advance_available',0);



$earnings=$res['SalaryRecord']['basic']+$res['SalaryRecord']['da']+$res['SalaryRecord']['bonus']+$res['SalaryRecord']['medical_allowance']+$res['SalaryRecord']['tiffin']+$res['SalaryRecord']['house_rent']+$res['SalaryRecord']['education']+$res['SalaryRecord']['entertainment'];
$deductions=$res['SalaryRecord']['pf']+$res['SalaryRecord']['esi']+$res['SalaryRecord']['income_tax'];
$actual_total_earnings=$earnings-$deductions;
$this->set('earnings',$actual_total_earnings);

$expected_earnings=$employee['Employee']['net_salary']+$employee['Employee']['da']+$employee['Employee']['bonus']+$employee['Employee']['medical_allowance']+$employee['Employee']['tiffin']+$employee['Employee']['house_rent']+$employee['Employee']['education']+$employee['Employee']['entertainment'];
$expected_deductions=$employee['Employee']['pf']+$employee['Employee']['esi']+$employee['Employee']['income_tax'];
$this->set('expected_earnings',$expected_earnings-$expected_deductions);
}
}

function advance_salary_update(){
if($this->RequestHandler->isAjax()){	
if($this->request->data){
$se=$this->Session->read("Auth");
$this->request->data['SalaryRecord']['user_id']=$se['User']['id'];
$this->set('employee_id',$this->request->data['SalaryRecord']['employee_id']);	
$this->request->data['SalaryRecord']['advance_date']=date('y-m-d');
$salary_date= date('m-Y',strtotime("-1months"));
$this->request->data['SalaryRecord']['salary_date']=$salary_date;
$this->set('salary_date',$salary_date);	
$employee=$this->Employee->employeeSalarySearch($this->request->data['SalaryRecord']['employee_id']);
if($employee['SalaryRecord'][0]['advance_amount']){$previous_advance=$employee['SalaryRecord'][0]['advance_amount'];}
else{$previous_advance=0;}
$amount_after_loan=$employee['Employee']['net_salary']-$previous_advance-$this->request->data['SalaryRecord']['advance_amount'];
if($amount_after_loan>=0){
if($employee['SalaryRecord'][0]['advance_amount']){
$this->request->data['SalaryRecord']['advance_amount']+=$employee['SalaryRecord'][0]['advance_amount'];
$save=$this->Employee->SalaryRecord->salaryRecordUpdate($employee['SalaryRecord'][0]['id'],$this->request->data['SalaryRecord']);
	}
else{
$save=$this->Employee->SalaryRecord->salaryRecordCreate($this->request->data['SalaryRecord']);}		
$loanable_amount_left=$employee['Employee']['net_salary']-$this->request->data['SalaryRecord']['advance_amount'];
if($loanable_amount_left>0){$this->set('advance_available',1);

}
else{$this->set('advance_available',2);}
if($save){$this->set('update_msg','success');}
}
else{$this->set('advance_available',2);
$this->set('update_msg','fail');
$this->request->data['SalaryRecord']['advance_amount']=$employee['SalaryRecord'][0]['advance_amount'];
}

//Setting view variables employee and salaryrecord seperately to match view variable settings with advance_salary() view.
$this->set('employee',$employee);
$this->set('salaryrecord',$this->request->data['SalaryRecord']);
$this->render('advance_salary','ajax');
}	
	
}
}

function loan($id=null){
if($this->request->data){
$se=$this->Session->read("Auth");
$this->request->data['Loan']['user_id']=$se['User']['id'];	
$save=$this->Employee->Loan->LoanEntry($this->request->data['Loan']);
if($save){$this->set('update_msg','success');}
else{$this->set('update_msg','fail');}
}
if($id==null){$id=$this->request->data['Loan']['employee_id'];}
$this->set('employee_id',$id);
$employee=$this->Employee->employeeLoanSearch($id);
$this->set('employee',$employee);
	
}
}?>