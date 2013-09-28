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

$this->Pdf->core->addPage('', 'USLETTER');
    $this->Pdf->core->setFont('helvetica', '', 12);
    $this->Pdf->core->cell(30, 0, 'Hello World');
    $this->Pdf->core->Output('example_001.pdf', 'D');

?>