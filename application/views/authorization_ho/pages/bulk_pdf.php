<?php //error_reporting(0);
//============================================================+
// File name   : example_011.php
// Begin       : 2008-03-04
// Last Update : 2008-10-10
// 
// Description : Example 011 for TCPDF class
//               Colored Table
// 
// Author: Nicola Asuni
// 
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com s.r.l.
//               Via Della Pace, 11
//               09044 Quartucciu (CA)
//               ITALY
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Colored Table
 * @author Nicola Asuni
 * @copyright 2004-2008 Nicola Asuni - Tecnick.com S.r.l (www.tecnick.com) Via Della Pace, 11 - 09044 - Quartucciu (CA) - ITALY - www.tecnick.com - info@tecnick.com
 * @link http://tcpdf.org
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 * @since 2008-03-04
 */
//
require_once('./application/tcpdf_6_3_5/tcpdf.php');

// extend TCPF with custom functions
class MYPDF extends TCPDF {
	//Colored table
	function showBody($query,$creditData="") {
		//Colors, line width and bold font
		$this->SetFillColor(0);
		$this->SetTextColor(0);
		$this->SetDrawColor(0);
		$this->SetLineWidth(.3);
		$this->writeHTML($creditData, false, false, false, true,'L');
		$this->Ln();
		//$this->writeHTMLCell(10, $h, 15, $this->getY()+3, "ahsgd asd sdg ghdg hgsd ag jasd gjhajgas jaagjh agajgahag a jag fadgj", 1, 0, 0, true, 'C');
	}
	
	function showHeader()
	{
		$this->SetFont("dejavusans", "B", 12);
		$this->Cell(180,0,"The City Bank Ltd.",'',2,'C',0);
		$this->SetFont("dejavusans", "B", 10);
		$this->Cell(180,0,"Principal Office",'',2,'C',0);
		$this->SetFont("dejavusans", "B", 8);
		$this->Ln();
		$this->writeHTML("<u>Documentation Check List</u>", true, false, false, true, 'C');
		$this->Ln();
		$this->SetFont("dejavusans", "", 8);
		$this->Cell(180,0,"Date: ".date("d M Y"),'',2,'R',0);
		$this->Ln();
	}
	public function Header() {
        // Logo
		$bb='';
		$ggg= new common_model;
		$cinfo_r=$ggg->common_model->client_info();
		$bb=$cinfo_r->Address1;
        $image_file = './images/logo-home.jpg';
        $this->Image($image_file, 10,5, 50, '', 'jpg', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 7);
        // Title
		$this->Cell(150,50,$bb,'',2,'',0);
       $this->SetFont('helvetica', 'B', 7);
        // Title
		$this->Cell(150,10,$bb,'',2,'',0);
		//$this->writeHTML($bb, true, false, false, true, false);
    }

