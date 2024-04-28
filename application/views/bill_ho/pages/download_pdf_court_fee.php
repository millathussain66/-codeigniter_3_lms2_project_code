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
		$this->Cell(180,0,"Brack Bank Ltd.",'',2,'C',0);
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
$pdf->SetTitle("Court Fee");
$pdf->SetSubject("Court Fee");
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
$pdf->SetMargins(15,15,15,0, PDF_MARGIN_RIGHT);
$pdf->AddPage('P', 'A4');
$pdf->SetFont("helvetica", "", 10);
$bill_dt = '';
$vendor_type = '';
$tax_vat_text = '';
$vendor_name = '';
$dispatch_no = '';
$bank_ac = '';
$tin = '';
$district = '';
$e_by_name = '';
$e_by_pin = '';
$e_fun_deg = '';
$v_by_name = '';
$v_by_pin = '';
$v_fun_deg = '';
$ref_no = '';
$date_f = '';
$bank_name = 'BRAC Bank Ltd.';
$branch_name ='';
if (!empty($details)) 
{
	foreach($details as $key)
	{
		$vendor_type = $key->vendor_type;
		$vendor_name = $key->vendor_name;
		$bill_dt = $key->txrn_dt;
		$dispatch_no = $key->dispatch_no;
		$bank_ac = $key->bank_ac;
		$tin = $key->tin_number;
		$district = $key->district;
		$e_by_name = $key->e_by_name;
    	$e_by_pin = $key->e_by_pin;
    	$e_fun_deg = $key->e_fun_deg;
    	$tax_vat_text = $key->tax_vat_text;
    	$v_by_name = $key->v_by_name;
    	$v_by_pin = $key->v_by_pin;
    	$v_fun_deg = $key->v_fun_deg;
		$ref_no = $key->ref_no;
		$date_f = $key->date_f;
		if ($key->bank_name!='') {
			$bank_name = $key->bank_name;
		}
		$branch_name = $key->branch_name;
		break;
	}
}
$html='';

