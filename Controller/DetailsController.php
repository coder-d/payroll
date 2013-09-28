<?php

App::uses('AppController', 'Controller');

class DetailsController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Details';
	var $uses = array();
	
public $helpers = array('Html', 'Form', 'Session','Js' => array('Jquery'));
public $components = array('Session','RequestHandler','Fileupload');	


function beforeFilter()

{//$this->Auth->autoRedirect = false; 
    
	if ($this->action == 'pic_edit') {
	    //$this->params['session_id']='3r43r3r';
           // if ( isset($this->params['session_id']) ) { //$this->Session->params->session_id=$this->params['session_id']; }
            
            //$this->Session->start();
       }
}
        	
function index(){
 
$this->set('results',$this->Detail->Find('all'));
$this->Fileupload->test(3);
}
function ajax_test(){
$this->set('results',$this->Detail->Find('all'));
   //$this->autoRender = false;
    
}
function pic_edit(){
    

}

function ajax_testing(){
    
}
function raw_ajax_test(){
	
}
function upload_pic(){
    
    $this->autoRender = false;
 $r=$this->Session->read('User.id');
 
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
      
		
//$this->User->id=$r;
//$this->data['User']['attachmentName']=$file_new_name.'.jpg';
//$this->User->save($this->data);
//$path='/files/pic/'.$file_new_name.'.jpg';


//App::import('Helper', 'Html');
$path='/payroll/files/pic/'.$file_new_name.'.jpg';
$html = new HtmlHelper(new View(null));		
echo $html->image($path,array('alt'=>'Profile pic'));
	
	

	
	
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
function pdf_test(){
	
	
}
}
?>