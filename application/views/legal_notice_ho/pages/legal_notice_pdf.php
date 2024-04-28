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
$pdf->SetTitle("1st Legal Notice");
$pdf->SetSubject("1st Legal Notice");
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

	$str="SELECT  j0.proposed_type
				 FROM legal_notice j0
			 WHERE j0.sts = '1'  AND j0.id= '".$str2[$k]."' LIMIT 1";
	$application_data=$this->db->query($str)->row();
	$download_history_data = array(
		'ln_id' => $str2[$k],
		'd_by' => $this->session->userdata['ast_user']['user_id'],
		'd_dt' => date('Y-m-d H:i:s')
	);
	$this->db->insert('legal_notice_download_history', $download_history_data);
	if ($application_data->proposed_type=='Card') 
	{
		$br_address=array();
		$update_sl_sts = 0;
		$init = 0;
		$result = $this->Legal_notice_ho_model->get_word_card_data($str2[$k]);
		//For Word Serial Number
		if(!empty($result[0]['name']))
		{
			if ($result[0]['ln_serial']=='') {
				$new_sl_no=$this->user_model->get_word_serial(count($result[0]['guarntor']));
				$update_sl_sts = 1;
				$init = $new_sl_no;

			}else
			{
				$str = explode("-",$result[0]['ln_serial']);
				$new_sl_no = $str[0];
			}
		}
		else
		{
			$new_sl_no = "";
		}
		//$new_sl_no=1;
		// exit;
		$Q1 = $this->db->query("SELECT ln_address FROM project_info WHERE id='1'");
		$in_address = $Q1->result();

		$addr_type[]='Present Address';
		$addr_type[]='Parmanent Address';
		$addr_type[]='Business Address';
		for($i=0;$i<count($result[0]['guarntor']);$i++){				
					
			for($j=0;$j<3;$j++){
				$index = $i*3+$j;
									
				if($j==0){
					$address=$result[0]['guarntor'][$i]['present_address'];
					$address_field = 'present address';
				}elseif($j==1){
					$address=$result[0]['guarntor'][$i]['permanent_address'];
					$address_field = 'parmanent address';
				}elseif($j==2){
					$address=$result[0]['guarntor'][$i]['business_address'];
					$address_field = 'business address';
				}
				
				if($address==''){
					continue;
				}
				$array = array(
						'guarantor_id'=>$result[0]['guarntor'][$i]['id'],
						'ln_id'=>$str2[$k],
			            'br_counter'=>$new_sl_no,
			            'adress_field'=>$address_field,
			            'adress'=>$address
			    );
			    array_push($br_address,$array);
				$pdf->AddPage('P', 'A4');
				$creditData='';	
				$address_type=$addr_type[$i];
				
				if(strlen((string) $address)>100){
					$address = wordwrap($address,100,"\n");
				}else{
					$address = $address."\n";
				}
				if(strlen((string) $result[0]['chamber'])>100){
					$chamber = wordwrap($result[0]['chamber'],100,"\n");
				}else{
					$chamber = $result[0]['chamber']."\n";
				}
				if(strlen((string) $in_address[0]->ln_address)>100){
					$bank_address = wordwrap($in_address[0]->ln_address,100,"\n");
				}else{
					$bank_address = $in_address[0]->ln_address."\n";
				}
				$creditData.='<table style="align:center;border">';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td style="width:70%">';
							$creditData.='<span style="font-weight:bold">LN-SL-'.$result[0]['sl_no'].'-(BR-'.$new_sl_no.')</span>';
						$creditData.='</td>';
						$creditData.='<td style="width:30%">';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td>';
							$creditData.='<span style="font-weight:bold">'.$result[0]['ln_v_dt'].'</span>';
						$creditData.='</td>';
						$creditData.='<td>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td>';
							$creditData.='<p style="color:white">asdfasdf</p>';
						$creditData.='</td>';
						$creditData.='<td>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td>';
							$creditData.='<p>To</p>';
						$creditData.='</td>';
						$creditData.='<td>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td>';
							$creditData.='<span style="font-weight:bold">Credit Card Name:</span>'.$result[0]['ac_name'];
						$creditData.='</td>';
						$creditData.='<td>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td>';
							$creditData.='<span style="font-weight:bold">Father\'s Name: </span>'.$result[0]['guarntor'][$i]['father_name'];
						$creditData.='</td>';
						$creditData.='<td>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td >';
							$creditData.='<span style="font-weight:bold">Customer ID. </span>'.$result[0]['customer_id'];
						$creditData.='</td>';
						$creditData.='<td>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td>';
							$creditData.='<span style="font-weight:bold">Card No. : </span>'.$result[0]['loan_ac'];
						$creditData.='</td>';
						$creditData.='<td>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td style="word-wrap: break-word">';
							$creditData.='<span style="font-weight:bold">'.$address_type.': </span>'.preg_replace('/\s+/', ' ',$address);
						$creditData.='</td>';
						$creditData.='<td>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td>';
							$creditData.='<p style="color:white">asdfasdf</p>';
						$creditData.='</td>';
						$creditData.='<td>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td>';
							$creditData.='<p style="color:white">asdfasdf</p>';
						$creditData.='</td>';
						$creditData.='<td>';
						$creditData.='</td>';
					$creditData.='</tr>';
					
				$creditData.='</table>';
				$creditData.='<table style="align:center;">';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td colspan="2">';
							$creditData.='<span style="font-weight:bold">Dear Sir,</span>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td colspan="2">';
							$creditData.='<span style="font-weight:bold;color:white">asdfsd </span>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td style="word-wrap: break-word" colspan="2">';
							$creditData.='<span style="text-align:justify">Under the instruction of my Client, BRAC Bank PLC. (hereinafter referred to as Client) we do hereby give you this notice as under:</span>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td colspan="2">';
							$creditData.='<span style="font-weight:bold;color:white">asdfsd </span>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$icon = './images/media/icon.png';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td style="width:5%">';
							$creditData.='<img style="" width="10px" src="'.$icon.'"> ';
						$creditData.='</td>';
						
						$creditData.='<td style="width:95%;word-wrap: break-word">';
							$creditData.='<p style="text-align:justify">That my Client being a scheduled banking company granted to you a credit facility in the form of Credit Card, bearing Card No: '.$result[0]['loan_ac'].' for '.number_format(abs($result[0]['card_limit']),2,'.',',').' /- based on your loan (Credit Card) application, terms and conditions duly accepted by you and credit limit was available from '.$result[0]['card_iss_date'].'. Due to irregular and unsatisfied payment, the bank reserves the right to call up the entire Credit Card Facility.</p>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td style="">';
							$creditData.='<img style="" width="10px" src="'.$icon.'">';
						$creditData.='</td>';
						$creditData.='<td style="word-wrap: break-word">';
							$creditData.='<p style="text-align:justify">It has been observed that you have failed to make payment accordingly and your present outstanding of Tk. '.number_format(abs($result[0]['outstanding_bl']),2,'.',',').' as on '.$result[0]['outstanding_bl_dt'].'. During the last several months, our Client has sent several letters, made phone calls and also met with you several times for settlement. However, you have not settled your outstanding timely.</p>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td style="">';
							$creditData.='<img style="" width="10px" src="'.$icon.'"> ';
						$creditData.='</td>';
						$creditData.='<td style="word-wrap: break-word">';
							$creditData.='<p style="text-align:justify">In view of the above, we, on behalf of our Client, hereby request you to pay the money to my client Bank within 15 (fifteen) days from the date of this legal notice the total loan amount payable by you on account of the Credit Card, which is as of '.date('d-M-y').' amounts to Tk. '.number_format(abs($result[0]['outstanding_bl']),2,'.',',').' (Excluding Unapplied Charges). In the event of your failure to do so, we have clear instructions from our Client to take appropriate legal action under the Artha Rin Adalat Ain 2003 or any other applicable law for recovery of the said outstanding and in that event you shall be held responsible for all the costs and consequences thereof.</p>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td style="">';
							$creditData.='';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td colspan="2">';
							$creditData.='<span style="">A copy of this legal notice shall be kept in my chamber for further use and future reference.</span>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td style="">';
							$creditData.='';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td colspan="2">';
							$creditData.='<span style="">Yours sincerely,</span>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$signature = $result[0]['signature']!=''?'./ref_tables_files/'.$result[0]['signature']:'./ref_tables_files/nosig.png';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td colspan="2">';
							$creditData.='<img style="width:100px" src="'.$signature.'"><hr style="width:25%;text-align:left;margin-left:0">';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td colspan="2">';
							$creditData.='<span style="font-weight:bold;">'.$result[0]['name'].'</span>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td colspan="2">';
							$creditData.='<span style="font-weight:bold;">'.$result[0]['designation'].'</span>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td colspan="2">';
							$creditData.='<span style="font-weight:bold;">'.$result[0]['court_name'].'</span>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td style="word-wrap: break-word">';
							$creditData.='<span style="font-weight:bold;color:white">asdfsd </span>';
						$creditData.='</td>';
					$creditData.='</tr>';

					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td colspan="2" style="border:1px solid black">';
							$creditData.='<span style="">Copy to: Head of Legal Affairs Division, Head Office, BRAC Bank PLC. </span>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td colspan="2">';
							$creditData.='<span style="">*Please ignore the contents of this legal notice if have paid the entire outstanding amount meanwhile.</span>';
						$creditData.='</td>';
					$creditData.='</tr>';
					$creditData.='<tr style="vertical-align:top;">';
						$creditData.='<td colspan="2">';
							$creditData.='<span style="">*Please emargency contract to settle the account [AM Name: <strong>'.$result[0]['tm_name'].'</strong>, Cell: <strong>'.$result[0]['mobile_number'].'</strong>]</span>';
						$creditData.='</td>';
					$creditData.='</tr>';
				$creditData.='</table>';
				$pdf->SetFont("helvetica", "", 10);
				// Print colored table
				$pdf->showBody('',$creditData);	
				
				$new_sl_no++;					
			}
		}
		if ($update_sl_sts==1) {
			$update_sl = $init.'-'.($new_sl_no-1);
			$legal_notice_data['ln_serial'] = $update_sl;
			$legal_notice_data['download_sts'] = 1;
			$this->db->where('id', $str2[$k]);
			$this->db->update('legal_notice', $legal_notice_data);
			$new_sl_no=$this->user_model->update_word_serial($new_sl_no-$init);

			$this->db->insert_batch('ln_address_by_br_serial', $br_address);
		}
		
	}
	else
	{
		$br_address=array();
		$update_sl_sts = 0;
		$init = 0;
		$pdf->SetMargins(20,25,20,0, PDF_MARGIN_RIGHT);
		// A recordset for merging tables
		$result = $this->Legal_notice_ho_model->get_word_data($str2[$k]);
		//For Word Serial Number
		if(!empty($result[0]['name']))
		{
			if ($result[0]['ln_serial']=='') {
				$new_sl_no=$this->user_model->get_word_serial(count($result[0]['guarntor']));
				$update_sl_sts = 1;
				$init = $new_sl_no;
			}else
			{
				$str = explode("-",$result[0]['ln_serial']);
				$new_sl_no = $str[0];
			}
		}
		else
		{
			$new_sl_no = "";
		}
		$Q1 = $this->db->query("SELECT ln_address FROM project_info WHERE id='1'");
		$in_address = $Q1->result();
		$cc_gurantor='';
		foreach($result[0]['guarntor'] as $key=>$gurantorc){
			if($key==0){
				$cc_gurantor = $gurantorc['guarantor_name'];
			}else{
				$cc_gurantor = $cc_gurantor.', '.$gurantorc['guarantor_name'];
			}
			
		}
		$brrower_name='';
		$counter=0;
		for($i=0;$i<count($result[0]['guarntor']);$i++){
			if($result[0]['guarntor'][$i]['guarantor_type']=='M'){
				$brrower_name=$result[0]['guarntor'][$i]['guarantor_name'];
			}
			for($j=0;$j<3;$j++){
				$index = $i*3+$j;
				$counter++;			
				if($j==0){
					$address=$result[0]['guarntor'][$i]['present_address'];
					$address_field = 'present address';
				}elseif($j==1){
					$address=$result[0]['guarntor'][$i]['permanent_address'];
					$address_field = 'parmanent address';
				}elseif($j==2){
					$address=$result[0]['guarntor'][$i]['business_address'];
					$address_field = 'business address';
				}
				
				if(ltrim($address," ")==''){
					continue;
				}
				
				$array = array(
						'guarantor_id'=>$result[0]['guarntor'][$i]['id'],
						'ln_id'=>$str2[$k],
			            'br_counter'=>$new_sl_no,
			            'adress_field'=>$address_field,
			            'adress'=>$address
			    );
			    array_push($br_address,$array);
				if(strlen((string) $address)>100){
					$address = wordwrap($address,100,"\n");
				}else{
					$address = $address."\n";
				}
				if(strlen((string) $result[0]['chamber'])>100){
					$chamber = wordwrap($result[0]['chamber'],100,"\n");
				}else{
					$chamber = $result[0]['chamber']."\n";
				}
				if(strlen((string) $in_address[0]->ln_address)>100){
					$bank_address = wordwrap($in_address[0]->ln_address,100,"\n");
				}else{
					$bank_address = $in_address[0]->ln_address."\n";
				}
				
				$dis_amount_A=explode(",",$result[0]['facility_loan'][0]['disbursed_amount']);
				$disbursed_amount=0;
				for($e=0; $e<count($dis_amount_A); $e++){
					if($e==0){$disbursed_amount=number_format(abs($dis_amount_A[$e]));}
					else{ $disbursed_amount.=', '.number_format(abs($dis_amount_A[$e]));}
				}
				
				
				if($result[0]['guarntor'][$i]['guarantor_type']=='M'){
					$pdf->AddPage('P', 'A4');
					$creditData='';	
					$creditData.='<table style="align:center;border">';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td style="width:60%">';
										$creditData.='<span style="font-weight:bold">SL-'.$result[0]['sl_no'].'-(BR-'.$new_sl_no.')</span>';
									$creditData.='</td>';
									$creditData.='<td style="width:40%">';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='<span style="font-weight:bold">'.$result[0]['ln_v_dt'].'</span>';
									$creditData.='</td>';
									$creditData.='<td>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='<span style="font-weight:bold">'.$brrower_name.'</span>';
									$creditData.='</td>';
									$creditData.='<td>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='<span style="font-weight:bold">Father\'s Name: </span>'.$result[0]['guarntor'][$i]['father_name'];
									$creditData.='</td>';
									$creditData.='<td>';
										$creditData.='<u><span style="font-weight:bold">Loan Account No. </span></u><span style="font-weight:bold">'.$result[0]['loan_ac'].'</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='<span style="font-weight:bold">Proprietor Of:  </span>'.$result[0]['ac_name'];
									$creditData.='</td>';
									$creditData.='<td>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td style="word-wrap:break-word">';
										$creditData.='<span >'.$address.'</span>';
									$creditData.='</td>';
									$creditData.='<td>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
									$creditData.='</td>';
									$creditData.='<td align="right">';
										$creditData.='<span style="font-weight:bold">-------------<u>Notice Receiver</u></span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='<span style="font-weight:bold">From:</span>';
									$creditData.='</td>';
									$creditData.='<td>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='<span style="font-weight:bold">'.$result[0]['name'].'</span>';
									$creditData.='</td>';
									$creditData.='<td>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='<span style="font-weight:bold">'.$result[0]['designation'].'</span>';
									$creditData.='</td>';
									$creditData.='<td>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td style="word-wrap:break-word">';
										$creditData.='<strong>Chamber: </strong><span style="">'.$chamber.'</span>';
									$creditData.='</td>';
									$creditData.='<td>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
									$creditData.='</td>';
									$creditData.='<td align="right">';
										$creditData.='<span style="font-weight:bold">-------------<u>Notice Giver</u></span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='<span style="font-weight:bold">For and on behalf of:</span>';
									$creditData.='</td>';
									$creditData.='<td>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2" style="word-wrap:break-word">';
										$creditData.='<span style="text-align:justify">BRAC Bank PLC., '.$bank_address.'</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='<p style="color:white">asdfasdf</p>';
									$creditData.='</td>';
									$creditData.='<td>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='';
									$creditData.='</td>';
								$creditData.='</tr>';
								
							$creditData.='</table>';
							$creditData.='<table style="align:center;">';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2">';
										$creditData.='<span style="font-weight:bold">Dear Sir,</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td style="word-wrap: break-word" colspan="2">';
										$creditData.='<span style="text-align:justify">Upon the instruction of our aforesaid Client, BRAC Bank PLC. (hereinafter referred to as our Client) we do hereby give you this notice as under:</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$icon = './images/media/icon.png';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td style="width:5%">';
										$creditData.='<img style="" width="10px" src="'.$icon.'">';
									$creditData.='</td>';
									$creditData.='<td style="width:95%;word-wrap: break-word">';
										$creditData.='<p style="text-align:justify">That on the basis of your application, BRAC Bank PLC. granted and you availed a credit facility in favor of <strong>'.$result[0]['facility_loan'][0]['l_ac_names'].'</strong> on <strong>'.$result[0]['facility_loan'][0]['disbursement_date'].'</strong> in the form of <strong>'.$result[0]['facility_loan'][0]['sch_desc_s'].'</strong>, bearing A/C# <strong>'.$result[0]['facility_loan'][0]['l_ac_numbers'].'</strong> for Tk. <strong>'.$disbursed_amount.'</strong>/- only subject to terms and conditions inter alia that in case of your non-payment of  3 (Three) installments, the Bank reserves the right to call back and take necessary legal steps to recover the loan liability.</p>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td style="">';
										$creditData.='<img style="" width="10px" src="'.$icon.'">';
									$creditData.='</td>';
									$creditData.='<td style="word-wrap: break-word">';
										$creditData.='<p style="text-align:justify">Unfortunately, you failed to repay the EMI on time. Even after several letters, reminders and phone calls, you utterly failed to settle the outstanding loan liabilities till date and have been practicing delay tactics to defraud the legitimate claim of our client. Present outstanding liability stands at Tk. <strong>'.number_format(abs($result[0]['facility_loan'][0]['outstanding_bl'])).'</strong>/-as on <strong>'.$result[0]['facility_loan'][0]['outstanding_bl_dt'].'</strong> (excluding any others charges, govt. fees as applicable) against your loan.</p>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td style="">';
										$creditData.='<img style="" width="10px" src="'.$icon.'">';
									$creditData.='</td>';
									$creditData.='<td style="word-wrap: break-word">';
										$creditData.='<p style="text-align:justify">Hence, you are finally instructed to requested to pay and settle the outstanding loan liabilities as mentioned above within 15 (Fifteen) days from the date of this Legal Notice. In the event of your failure to discharge your liability, our client will be constrained to initiate necessary legal recourses including making a complaint with law enforcing agency for your criminal breach of trust and file suit for recovery Under Artho Rin -2003 as applicable against you and you shall be held responsible for all the costs and consequences thereof.</p>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td style="">';
										$creditData.='';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2">';
										$creditData.='<span style="">A copy of this legal notice shall be kept in my chamber for further use and future reference.</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td style="">';
										$creditData.='';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2">';
										$creditData.='<span style="">Yours sincerely,</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$signature = $result[0]['signature']!=''?'./ref_tables_files/'.$result[0]['signature']:'./ref_tables_files/nosig.png';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2">';
										$creditData.='<img style="width:100px" src="'.$signature.'"><hr style="width:25%;text-align:left;margin-left:0">';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2">';
										$creditData.='<span style="font-weight:bold;">'.$result[0]['name'].'</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2">';
										$creditData.='<span style="font-weight:bold;">'.$result[0]['designation'].'</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2">';
										$creditData.='<span style="font-weight:bold;">'.$result[0]['court_name'].'</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td style="word-wrap: break-word">';
										$creditData.='<span style="font-weight:bold;color:white">asdfsd </span>';
									$creditData.='</td>';
								$creditData.='</tr>';

								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2" style="border:1px solid black">';
										$creditData.='<span style="">Copy to: Head of Legal Affairs Division, Head Office, BRAC Bank PLC. </span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2" style="">';
										$creditData.='<span style="font-weight:bold;">Cc: Gurantor : '.$cc_gurantor.'</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2">';
										$creditData.='<span style="">*Please ignore the contents of this legal notice if have paid the entire outstanding amount meanwhile.</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2">';
										$creditData.='<span style="">*Please emargency contract to settle the account [TM Name: <strong>'.$result[0]['tm_name'].'</strong>, Cell: <strong>'.$result[0]['mobile_number'].'</strong>]</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
							$creditData.='</table>';
							$pdf->SetFont("helvetica", "", 10);
							// Print colored table
							$pdf->showBody('',$creditData);							
					
				}else{
				
					$pdf->AddPage('P', 'A4');
					$creditData='';	
					$creditData.='<table style="align:center;border">';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td style="width:60%">';
										$creditData.='<span style="font-weight:bold">SL-'.$result[0]['sl_no'].'-(BR-'.$new_sl_no.')</span>';
									$creditData.='</td>';
									$creditData.='<td style="width:40%">';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='<span style="font-weight:bold">'.$result[0]['ln_v_dt'].'</span>';
									$creditData.='</td>';
									$creditData.='<td>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='<span style="font-weight:bold">Gurantor: </span>'.$result[0]['guarntor'][$i]['guarantor_name'];
									$creditData.='</td>';
									$creditData.='<td>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='<span style="font-weight:bold">Father\'s Name: </span>'.$result[0]['guarntor'][$i]['father_name'];
									$creditData.='</td>';
									$creditData.='<td>';
										$creditData.='<u><span style="font-weight:bold">Loan Account No. </span></u><span style="font-weight:bold">'.$result[0]['loan_ac'].'</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='<span style="font-weight:bold">Add:  </span>'.$address;
									$creditData.='</td>';
									$creditData.='<td>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
									$creditData.='</td>';
									$creditData.='<td align="right">';
										$creditData.='<span style="font-weight:bold">-------------<u>Notice Receiver</u></span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='<span style="font-weight:bold">From:</span>';
									$creditData.='</td>';
									$creditData.='<td>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='<span style="font-weight:bold">'.$result[0]['name'].'</span>';
									$creditData.='</td>';
									$creditData.='<td>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='<span style="font-weight:bold">'.$result[0]['designation'].'</span>';
									$creditData.='</td>';
									$creditData.='<td>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td style="word-wrap:break-word">';
										$creditData.='<strong>Chamber: </strong><span style="">'.$chamber.'</span>';
									$creditData.='</td>';
									$creditData.='<td>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
									$creditData.='</td>';
									$creditData.='<td align="right">';
										$creditData.='<span style="font-weight:bold">-------------<u>Notice Giver</u></span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='<span style="font-weight:bold">For and on behalf of:</span>';
									$creditData.='</td>';
									$creditData.='<td>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2" style="word-wrap:break-word">';
										$creditData.='<span style="text-align:justify">BRAC Bank PLC., '.$bank_address.'</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='<p style="color:white">asdfasdf</p>';
									$creditData.='</td>';
									$creditData.='<td>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td>';
										$creditData.='';
									$creditData.='</td>';
								$creditData.='</tr>';
								
							$creditData.='</table>';
							$creditData.='<table style="align:center;">';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2">';
										$creditData.='<span style="font-weight:bold">Dear Sir,</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td style="word-wrap: break-word" colspan="2">';
										$creditData.='<span style="text-align:justify">Upon the instruction of our aforesaid Client, BRAC Bank PLC. (hereinafter referred to as our Client) we do hereby give you this notice as under:</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$icon = './images/media/icon.png';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td style="width:5%">';
										$creditData.='<img style="" width="10px" src="'.$icon.'">';
									$creditData.='</td>';
									$creditData.='<td style="width:95%;word-wrap: break-word">';
										$creditData.='<p style="text-align:justify">This refers to the credit facility sanctioned in favor of <strong>'.$result[0]['facility_loan'][0]['l_ac_names'].'</strong> in the form of <strong>'.$result[0]['facility_loan'][0]['sch_desc_s'].'</strong>, bearing disburse date <strong>'.$result[0]['facility_loan'][0]['disbursement_date'].'</strong> and A/C# <strong>'.$result[0]['facility_loan'][0]['l_ac_numbers'].'</strong> for Tk. <strong>'.number_format(abs($result[0]['facility_loan'][0]['outstanding_bl'])).'</strong>/- only. You stood as guarantor against the said loan and guaranteed that in the event the borrower would fail to repay and settle the loan liability, you will repay the loan and shall be held jointly and severally liable to repay and settle the loan liability to our client, BRAC Bank PLC.</p>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td style="">';
										$creditData.='<img style="" width="10px" src="'.$icon.'">';
									$creditData.='</td>';
									$creditData.='<td style="word-wrap: break-word">';
										$creditData.='<p style="text-align:justify">Unfortunately, the borrower failed to repay the loan on time. Even after several letters, reminders and phone calls, the borrower is not settling the outstanding loan liabilities till date and has been practicing delay tactics to defraud the legitimate claim of our client. Present outstanding liability stands at Tk. <strong>'.number_format(abs($result[0]['facility_loan'][0]['outstanding_bl'])).'</strong>/-as on <strong>'.$result[0]['facility_loan'][0]['outstanding_bl_dt'].'</strong> (excluding any others charges, govt. fees as applicable) against the aforesaid loan. </p>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td style="">';
										$creditData.='<img style="" width="10px" src="'.$icon.'">';
									$creditData.='</td>';
									$creditData.='<td style="word-wrap: break-word">';
										$creditData.='<p style="text-align:justify">Hence, you are requested to arrange for repayment and settlement of the outstanding loan liabilities as mentioned above within 15 (Fifteen) days from the date of this Legal Notice. In the event of your failure to discharge your liability, our client will be constrained to initiate necessary legal recourses including making a complaint with law enforcing agency and file suit for recovery Under Artho Rin -2003 as applicable against you and you shall be held responsible for all the costs and consequences thereof.</p>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td style="">';
										$creditData.='';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2">';
										$creditData.='<span style="">A copy of this legal notice shall be kept in my chamber for further use and future reference.</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td style="">';
										$creditData.='';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2">';
										$creditData.='<span style="">Yours sincerely,</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$signature = $result[0]['signature']!=''?'./ref_tables_files/'.$result[0]['signature']:'./ref_tables_files/nosig.png';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2">';
										$creditData.='<img style="width:100px" src="'.$signature.'"><hr style="width:25%;text-align:left;margin-left:0">';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2">';
										$creditData.='<span style="font-weight:bold;">'.$result[0]['name'].'</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2">';
										$creditData.='<span style="font-weight:bold;">'.$result[0]['designation'].'</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2">';
										$creditData.='<span style="font-weight:bold;">'.$result[0]['court_name'].'</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td style="word-wrap: break-word">';
										$creditData.='<span style="font-weight:bold;color:white">asdfsd </span>';
									$creditData.='</td>';
								$creditData.='</tr>';

								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2" style="border:1px solid black">';
										$creditData.='<span style="">Copy to: Head of Legal Affairs Division, Head Office, BRAC Bank PLC. </span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2" style="">';
										$creditData.='<span style="font-weight:bold;">Cc: Borrower: '.$brrower_name.'</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2">';
										$creditData.='<span style="">*Please ignore the contents of this legal notice if have paid the entire outstanding amount meanwhile.</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
								$creditData.='<tr style="vertical-align:top;">';
									$creditData.='<td colspan="2">';
										$creditData.='<span style="">*Please emargency contract to settle the account [TM Name: <strong>'.$result[0]['tm_name'].'</strong>, Cell: <strong>'.$result[0]['mobile_number'].'</strong>]</span>';
									$creditData.='</td>';
								$creditData.='</tr>';
							$creditData.='</table>';
							$pdf->SetFont("helvetica", "", 10);
							// Print colored table
							$pdf->showBody('',$creditData);	
				    
				}
				$new_sl_no++;	
			}
		}
		if ($update_sl_sts==1) {
			$update_sl = $init.'-'.($new_sl_no-1);
			$legal_notice_data['ln_serial'] = $update_sl;
			$legal_notice_data['download_sts'] = 1;
			$this->db->where('id', $str2[$k]);
			$this->db->update('legal_notice', $legal_notice_data);
			$new_sl_no=$this->user_model->update_word_serial($new_sl_no-$init);

			$this->db->insert_batch('ln_address_by_br_serial', $br_address);
		}	
	}
}

		
$pdf->Output("Pdf_legal_notice.pdf", "I");
?>