$html.='<br><br><br><br><br><table style="border:1px solid #000;">
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td rowspan="2" style="width:30%;">';
			$pdf->setJPEGQuality(75);
			$pdf->Image('images/login_images/client.png', 17, 40, 20, 10, '', '', '', true, 150);
			$html.='</td>
			<td style="width:3%;"></td>
			<td colspan="2" rowspan="2" style="width:33%;">Payment Approval Note</td>
			<td style="width:17%;">Dispatch No.</td>
			<td style="width:16%;">'.$dispatch_no.'</td>
		</tr>
		<tr>
			<td></td>
			<td>TIN</td>
			<td>'.$tin.'</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td style="border-top:1px solid #000;">Date</td>
			<td style="border-top:1px solid #000;" >:</td>
			<td style="border-top:1px solid #000;" colspan="4" >'.date_format(new DateTime($bill_dt),"d-M-Y").'</td>
		</tr>
		<tr>
			<td >Name of Lawyer</td>
			<td >:</td>
			<td colspan="4">'.$vendor_name.'</td>
		</tr>
		<tr>
			<td >WO/PO Ref</td>
			<td >:</td>
			<td colspan="2" >As per DOA</td>
			<td colspan="2" >'.$district.'</td>
		</tr>
		<tr>
			<td >Vendor Ref  No</td>
			<td >:</td>
			<td colspan="2">'.$ref_no.'</td>
			<td colspan="2">'.$date_f.'</td>
		</tr>
		<tr>
			<td >Purpose</td>
			<td >:</td>
			<td colspan="4">'.$vendor_type.'</td>
		</tr>';
		$no_of_account = 0;
	        $total_amount = 0;
	        if (!empty($details)) 
	    	{
	    		foreach($details as $key)
	    		{
	    			$no_of_account+=$key->account_counter;
	    			$total_amount+=($key->amount-$key->discount_amount);
	    			if ($key->loan_segment=='S') {
	    				$html.='<tr>
							<td >LITIGATION MGT.-SME</td>
							<td >:</td>
							<td style="border:1px solid #000;">10371295</td>
							<td style="border:1px solid #000;">'.number_format($key->amount-$key->discount_amount,2).'</td>
							<td style="border:1px solid #000;">'.$key->account_counter.'</td>
							<td ></td>
						</tr>';
	    			}
	    			else if($key->loan_segment=='R')
	    			{
	    				$html.='<tr>
							<td >LITIGATION MGT.-RETAIL</td>
							<td >:</td>
							<td style="border:1px solid #000;">10371296</td>
							<td style="border:1px solid #000;">'.number_format($key->amount-$key->discount_amount,2).'</td>
							<td style="border:1px solid #000;">'.$key->account_counter.'</td>
							<td ></td>
						</tr>';
	    			}
	    			else if($key->loan_segment=='C')
	    			{
	    				$html.='<tr>
							<td >CRM-SAM-CORP</td>
							<td >:</td>
							<td style="border:1px solid #000;">10311260</td>
							<td style="border:1px solid #000;">'.number_format($key->amount-$key->discount_amount,2).'</td>
							<td style="border:1px solid #000;">'.$key->account_counter.'</td>
							<td ></td>
						</tr>';
	    			}
	    			
	    		}
	    	}
	    $amount_in_word = convert_number($total_amount)." Taka";
	    if(is_float($total_amount))
	    {
	    	$float_amount = explode(".",$total_amount);
		    if(count($float_amount)>1 && $float_amount[1]>0)
		    {
		    	$amount_in_word.=" And Paisa ";
		    	$amount_in_word.=convert_number($float_amount[1]);
		    }
	    }
		$html.='
		<tr>
			<td colspan="6" ></td>
		</tr>
		<tr>
			<td >Total No. Of A/C\'s</td>
			<td >:</td>
			<td style="border:1px solid #000;">'.$no_of_account.'</td>
			<td ></td>
			<td ></td>
			<td ></td>
		</tr>
		<tr>
			<td colspan="6" ></td>
		</tr>
		<tr>
			<td >Invoice Value (In Figure)</td>
			<td >:</td>
			<td style="border:1px solid #000;">'.number_format($total_amount,2).'</td>
			<td ></td>
			<td ></td>
			<td ></td>
		</tr>
		<tr>
			<td >Invoice Value (In Words)</td>
			<td >:</td>
			<td colspan="4">'.$amount_in_word.' Only</td>
		</tr>
		<tr>
			<td>Payment Break up</td>
			<td>:</td>
			<td></td>
			<td>Amount BDT</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Payment Break up</td>
			<td>:</td>
			<td colspan="3" rowspan="4">
				<table style="padding:1px 2px;">
					<tr>
						<td style="border:1px solid #000;">WO/PO Value</td>
						<td style="border:1px solid #000;"></td>
					</tr>
					<tr>
						<td style="border:1px solid #000;">Bill/Invoice amount</td>
						<td style="border:1px solid #000;">'.number_format($total_amount,2).'</td>
					</tr>
					<tr>
						<td style="border:1px solid #000;">Advance/Paid up to date</td>
						<td style="border:1px solid #000;">_</td>
					</tr>
					<tr>
						<td style="border:1px solid #000;">Remaining (A-B-C)</td>
						<td style="border:1px solid #000;"></td>
					</tr>
				</table>
			</td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td>:</td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td>:</td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td>:</td>
			<td></td>
		</tr>
		<tr>
			<td colspan="6" ></td>
		</tr>
		<tr>
			<td colspan="6" style="border:1px solid #000;">'.$tax_vat_text.'</td>
		</tr>
		<tr>
			<td colspan="6" ></td>
		</tr>
		<tr>
			<td rowspan="2" >Please Credit this amount Against</td>
			<td ></td>
			<td colspan="2">'.$bank_ac.'</td>
			<td colspan="2">'.$vendor_name.'</td>
		</tr>
		<tr>
			<td ></td>
			<td colspan="2">'.$bank_name.'</td>
			<td colspan="2">'.$branch_name.'</td>
		</tr>
		<tr>
			<td colspan="6" ></td>
		</tr>
		<tr>
			<td colspan="6" ></td>
		</tr>
		<tr>
			<td colspan="6" ></td>
		</tr>
		<tr>
			<td colspan="6" ></td>
		</tr>
		<tr>
			<td style="border-top:1px solid #000;text-align:center;" colspan="2">Initiated by </td>
			<td ></td>
			<td ></td>
			<td style="border-top:1px solid #000;text-align:center;" colspan="2" >Verified By</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center;">'.$e_by_name.' (PIN:'.$e_by_pin.')'.'</td>
			<td ></td>
			<td ></td>
			<td colspan="2" style="text-align:center;">'.$v_by_name.' (PIN:'.$v_by_pin.')'.'</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center;">'.$e_fun_deg.'</td>
			<td ></td>
			<td ></td>
			<td colspan="2" style="text-align:center;">'.$v_fun_deg.'</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center;">Legal & Recovery  Division</td>
			<td ></td>
			<td ></td>
			<td colspan="2" style="text-align:center;">Legal & Recovery  Division</td>
		</tr>
		<tr>
			<td colspan="6" ></td>
		</tr>
		<tr>
			<td colspan="6" ></td>
		</tr>
		<tr>
			<td colspan="6" ></td>
		</tr>
		<tr>
			<td colspan="6"></td>
		</tr>
		<tr>
			<td ></td>
			<td style="border-top:1px solid #000;text-align:center;" colspan="3" >Approved by</td>
			<td colspan="2" ></td>
		</tr>
		<tr>
			<td ></td>
			<td colspan="3" style="text-align:center;">Rasheed Ahmed (PIN-3979)</td>
			<td colspan="2" ></td>
		</tr>
		<tr>
			<td ></td>
			<td colspan="3" style="text-align:center;">Head of Legal & Recovery Division</td>
			<td colspan="2" ></td>
		</tr>
		<tr>
			<td colspan="6" ></td>
		</tr>
		<tr>
			<td style="border-top:1px solid #000;font-size: 9px;" rowspan="8" >For Finance</td>
			<td style="border-top:1px solid #000;font-size: 9px;border-left:1px solid #000;border-right:1px solid #000;" colspan="3" >GL Name : Court Fee Stamps</td>
			<td style="border-top:1px solid #000;font-size: 9px;" colspan="2" rowspan="8" ></td>
		</tr>
		<tr>
			<td colspan="3" style="border-left:1px solid #000;font-size: 9px;border-right:1px solid #000;">GL No: 0000050630000026</td>
		</tr>
		<tr>
			<td style="border:1px solid #000;font-size: 9px;" colspan="2" >Particulars</td>
			<td style="border:1px solid #000;font-size: 9px;">Amount TK</td>
		</tr>
		<tr>
			<td style="border:1px solid #000;font-size: 9px;" colspan="2" >Bill/Invoice (Inc. VAT)</td>
			<td style="border:1px solid #000;font-size: 9px;">_</td>
		</tr>
		<tr>
			<td style="border:1px solid #000;font-size: 9px;" colspan="2" >VAT (%)</td>
			<td style="border:1px solid #000;font-size: 9px;"></td>
		</tr>
		<tr>
			<td style="border:1px solid #000;font-size: 9px;" colspan="2" >Bill/Invoice (Excl. VAT)</td>
			<td style="border:1px solid #000;font-size: 9px;"></td>
		</tr>
		<tr>
			<td style="border:1px solid #000;font-size: 9px;" colspan="2" >Advance Income Tax</td>
			<td style="border:1px solid #000;font-size: 9px;"></td>
		</tr>
		<tr>
			<td style="border:1px solid #000;font-size: 9px;" colspan="2" >Net Pay </td>
			<td style="border:1px solid #000;font-size: 9px;"></td>
		</tr>
		<tr>
			<td colspan="6" ></td>
		</tr>
		<tr>
			<td style="border-top:1px solid #000;text-align:center;font-size: 9px;" >Checked by</td>
			<td colspan="3" ></td>
			<td style="border-top:1px solid #000;text-align:center;font-size: 9px;" colspan="2" >Approved by</td>
		</tr>
		
</table>';


$pdf->showBody('',$html);
		
$pdf->Output("Pdf_bill_proccess.pdf", "I");
?>
