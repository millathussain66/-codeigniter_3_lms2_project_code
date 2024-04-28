<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cornjob extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Case_file_rt_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('User_model', '', TRUE);
	}
	function translate_number( $str ) {
        $en = array( 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 );
        $bn = array( '০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯' );

        $str = str_replace( $en, $bn, $str );

        return $str;
    }
	function translate_month( $str ) {
        $en = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );
        $en_short = array( 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' );
        $bn = array( 'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'অগাস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর' );

        $str = str_replace( $en, $bn, $str );
        $str = str_replace( $en_short, $bn, $str );

        return $str;
    }
	function action()
	{
		//clearing statement data from statement table
		$this->db->query("TRUNCATE statement_data;");
		/// End //// 
		
		$sms_counter=0;
		$mail_counter=0;

		//For send lawyer sms of pending bill
		$data=date('Y-m-d');
		$first_date = date("Y-m-01", strtotime($data));
		if($data==$first_date)
		{

			$str="SELECT sub.vendor_type,sub.bill_year,sub.vendor_id,sub.vendor_mobile,GROUP_CONCAT(sub.bill_dt ORDER BY sub.vendor_id ASC SEPARATOR ',') AS bill_dt 
				FROM
				(
				SELECT  j0.vendor_type,DATE_FORMAT(j0.txrn_dt,'%M') AS bill_dt,DATE_FORMAT(j0.txrn_dt,'%Y') AS bill_year,j0.vendor_id,IF(j0.vendor_type=1,l.mobile,p.mobile) AS vendor_mobile
					         FROM cost_details j0
						        LEFT OUTER JOIN ref_lawyer l ON (l.id=j0.vendor_id AND j0.vendor_type=1)
						        LEFT OUTER JOIN ref_paper_vendor p ON (p.id=j0.vendor_id AND j0.vendor_type=2)
						     WHERE j0.amount>0 AND (j0.vendor_type=1 OR (j0.vendor_type=2 AND j0.paper_bill_vendor_type='Vendor')) AND DATEDIFF('".$data."',j0.txrn_dt)>=30 
						     	AND (j0.legal_select_sts IS NULL OR j0.legal_select_sts='') AND (j0.memo_sts IS NULL OR j0.memo_sts='')
						     	GROUP BY j0.vendor_type,j0.vendor_id,MONTH(j0.txrn_dt) order by MONTH(j0.txrn_dt) DESC
				)sub GROUP BY sub.vendor_type,sub.vendor_id ";
	                     
	        $bill_result=$this->db->query($str)->result();

	        //send mobile sms for lawyer professional bill
	        if(count($bill_result)>0)
	        {
	        	foreach ($bill_result as $bill_data) {
	        		$existed_bill_data = $this->db->query("SELECT id from bill_summery where ((bill_type=1 AND vendor='".$bill_data->vendor_id."') OR (bill_type=2 AND vendor='".$bill_data->vendor_id."')) AND sts<>0 AND YEAR(memo_e_by)='".date('Y')."' AND AND MONTH(memo_e_by)='".date('m')."'")->row();
		        	if(!empty($existed_bill_data))
		        	{
		        		continue;//continue if any bill generated alredy for this month
		        	}
		        	if($bill_data->vendor_mobile!='' && $bill_data->vendor_mobile!=NULL)
		        	{
		        		$message = 'Please submit your unclaimed professional fees for '.$bill_data->bill_dt.' '.$bill_data->bill_year.' at your earliest.';
		        		$sms_counter++;
		            	$sms = $this->user_model->send_sms($message,$bill_data->vendor_mobile,'bill_processing',0,$bill_data->vendor_id);
		        	}
		        }
	        }
		}

        //For case status update list
        $str="SELECT g.id,g.user_group_id,g.email_address,g.name,g.user_id
            FROM users_info g 
            WHERE g.verify_status = '0' 
            AND g.block_status = '0'
            AND (FIND_IN_SET(1,g.user_group_id) OR FIND_IN_SET(2,g.user_group_id))
            AND g.admin_status <> '2'
            ORDER BY g.user_group_id ASC ";
            $result=$this->db->query($str)->result();
        if(count($result)>0)
        {
            foreach ($result as $key) {
                $table_name = "suit_filling_info";

                $str_where = "s.sts=1 AND s.suit_sts=75";
                $str_where .=" AND s.case_deal_officer='".$key->id."'";


                $str_where.= "AND s.next_dt_sts=1 AND date_format(s.next_date,'%Y-%m-%d')='".date('Y-m-d')."'";
                
                $sql = "SELECT s.id,s.sts,s.merged_with,fr.name as final_remarks,s.remarks_prev_date,s.proposed_type,s.case_number,s.loan_ac,s.ac_name,r.name as requisition_name,IF(s.case_name IS NOT NULL,cn.name,r.type_of_case) as case_name,
			        DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,s.case_claim_amount,IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d/%m/%Y'),s.next_date) AS next_date,IF(s.next_dt_sts=1,ns.name,'') AS next_date_sts,
			        DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,cs.name as case_sts_prev_dt,d.name as district,IF(s.req_type=2,sca.name,scn.name) as act_prev_date,
			        lr.name as legal_region,ls.name as loan_segment,s.remarks_next_date,
			        CONCAT(fp.name,' (',fp.pin,')')as filling_plaintiff,CONCAT(pp.name,' (',pp.pin,')')as present_plaintiff,ter.name as territory,
			        CONCAT(cd.name,' (',cd.pin,')')as case_deal_officer,l.name as lawyer_name,prec.name as prev_court_name,presc.name as prest_court_name
			            FROM suit_filling_info as s
			            LEFT OUTER JOIN cma c ON (c.id=s.cma_id)
			            LEFT OUTER JOIN ref_req_type r ON (r.id=s.req_type)
			            LEFT OUTER JOIN ref_case_name cn ON (cn.id=s.case_name)
			            LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
			            LEFT OUTER JOIN ref_case_sts ns ON (ns.id=s.case_sts_next_dt)
			            LEFT OUTER JOIN ref_legal_district d ON (d.id=s.district)
			            LEFT OUTER JOIN ref_legal_region lr ON (lr.id=s.region)
			            LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
			            LEFT OUTER JOIN ref_loan_segment ls ON (ls.code=s.loan_segment)
			            LEFT OUTER JOIN users_info fp ON (fp.id=s.filling_plaintiff)
			            LEFT OUTER JOIN users_info pp ON (pp.id=s.present_plaintiff)
			            LEFT OUTER JOIN users_info cd ON (cd.id=s.case_deal_officer)
			            LEFT OUTER JOIN ref_lawyer l ON (l.id=s.prest_lawyer_name)
			            LEFT OUTER JOIN ref_court prec ON (prec.id=s.prev_court_name)
			            LEFT OUTER JOIN ref_court presc ON (presc.id=s.prest_court_name)
			            LEFT OUTER JOIN ref_territory ter ON (ter.id=s.territory)
			            LEFT OUTER JOIN ref_schedule_charges_ni as scn on (s.act_prev_date=scn.id AND s.req_type=1)
			            LEFT OUTER JOIN ref_schedule_charges_ara as sca on (s.act_prev_date=sca.id AND s.req_type=2)
			            WHERE $str_where";
                $suit_data=$this->db->query($sql)->result();
                $subject = "Upcoming Case List";
                $message = "Upcoming Case List From LMS.";

                if(count($suit_data)>0)
                {
                    require_once('./application/Classes/PHPExcel.php'); 
                    $objPHPExcel = new PHPExcel();
                    $objPHPExcel->setActiveSheetIndex(0);
                    $styleArray_border = array(
                          'borders' => array(
                              'allborders' => array(
                                  'style' => PHPExcel_Style_Border::BORDER_THIN
                              )
                          )
                      ); 
                    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15); 
					$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
					$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
					$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25);
					$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25);
					$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(25);
					$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(25);
					$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(25);
					$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(25);
					$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(20);

                    $rowNumber = 1;
                    
                    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
                        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':AD'.$rowNumber); 
                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getFont()->setSize(16);
                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getAlignment()->setWrapText(true);
                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
                        
                        $rowNumber++;

                        $rowNumber++;  
                        $headings4 = array('Proposed Type','A/C Number','A/C Name',
					    		'3 Type of case',
					        	'Type Of Case','Filling Date','Case Number',
					        'Case Claim Amount','Previous Date','Case Status On The Previous Date','Activities Taken On The Previous Date',
					        'Next Date','Case Status on the Next date','Remarks on Case Status on the Previous date',
					        'Filling Plaintiff','Present Plaintiff','Case Dealings  officer','Lawyer\'s Name',
					        'Previous Name Of The Court','Present Name Of The Court','District','Territory','Remarks','Protfolio','Legal Region','Final Remarks');
                        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'A'.$rowNumber);
                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getFont()->setBold(true); 
                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->getAlignment()->setWrapText(true);
                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getAlignment()->setWrapText(true);
                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'F28A8C')));
                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->applyFromArray($styleArray_border);
                        $rowNumber++;   
                        $sl = 0;
                        foreach($suit_data as $data)
                        {
                            $sl++;
                            $objPHPExcel->getActiveSheet()->fromArray(array(
                                $data->proposed_type,
								$data->loan_ac,
								$data->ac_name,
								$data->requisition_name,
								$data->case_name,
								$data->filling_date,
								$data->case_number,
								$data->case_claim_amount,
								$data->prev_date,
								$data->case_sts_prev_dt,
								$data->act_prev_date,
								$data->next_date,
								$data->next_date_sts,
								$data->remarks_prev_date,
								$data->filling_plaintiff,
								$data->present_plaintiff,
								$data->case_deal_officer,
								$data->lawyer_name,
								$data->prev_court_name,
								$data->prest_court_name,
								$data->district,
								$data->territory,
								'',
								$data->loan_segment,
								$data->legal_region,
								$data->final_remarks,
                                ),NULL,'A'.$rowNumber);
                            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getAlignment()->setWrapText(true);
                            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->applyFromArray($styleArray_border);
                            $objPHPExcel->getActiveSheet()->setCellValueExplicit(('B'.$rowNumber), $data->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
                            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $rowNumber++;
                        }

                        $objPHPExcel->setActiveSheetIndex(0);
                        $objPHPExcel->getActiveSheet()->setTitle('Case Status Report'); 
                        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
                        require_once './application/Classes/PHPExcel/IOFactory.php';
                        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
                        ob_clean();
                        // header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
                        // header("Content-type:   application/x-msexcel; charset=utf-8");
                        // header('Content-Disposition: attachment;filename="case_status_report.xlsx"');
                        // header("Expires: 0");
                        // header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                        // header("Cache-Control: private",false);
                        //$objWriter->save('php://output');
                        //exit;
                        $path = "./upcoming_case_list_file/case_list.xls";
                        if (file_exists($path)) {
                            unlink($path);      
                        }
                        $objWriter->save(str_replace(__FILE__,'upcoming_case_list_file/case_list.xls',__FILE__)); 
                        $file_name='case_list.xls';
                        $file_path='upcoming_case_list_file/';
                        $this->user_model->send_email($key->email_address,$key->name. '('.$key->user_id.')', $key->email_address, '',$subject,$message,$file_name,$file_path);
                		$mail_counter++;
                }
            }
        }


        //For Yet To Fix
        $date = strtotime(date('Y-m-d'));
	    $date = date("l", $date);
	    $date = strtolower($date);
	    if($date == "sunday" || $date == "tuesday") {
	        $str="SELECT g.id,g.user_group_id,g.email_address,g.name,g.user_id
	            FROM users_info g 
	            WHERE g.verify_status = '0' 
	            AND g.block_status = '0'
	            AND (FIND_IN_SET(1,g.user_group_id) OR FIND_IN_SET(2,g.user_group_id))
	            AND g.admin_status <> '2'
	            ORDER BY g.user_group_id ASC ";
	            $result=$this->db->query($str)->result();
	        if(count($result)>0)
	        {
	            foreach ($result as $key) {
	                $table_name = "suit_filling_info";

	                $str_where = "s.sts=1 AND s.suit_sts=75 AND s.next_date='Yet To Fix'";
	                $str_where .=" AND s.case_deal_officer='".$key->id."'";

	                $sql = "SELECT s.id,s.sts,s.merged_with,fr.name as final_remarks,s.remarks_prev_date,s.proposed_type,s.case_number,s.loan_ac,s.ac_name,r.name as requisition_name,IF(s.case_name IS NOT NULL,cn.name,r.type_of_case) as case_name,
				        DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,s.case_claim_amount,IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d/%m/%Y'),s.next_date) AS next_date,IF(s.next_dt_sts=1,ns.name,'') AS next_date_sts,
				        DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,cs.name as case_sts_prev_dt,d.name as district,IF(s.req_type=2,sca.name,scn.name) as act_prev_date,
				        lr.name as legal_region,ls.name as loan_segment,s.remarks_next_date,
				        CONCAT(fp.name,' (',fp.pin,')')as filling_plaintiff,CONCAT(pp.name,' (',pp.pin,')')as present_plaintiff,ter.name as territory,
				        CONCAT(cd.name,' (',cd.pin,')')as case_deal_officer,l.name as lawyer_name,prec.name as prev_court_name,presc.name as prest_court_name
				            FROM suit_filling_info as s
				            LEFT OUTER JOIN cma c ON (c.id=s.cma_id)
				            LEFT OUTER JOIN ref_req_type r ON (r.id=s.req_type)
				            LEFT OUTER JOIN ref_case_name cn ON (cn.id=s.case_name)
				            LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
				            LEFT OUTER JOIN ref_case_sts ns ON (ns.id=s.case_sts_next_dt)
				            LEFT OUTER JOIN ref_legal_district d ON (d.id=s.district)
				            LEFT OUTER JOIN ref_legal_region lr ON (lr.id=s.region)
				            LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
				            LEFT OUTER JOIN ref_loan_segment ls ON (ls.code=s.loan_segment)
				            LEFT OUTER JOIN users_info fp ON (fp.id=s.filling_plaintiff)
				            LEFT OUTER JOIN users_info pp ON (pp.id=s.present_plaintiff)
				            LEFT OUTER JOIN users_info cd ON (cd.id=s.case_deal_officer)
				            LEFT OUTER JOIN ref_lawyer l ON (l.id=s.prest_lawyer_name)
				            LEFT OUTER JOIN ref_court prec ON (prec.id=s.prev_court_name)
				            LEFT OUTER JOIN ref_court presc ON (presc.id=s.prest_court_name)
				            LEFT OUTER JOIN ref_territory ter ON (ter.id=s.territory)
				            LEFT OUTER JOIN ref_schedule_charges_ni as scn on (s.act_prev_date=scn.id AND s.req_type=1)
				            LEFT OUTER JOIN ref_schedule_charges_ara as sca on (s.act_prev_date=sca.id AND s.req_type=2)
				            WHERE $str_where";
	                $suit_data=$this->db->query($sql)->result();
	                $subject = "Next Date update which on is (yet to fix)";
	                $message = "Yet To Fix Case List From LMS.";

	                if(count($suit_data)>0)
	                {
	                    require_once('./application/Classes/PHPExcel.php'); 
	                    $objPHPExcel = new PHPExcel();
	                    $objPHPExcel->setActiveSheetIndex(0);
	                    $styleArray_border = array(
	                          'borders' => array(
	                              'allborders' => array(
	                                  'style' => PHPExcel_Style_Border::BORDER_THIN
	                              )
	                          )
	                      ); 
	                    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15); 
						$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
						$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
						$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25);
						$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25);
						$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(25);
						$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(25);
						$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(25);
						$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(25);
						$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(20);

	                    $rowNumber = 1;
	                    
	                    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	                        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':AD'.$rowNumber); 
	                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getFont()->setSize(16);
	                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getAlignment()->setWrapText(true);
	                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
	                        
	                        $rowNumber++;

	                        $rowNumber++;  
	                        $headings4 = array('Proposed Type','A/C Number','A/C Name',
						    		'3 Type of case',
						        	'Type Of Case','Filling Date','Case Number',
						        'Case Claim Amount','Previous Date','Case Status On The Previous Date','Activities Taken On The Previous Date',
						        'Next Date','Case Status on the Next date','Remarks on Case Status on the Previous date',
						        'Filling Plaintiff','Present Plaintiff','Case Dealings  officer','Lawyer\'s Name',
						        'Previous Name Of The Court','Present Name Of The Court','District','Territory','Remarks','Protfolio','Legal Region','Final Remarks');
	                        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'A'.$rowNumber);
	                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getFont()->setBold(true); 
	                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->getAlignment()->setWrapText(true);
	                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getAlignment()->setWrapText(true);
	                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'F28A8C')));
	                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->applyFromArray($styleArray_border);
	                        $rowNumber++;   
	                        $sl = 0;
	                        foreach($suit_data as $data)
	                        {
	                            $sl++;
	                            $objPHPExcel->getActiveSheet()->fromArray(array(
	                                $data->proposed_type,
									$data->loan_ac,
									$data->ac_name,
									$data->requisition_name,
									$data->case_name,
									$data->filling_date,
									$data->case_number,
									$data->case_claim_amount,
									$data->prev_date,
									$data->case_sts_prev_dt,
									$data->act_prev_date,
									$data->next_date,
									$data->next_date_sts,
									$data->remarks_prev_date,
									$data->filling_plaintiff,
									$data->present_plaintiff,
									$data->case_deal_officer,
									$data->lawyer_name,
									$data->prev_court_name,
									$data->prest_court_name,
									$data->district,
									$data->territory,
									'',
									$data->loan_segment,
									$data->legal_region,
									$data->final_remarks,
	                                ),NULL,'A'.$rowNumber);
	                            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getAlignment()->setWrapText(true);
	                            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->applyFromArray($styleArray_border);
	                            $objPHPExcel->getActiveSheet()->setCellValueExplicit(('B'.$rowNumber), $data->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
	                            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	                            $rowNumber++;
	                        }

	                        $objPHPExcel->setActiveSheetIndex(0);
	                        $objPHPExcel->getActiveSheet()->setTitle('Case Status Report'); 
	                        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
	                        require_once './application/Classes/PHPExcel/IOFactory.php';
	                        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
	                        ob_clean();
	                        // header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	                        // header("Content-type:   application/x-msexcel; charset=utf-8");
	                        // header('Content-Disposition: attachment;filename="case_status_report.xlsx"');
	                        // header("Expires: 0");
	                        // header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	                        // header("Cache-Control: private",false);
	                        //$objWriter->save('php://output');
	                        //exit;
	                        $path = "./upcoming_case_list_file/case_list.xls";
	                        if (file_exists($path)) {
	                            unlink($path);      
	                        }
	                        $objWriter->save(str_replace(__FILE__,'upcoming_case_list_file/case_list.xls',__FILE__)); 
	                        $file_name='case_list.xls';
	                        $file_path = 'upcoming_case_list_file/';
	                        $this->user_model->send_email($key->email_address,$key->name. '('.$key->user_id.')', $key->email_address, '',$subject,$message,$file_name,$file_path);
	                		$mail_counter++;
	                }
	            }
	        }
	    }
        $history_data=array();
	    $history_data['status'] = 'success';
        $history_data['date'] =date('Y-m-d H:i:s');
        $history_data['total_mail_send'] = $mail_counter;
        $history_data['total_sms_send'] = $sms_counter;
		$this->db->insert('corn_job_history', $history_data);
	}

	function settle_case_if_account_closed()
	{
		return ture;//this function is off by prince bhai mail request on 2024-02-13
		$suit_result = $this->db->query("SELECT s.id,s.loan_ac,s.cif,s.org_loan_ac,s.proposed_type 
			FROM suit_filling_info s 
			where s.sts<>0 AND s.final_remarks=1 AND s.case_sts_prev_dt=15 
			AND s.suit_sts=75 AND s.req_type=2")->result();
		if(count($suit_result)>0)
		{
			foreach ($suit_result as $suit_row) {
				if ($suit_row->proposed_type=='Loan') {
					$loan_ac= $suit_row->loan_ac;
				}else
				{
					$loan_ac= $this->Common_model->stringEncryption('decrypt',$suit_row->org_loan_ac);
				}
				$api_config3=$this->Common_model->get_api_config_data('CBS Middleware','Loan Details');
				if ($api_config3->active_sts==1) {
					$this->load->library('WebService');
					$ws = new WebService();
					$cif = substr($loan_ac,5,8);
					//Call service for Yflag status
						$service_result = $ws->call_service('GetLoanDetalsByCif',$api_config3->dev_live,$api_config3->api_url,$api_config3->user_id,$api_config3->channel_id,$api_config3->password,$cif,$loan_ac);
					if (!empty($service_result)) {
						for ($i=1; $i <=count($service_result); $i++) 
						{
							if ($service_result[$i]['accountNumber']==$loan_ac) {
								$close_flag = $service_result[$i]['acctClsStatus'];
								$sts='N';
								if(is_array($close_flag))
								{
									$sts=$close_flag[0];
								}
								else
								{
									$sts=$close_flag;
								}
								if($sts=='Y')
								{
									$data = array(
										'final_remarks' => 2,
										'suit_sts' => 76,
										'cronjob_settle_sts' => 1,
										'ac_close_dt'=>date('Y-m-d H:i:s'));
					                $this->db->where('id', $suit_row->id);
					                $this->db->update('suit_filling_info', $data);
								}
							}
						}
					}
				}
			}
		}
	}

}