    // Page footer
    public function Footer() {
		$bb='';
		$bb1='';
		$bb2='';
		$ggg= new common_model;
		$cinfo_r=$ggg->common_model->client_info();
		$bb=$cinfo_r->Footer;
		$bb1=$cinfo_r->Footer1;
		$bb2=$cinfo_r->Footer2;
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
       // $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		$this->Cell(0, 0, $bb, 0, false, 'L', 0, '', 0, false, 'T', 'M');
		$this->Ln();
		$this->Cell(0, 0, $bb1, 0, false, 'L', 0, '', 0, false, 'T', 'M');
		$this->Ln();
		$this->Cell(0, 0, $bb2, 0, false, 'L', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true); 

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor("MMTV");
$pdf->SetTitle("Authorization");
$pdf->SetSubject("Authorization");
//$pdf->SetKeywords("TCPDF, PDF, example, test, guide");

// remove default header
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
/*
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
*/

//set margins
$pdf->SetMargins(25,25,20,0, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 

//set some language-dependent strings
////$pdf->setLanguageArray($l); 

//initialize document
//$pdf->AliasNbPages();



///////////////////////////////////////////////////////////////////////////////////////////////////////////	 	

if($bulk==1)//for bulk download
{
	$str2 = explode("_",$id);
}
else
{
	$str2 = array('0'=>$id);
}
for ($k=0; $k<count($str2); $k++) { 
	if($k==0 && $bulk==1) //For skiping the type when bulk action
	{
		continue;
	}

	$details = $this->Authorization_ho_model->get_details_suit_authorization($str2[$k]);
	if($details->event_name=='cma')//for authorization request from cma
	{
		$event_id = $details->event_id;
		$details=$this->Authorization_ho_model->get_details_cma_authorization($str2[$k],$event_id);
	}
	if ($details->au_serial=='' && $details->au_serial==NULL) {
		//Get The New Serial
		$new_sl_no=$this->user_model->get_au_serial(1);
		//Update The New Serial in db
		$au_data['au_serial'] = $new_sl_no;
		$this->db->where('id', $id);
		$this->db->update('authorization', $au_data);
		//Update THe new serial in serial table also
		$this->user_model->update_au_serial(1);
	}else
	{
		$new_sl_no = $details->au_serial;
	}
	$ref = 'BBL/HO/LMD /'.date('Y').'/'.$new_sl_no;

	if($details->authorization_type==1)//For Aurtho Rin Filling Authorization Memo
	{
		$pdf->AddPage('P', 'A4');
		$creditData='';	
		$creditData.='<table style="align:center;border">';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:60%">';
				$creditData.='Ref: <span style="font-weight:bold">'.$ref.'</span>';
			$creditData.='</td>';
			$creditData.='<td style="width:40%">';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="80px">';
				$creditData.='<span style="">'.date('d-M-Y').'</span>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td colspan="2" align="center" height="50px">';
				$creditData.='<span style="font-size:17px;font-weight:bold">Authorization For Filing Case</span>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:100%" colspan="2" align="justify">';
				$creditData.='<p style="font-size:12px">I do hereby authorize Mr. <span style="font-weight:bold">'.$details->plaintiff_name.'</span> (PIN # <span style="font-weight:bold">'.$details->plaintiff_pin.'</span>, <span style="font-weight:bold">'.$details->functional_designation.'</span>, BRAC Bank PLC.) to represent as plaintiff of BRAC Bank PLC. In relation to a case under Artho Rin Adalat Ain-2003, against <span style="font-weight:bold">'.ucwords(strtolower((string)$details->brrower_name)).'</span> & Others. Account No: <span style="font-weight:bold">'.$details->loan_ac.'</span>, Proprietor of <span style="font-weight:bold">'.ucwords(strtolower((string)$details->ac_name)).'</span>, Address: <span style="font-weight:bold">'.ucwords(strtolower((string)$details->current_address)).'</span>.</p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="20px">';
				$creditData.='<p>Signature of <span style="font-weight:bold">'.$details->plaintiff_name.'</span></p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>Attested:</p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
			$creditData.='</tr>';
		$creditData.='</table>';
		$pdf->SetFont("helvetica", "", 10);
		// Print colored table
		$pdf->showBody('',$creditData);
	}
	if($details->authorization_type==8)//For Ni Act Filling Authorization Memo
	{
		$pdf->AddPage('P', 'A4');
		$creditData='';	
		$creditData.='<table style="align:center;border">';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:60%">';
				$creditData.='Ref: <span style="font-weight:bold">'.$ref.'</span>';
			$creditData.='</td>';
			$creditData.='<td style="width:40%">';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="80px">';
				$creditData.='<span style="">'.date('d-M-Y').'</span>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td colspan="2" align="center" height="50px">';
				$creditData.='<span style="font-size:17px;font-weight:bold">Authorization For Filing Case</span>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:100%" colspan="2" align="justify">';
				$creditData.='<p style="font-size:12px">I do hereby authorize Mr. <span style="font-weight:bold">'.$details->plaintiff_name.'</span> (PIN # <span style="font-weight:bold">'.$details->plaintiff_pin.'</span>, <span style="font-weight:bold">'.$details->functional_designation.'</span>, BRAC Bank PLC.) to represent as plaintiff of BRAC Bank PLC. in the case, against <span style="font-weight:bold">'.ucwords(strtolower((string)$details->brrower_name)).'</span>. Account No: <span style="font-weight:bold">'.$details->loan_ac.'</span>, Proprietor of <span style="font-weight:bold">'.ucwords(strtolower((string)$details->ac_name)).'</span>, Address: <span style="font-weight:bold">'.ucwords(strtolower((string)$details->current_address)).'</span>under section-138 of Negotiable Instrument Act 1881</p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="20px">';
				$creditData.='<p>Signature of <span style="font-weight:bold">'.$details->plaintiff_name.'</span></p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>Attested:</p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
			$creditData.='</tr>';
		$creditData.='</table>';
		
		$pdf->SetFont("helvetica", "", 10);
		// Print colored table
		$pdf->showBody('',$creditData);
	}
	if($details->authorization_type==2)//Filling Jari Format
	{
		$pdf->AddPage('P', 'A4');
		$creditData='';	
		$creditData.='<table style="align:center;border">';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:60%">';
				$creditData.='Ref: <span style="font-weight:bold">'.$ref.'</span>';
			$creditData.='</td>';
			$creditData.='<td style="width:40%">';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="80px">';
				$creditData.='<span style="">'.date('d-M-Y').'</span>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td colspan="2" align="center" height="50px">';
				$creditData.='<span style="font-size:17px;font-weight:bold">Authorization  for  Filing  Artha  Jari  Case</span>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:100%" colspan="2" align="justify">';
				$creditData.='<p style="font-size:12px">I do hereby authorize '.$details->plaintiff_name.', PIN # '.$details->plaintiff_pin.', '.$details->functional_designation.'-Litigation Management Department, BRAC Bank PLC. to represent as plaintiff of  BRAC Bank PLC. in Artha Jari Case arising out from judgment of Artharin '.$details->case_number.' under Artharin Adalot Ain-2003 against '.ucwords(strtolower((string)$details->brrower_name)).' & Others  Account No: '.$details->loan_ac.', Proprietor of   '.ucwords(strtolower((string)$details->ac_name)).',   Address: '.ucwords(strtolower((string)$details->current_address)).'.</p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="20px">';
				$creditData.='<p>Signature of <span style="font-weight:bold">'.$details->plaintiff_name.'</span></p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>Attested:</p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
			$creditData.='</tr>';
		$creditData.='</table>';
		
		$pdf->SetFont("helvetica", "", 10);
		// Print colored table
		$pdf->showBody('',$creditData);
	}
	if($details->authorization_type==4)//Plaintiff ARA Format
	{
		$prev_name = $controller->get_peramater_name('users_info',"j0.id=".$details->prev_item." AND j0.data_status=1");
		$new_name = $controller->get_peramater_name('users_info',"j0.id=".$details->new_item." AND j0.data_status=1");
		$new_user_name="";
		$new_user_pin="";
		$new_user_desig="";
		$old_user_name="";
		$old_user_pin="";
		$old_user_desig="";
		if(!empty($new_name))
		{
			$new_user_name=$new_name->name;
			$new_user_pin=$new_name->pin;
			$new_user_desig=$new_name->desig;
		}
		if(!empty($prev_name))
		{
			$old_user_name=$prev_name->name;
			$old_user_pin=$prev_name->pin;
			$old_user_desig=$prev_name->desig;
		}
		$pdf->AddPage('P', 'A4');
		$creditData='';	
		$creditData.='<table style="align:center;border">';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:60%">';
				$creditData.='Ref: <span style="font-weight:bold">'.$ref.'</span>';
			$creditData.='</td>';
			$creditData.='<td style="width:40%">';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="80px">';
				$creditData.='<span style="">'.date('d-M-Y').'</span>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td colspan="2" align="center" height="50px">';
				$creditData.='<span style="font-size:17px;font-weight:bold">Authorization For Representative Change</span>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:100%" colspan="2" align="justify">';
				$creditData.='<p style="font-size:12px">I do hereby authorize Mr. '.$new_user_name.', PIN # '.$new_user_pin.' ('.$new_user_desig.', BRAC Bank PLC.) to represent as plaintiff of BRAC Bank PLC. before Honorable '.$details->court_name.'  in relation to a case no- '.$details->case_number.' against '.ucwords(strtolower((string)$details->brrower_name)).' & Others Proprietor of '.ucwords(strtolower((string)$details->ac_name)).' Address: '.ucwords(strtolower((string)$details->current_address)).'  under Artho Rin Adalat Ain-2003 in lieu of Mr. '.$old_user_name.' PIN # '.$old_user_pin.' ('.$old_user_desig.', Litigation Management Department) due to change of their duties and responsibilities.</p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="20px">';
				$creditData.='<p>Signature of <span style="font-weight:bold">'.$new_user_name.'</span></p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>Attested:</p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
			$creditData.='</tr>';
		$creditData.='</table>';
		$pdf->SetFont("helvetica", "", 10);
		// Print colored table
		$pdf->showBody('',$creditData);
	}
	if($details->authorization_type==9) //Plaintiff NI ACT Format
	{
		$prev_name = $controller->get_peramater_name('users_info',"j0.id=".$details->prev_item." AND j0.data_status=1");
		$new_name = $controller->get_peramater_name('users_info',"j0.id=".$details->new_item." AND j0.data_status=1");
		$new_user_name="";
		$new_user_pin="";
		$new_user_desig="";
		$old_user_name="";
		$old_user_pin="";
		$old_user_desig="";
		if(!empty($new_name))
		{
			$new_user_name=$new_name->name;
			$new_user_pin=$new_name->pin;
			$new_user_desig=$new_name->desig;
		}
		if(!empty($prev_name))
		{
			$old_user_name=$prev_name->name;
			$old_user_pin=$prev_name->pin;
			$old_user_desig=$prev_name->desig;
		}
		$pdf->AddPage('P', 'A4');
		$creditData='';	
		$creditData.='<table style="align:center;border">';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:60%">';
				$creditData.='Ref: <span style="font-weight:bold">'.$ref.'</span>';
			$creditData.='</td>';
			$creditData.='<td style="width:40%">';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="80px">';
				$creditData.='<span style="">'.date('d-M-Y').'</span>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td colspan="2" align="center" height="50px">';
				$creditData.='<span style="font-size:17px;font-weight:bold">Authorization For Representative Change</span>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:100%" colspan="2" align="justify">';
				$creditData.='<p style="font-size:12px">I do hereby authorize Mr. '.$new_user_name.', PIN # '.$new_user_pin.' ('.$new_user_desig.', BRAC Bank PLC.) to represent as plaintiff of BRAC Bank PLC. before Honorable '.$details->court_name.'  in relation to a case no- '.$details->case_number.' against '.ucwords(strtolower((string)$details->brrower_name)).' Proprietor of '.ucwords(strtolower((string)$details->ac_name)).' Address: '.ucwords(strtolower((string)$details->current_address)).'  under section-138 of Negotiable Instrument Act 1881 in lieu of Mr. '.$old_user_name.' PIN # '.$old_user_pin.' ('.$old_user_desig.', Litigation Management Department) due to change of their duties and responsibilities.</p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="20px">';
				$creditData.='<p>Signature of <span style="font-weight:bold">'.$new_user_name.'</span></p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>Attested:</p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
			$creditData.='</tr>';
		$creditData.='</table>';
		
		$pdf->SetFont("helvetica", "", 10);
		// Print colored table
		$pdf->showBody('',$creditData);
	}
	if($details->authorization_type==5) //ARA Witness Format
	{
		$pdf->AddPage('P', 'A4');
		$creditData='';	
		$creditData.='<table style="align:center;border">';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:60%">';
				$creditData.='Ref: <span style="font-weight:bold">'.$ref.'</span>';
			$creditData.='</td>';
			$creditData.='<td style="width:40%">';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="80px">';
				$creditData.='<span style="">'.date('d-M-Y').'</span>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td colspan="2" align="center" height="50px">';
				$creditData.='<span style="font-size:17px;font-weight:bold">Authorization For Witness</span>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:100%" colspan="2" align="justify">';
				$creditData.='<p style="font-size:12px">I do hereby authorize Mr. '.$details->plaintiff_name.' PIN # '.$details->plaintiff_pin.' ('.$details->functional_designation.', BRAC Bank PLC.) to represent as plaintiff of BRAC Bank PLC. to witness in relation to a case no- '.$details->case_number.' before Honorable '.$details->court_name.', under Artha Rin Adalat Ain 2003, against '.ucwords(strtolower((string)$details->brrower_name)).' & Others Account No: '.$details->loan_ac.', Proprietor of  '.ucwords(strtolower((string)$details->ac_name)).'  Address: '.ucwords(strtolower((string)$details->current_address)).'.</p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="20px">';
				$creditData.='<p>Signature of <span style="font-weight:bold">'.$details->plaintiff_name.'</span></p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>Attested:</p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
			$creditData.='</tr>';
		$creditData.='</table>';
		
		$pdf->SetFont("helvetica", "", 10);
		// Print colored table
		$pdf->showBody('',$creditData);
	}
	if($details->authorization_type==6) //ARA Withdraw Format
	{
		$pdf->AddPage('P', 'A4');
		$creditData='';	
		$creditData.='<table style="align:center;border">';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:60%">';
				$creditData.='Ref: <span style="font-weight:bold">'.$ref.'</span>';
			$creditData.='</td>';
			$creditData.='<td style="width:40%">';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="80px">';
				$creditData.='<span style="">'.date('d-M-Y').'</span>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td colspan="2" align="center" height="50px">';
				$creditData.='<span style="font-size:17px;font-weight:bold">Authorization for case withdrawal</span>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:100%" colspan="2" align="justify">';
				$creditData.='<p style="font-size:12px">I do hereby authorize Mr. '.$details->plaintiff_name.' (PIN # '.$details->plaintiff_pin.', '.$details->functional_designation.', BRAC Bank PLC.) to represent as plaintiff of BRAC Bank PLC. to withdraw in relation to a case  '.$details->case_number.'  arising out of before Honorable '.$details->court_name.', under Artho Rin Adalat Ain-2003 against '.ucwords(strtolower((string)$details->brrower_name)).' & Others Account No. '.$details->loan_ac.', Proprietor of  '.ucwords(strtolower((string)$details->ac_name)).'  Address: '.ucwords(strtolower((string)$details->current_address)).'.</p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="20px">';
				$creditData.='<p>Signature of <span style="font-weight:bold">'.$details->plaintiff_name.'</span></p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>Attested:</p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
			$creditData.='</tr>';
		$creditData.='</table>';
		
		$pdf->SetFont("helvetica", "", 10);
		// Print colored table
		$pdf->showBody('',$creditData);
	}
	if($details->authorization_type==10) //NI ACT Witness Format
	{
		$pdf->AddPage('P', 'A4');
		$creditData='';	
		$creditData.='<table style="align:center;border">';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:60%">';
				$creditData.='Ref: <span style="font-weight:bold">'.$ref.'</span>';
			$creditData.='</td>';
			$creditData.='<td style="width:40%">';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="80px">';
				$creditData.='<span style="">'.date('d-M-Y').'</span>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td colspan="2" align="center" height="50px">';
				$creditData.='<span style="font-size:17px;font-weight:bold">Authorization  For  Witness</span>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:100%" colspan="2" align="justify">';
				$creditData.='<p style="font-size:12px">I do hereby authorize Mr. '.$details->plaintiff_name.' (PIN # '.$details->plaintiff_pin.', '.$details->functional_designation.' , BRAC Bank PLC.) to represent as plaintiff of BRAC Bank PLC. to witness in relation to a case no- '.$details->case_number.' under section-138 of Negotiable Instrument Act 1881, against  '.ucwords(strtolower((string)$details->brrower_name)).'  Account No: '.$details->loan_ac.' Proprietor of '.ucwords(strtolower((string)$details->ac_name)).'  Address: '.ucwords(strtolower((string)$details->current_address)).'.</p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="20px">';
				$creditData.='<p>Signature of <span style="font-weight:bold">'.$details->plaintiff_name.'</span></p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>Attested:</p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
			$creditData.='</tr>';
		$creditData.='</table>';
		
		$pdf->SetFont("helvetica", "", 10);
		// Print colored table
		$pdf->showBody('',$creditData);
	}
	if($details->authorization_type==11) //NI ACT Appear Appel Case Format
	{
		$pdf->AddPage('P', 'A4');
		$creditData='';	
		$creditData.='<table style="align:center;border">';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:60%">';
				$creditData.='Ref: <span style="font-weight:bold">'.$ref.'</span>';
			$creditData.='</td>';
			$creditData.='<td style="width:40%">';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="80px">';
				$creditData.='<span style="">'.date('d-M-Y').'</span>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td colspan="2" align="center" height="50px">';
				$creditData.='<span style="font-size:17px;font-weight:bold">Authorization For Appear In Appeal Case</span>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:100%" colspan="2" align="justify">';
				$creditData.='<p style="font-size:12px">I do hereby authorize  Mr. '.$details->plaintiff_name.' (PIN # '.$details->plaintiff_pin.', '.$details->functional_designation.' - Litigation Management  Department, BRAC Bank PLC.) to represent as plaintiff of BRAC Bank PLC. in relation to a case '.$details->case_number.'   before Honorable '.$details->court_name.' against '.ucwords(strtolower((string)$details->brrower_name)).' Account No: '.$details->loan_ac.', Proprietor of '.ucwords(strtolower((string)$details->ac_name)).' Address: '.ucwords(strtolower((string)$details->current_address)).', under section-138 of  Negotiable Instrument Act 1881.</p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="20px">';
				$creditData.='<p>Signature of <span style="font-weight:bold">'.$details->plaintiff_name.'</span></p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>Attested:</p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
			$creditData.='</tr>';
		$creditData.='</table>';
		
		$pdf->SetFont("helvetica", "", 10);
		// Print colored table
		$pdf->showBody('',$creditData);
	}
	if($details->authorization_type==7) //ARA Appear Appel Case Format
	{
		$pdf->AddPage('P', 'A4');
		$creditData='';	
		$creditData.='<table style="align:center;border">';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:60%">';
				$creditData.='Ref: <span style="font-weight:bold">'.$ref.'</span>';
			$creditData.='</td>';
			$creditData.='<td style="width:40%">';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="80px">';
				$creditData.='<span style="">'.date('d-M-Y').'</span>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td colspan="2" align="center" height="50px">';
				$creditData.='<span style="font-size:17px;font-weight:bold">Authorization For Appear In Appeal Case</span>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:100%" colspan="2" align="justify">';
				$creditData.='<p style="font-size:12px">I do hereby authorize  Mr. '.$details->plaintiff_name.' (PIN # '.$details->plaintiff_pin.', '.$details->functional_designation.' - Litigation Management  Department, BRAC Bank PLC.) to represent as plaintiff of BRAC Bank PLC. in relation to a case '.$details->case_number.'   before Honorable '.$details->court_name.' against '.ucwords(strtolower((string)$details->brrower_name)).' Account No: '.$details->loan_ac.', Proprietor of '.ucwords(strtolower((string)$details->ac_name)).' Address: '.ucwords(strtolower((string)$details->current_address)).', Artho Rin Adalat Ain-2003.</p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="20px">';
				$creditData.='<p>Signature of <span style="font-weight:bold">'.$details->plaintiff_name.'</span></p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>Attested:</p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
			$creditData.='</tr>';
		$creditData.='</table>';
		
		$pdf->SetFont("helvetica", "", 10);
		// Print colored table
		$pdf->showBody('',$creditData);
	}
	if($details->authorization_type==12) //NI ACT Withdraw Format
	{
		$pdf->AddPage('P', 'A4');
		$creditData='';	
		$creditData.='<table style="align:center;border">';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:60%">';
				$creditData.='Ref: <span style="font-weight:bold">'.$ref.'</span>';
			$creditData.='</td>';
			$creditData.='<td style="width:40%">';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="80px">';
				$creditData.='<span style="">'.date('d-M-Y').'</span>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td colspan="2" align="center" height="50px">';
				$creditData.='<span style="font-size:17px;font-weight:bold">Authorization for case withdrawal</span>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:100%" colspan="2" align="justify">';
				$creditData.='<p style="font-size:12px">I do hereby authorize Mr. '.$details->plaintiff_name.' (PIN # '.$details->plaintiff_pin.', '.$details->functional_designation.', BRAC Bank PLC.) to represent as plaintiff of BRAC Bank PLC. to withdraw in relation to a case no '.$details->case_number.' arising out of before  Honorable '.$details->court_name.' under section 138 of NI Act against  '.ucwords(strtolower((string)$details->brrower_name)).' Account No: '.$details->loan_ac.', Proprietor Of '.ucwords(strtolower((string)$details->ac_name)).' Address : '.ucwords(strtolower((string)$details->current_address)).'.</p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="20px">';
				$creditData.='<p>Signature of <span style="font-weight:bold">'.$details->plaintiff_name.'</span></p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>Attested:</p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
			$creditData.='</tr>';
		$creditData.='</table>';
		
		$pdf->SetFont("helvetica", "", 10);
		// Print colored table
		$pdf->showBody('',$creditData);
	}
	if($details->authorization_type==13) //NI Appeal Withdraw Format
	{
		$pdf->AddPage('P', 'A4');
		$creditData='';	
		$creditData.='<table style="align:center;border">';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:60%">';
				$creditData.='Ref: <span style="font-weight:bold">'.$ref.'</span>';
			$creditData.='</td>';
			$creditData.='<td style="width:40%">';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="80px">';
				$creditData.='<span style="">'.date('d-M-Y').'</span>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td colspan="2" align="center" height="50px">';
				$creditData.='<span style="font-size:17px;font-weight:bold">Authorization for Appeal Money Withdraw</span>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td style="width:100%" colspan="2" align="justify">';
				$creditData.='<p style="font-size:12px">I do hereby authorize '.$details->plaintiff_name.' (PIN # '.$details->plaintiff_pin.', '.$details->functional_designation.', BRAC Bank PLC.) to withdraw appeal money in relation to a case '.$details->case_number.' before Honorable '.$details->court_name.' against '.ucwords(strtolower((string)$details->brrower_name)).', Account No: '.$details->loan_ac.', Proprietor of '.ucwords(strtolower((string)$details->ac_name)).', Address: '.ucwords(strtolower((string)$details->current_address)).', under section-138 of  Negotiable Instrument Act 1881.</p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td height="50px">';
				$creditData.='<p style="color:white">asdfasdf</p>';
			$creditData.='</td>';
			$creditData.='<td>';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="20px">';
				$creditData.='<p>Signature of <span style="font-weight:bold">'.$details->plaintiff_name.'</span></p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>Attested:</p>';
			$creditData.='</td>';
			$creditData.='<td align="center">';
				$creditData.='';
			$creditData.='</td>';
		$creditData.='</tr>';
		$creditData.='<tr style="vertical-align:top;">';
			$creditData.='<td align="left" height="50px">';
				$creditData.='<p>_______________________________</p>';
			$creditData.='</td>';
			$creditData.='<td align="left">';
				$creditData.='<p></p>';
			$creditData.='</td>';
			$creditData.='</tr>';
		$creditData.='</table>';
		
		$pdf->SetFont("helvetica", "", 10);
		// Print colored table
		$pdf->showBody('',$creditData);
	}
}
//exit;
$pdf->Output("Pdf_authorization.pdf", "I");
?>
