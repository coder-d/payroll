<?App::import('Vendor','xtcpdf');  
$tcpdf = new XTCPDF(); 
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans' 

$tcpdf->SetAuthor("London East Academy"); 
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
$tcpdf->SetFont($textfont,'',18); 
$header_html='<span>Company Logo</span>';
$header_html2='<span>Company Address</span>';
$payslip_date='<p style="font-size:20px!important">Playslip for the month of October 2012</p>';
$name = '<p style="font-size:20px!important">Name : Employee Name</p>';
$employee_id = '<p style="font-size:20px!important">Employee Id : emp26</p>';
$department = '<p style="font-size:20px!important">Department : Sales</p>';
$designation = '<p style="font-size:20px!important">Designation : Executive Officer</p>';
$earnings='
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
  <td width="25%">12000</td>
  <td width="25%">12000</td>
 </tr>
 <tr>
  <td width="50%">DA</td>
  <td width="25%">2000</td>
  <td width="25%">2000</td>
 </tr>
 <tr>
  <td width="50%">Education</td>
  <td width="25%">1500</td>
  <td width="25%">1500</td>
 </tr>
 <tr>
  <td width="50%"  class="total"><b>Total Earnings (Rs.) :</b></td>
  <td width="25%"  class="total"><b>15000</b></td>
  <td width="25%"  class="total"><b>15000</b></td>
 </tr>
	 </table>';
	 
	 $deductions='
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
 <td width="50%">Basic</td>
  <td width="25%">12000</td>
  <td width="25%">12000</td>
 </tr>
 <tr>
  <td width="50%">DA</td>
  <td width="25%">2000</td>
  <td width="25%">2000</td>
 </tr>
 <tr>
  <td width="50%">Education</td>
  <td width="25%">1500</td>
  <td width="25%">1500</td>
 </tr>
 <tr>
  <td width="50%"  class="total"><b>Total Deductions (Rs.) :</b></td>
  <td width="25%"  class="total"><b>15000</b></td>
  <td width="25%"  class="total"><b>15000</b></td>
 </tr>
	 </table>';

$net_salary='<p style="font-size:20px!important"><b>Net Salary : Rs. 13500 (Thirteen Thousand Five Hundred)</b></p>';

$auto_text='<p style="font-size:22px!important;color:#cccccc">This is a computer-generated salary slip. Does not require a Signature</p>';
$tcpdf->SetFillColor(155,100,0);

$tcpdf->writeHTMLCell(50,0, '', 10, $header_html, 0, 1, 0, true, 'L', true);
$tcpdf->writeHTMLCell(50, 0, 55, 10, $header_html2, 0, 0, 0, true, 'R', true);
$tcpdf->writeHTMLCell(0, 0, '', 35, $payslip_date, 0, 1, 0, true, 'L', true);
$tcpdf->writeHTMLCell(80, 5, '', 40, $name, 'LRTB', 1, 0, true, 'C', true);
$tcpdf->writeHTMLCell(80, 5, 85,40,$employee_id, 'RTB', 1, 0, true, 'C', true);
$tcpdf->writeHTMLCell(80, 5, '', 45,$department, 'LRB', 1, 0, true, 'C', true);
$tcpdf->writeHTMLCell(80, 5, 85, 45,$designation, 'RB', 1, 0, true, 'C', true);
$tcpdf->writeHTMLCell(80, '', '', 55,$earnings, 'LRTB', 1, 0, true, 'C', true);
$tcpdf->writeHTMLCell(80, '', 85, 55,$deductions, 'RTB', 1, 0, true, 'C', true);
$tcpdf->writeHTMLCell(155,3, '', '',$net_salary, 'LRTB', 1, 0, true, 'L', true);
$tcpdf->writeHTMLCell(155,'', '', 85,$auto_text, '', 1, 0, true, 'L', true);
// ... 
// etc. 
// see the TCPDF examples  
echo $tcpdf->Output('filename.pdf', 'F'); 

?>