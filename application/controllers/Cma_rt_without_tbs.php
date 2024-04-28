<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cma_rt extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Cma_rt_model', '', TRUE);
    $this->load->model('User_model', '', TRUE);
    $this->load->model('Common_model', '', TRUE);
	}

	function view($menu_group, $menu_cat){

		$report_list = array(
      'cma_rt/daily_report' => 'Daily Report',
		);
		$report_select = 'cma_rt/daily_report';
		$result = array();
		$post_sts = 0;
		$ToDate=isset($_POST['ToDate'])?$_POST['ToDate']:'';
		$FromDate=isset($_POST['FromDate'])?$_POST['FromDate']:'';
        $appFromDate=isset($_POST['appFromDate'])?$_POST['appFromDate']:'';
        $appToDate=isset($_POST['appToDate'])?$_POST['appToDate']:'';
        $region_id=isset($_POST['region_id'])?$_POST['region_id']:0;
        $status_id=isset($_POST['status_id'])?$_POST['status_id']:0;
        $territory=isset($_POST['territory'])?$_POST['territory']:0;
        $district=isset($_POST['district'])?$_POST['district']:0;
        $unit_office=isset($_POST['unit_office'])?$_POST['unit_office']:0;
        $proposed_type=isset($_POST['proposed_type'])?$_POST['proposed_type']:0;
        $col_xl=isset($_POST['col_xl'])?$_POST['col_xl']:0;
        $limit=isset($_POST['limit'])?$_POST['limit']:100;
		$data = array(
                'menu_group' => $menu_group,
                'menu_cat' => $menu_cat,
                'report_select' => $report_select,
                'report_list' => $report_list,
                'result' => $result,
                'post_sts' => $post_sts,
                'FromDate' => $FromDate,
                'ToDate' => $ToDate,
                'appToDate' => $appToDate,
                'appFromDate' => $appFromDate,
                'region_id' => $region_id,
                'territory_id' => $territory,
                'district_id' => $district,
                'unit_office_id' => $unit_office,
                'status_id' => $status_id,
                'proposed_type' => $proposed_type,
                'col_xl' => $col_xl,
                'limit' => $limit,
                'status' => $this->user_model->get_parameter_data('ref_status','id','data_status = 1 AND module_name="f_legal_notice"'),
                'region_data' => $this->user_model->get_parameter_data('ref_region','id','data_status = 1'),
                'pages' => 'cma_rt/pages/grid',
                'option' => 'daily_report'
            );
            $this->load->view('grid_layout',$data);

	}	

	function daily_report($menu_group, $menu_cat){


		$report_list = array(
                'cma_rt/daily_report' => 'Daily Report',
            );
		$report_select = 'cma_rt/daily_report';
		$result = array();
    if(isset($_POST['xlsts'])){

      $this->mk_xl_daily_report();
    }else{
		$post_sts = isset($_POST['post_sts']) ? 1 : 0;
		$ToDate=isset($_POST['ToDate'])?$_POST['ToDate']:'';
		$FromDate=isset($_POST['FromDate'])?$_POST['FromDate']:'';
		if ($post_sts == 1) {
			$result = $this->Cma_rt_model->get_daily_report_data();
		}
        $appFromDate=isset($_POST['appFromDate'])?$_POST['appFromDate']:'';
    $appToDate=isset($_POST['appToDate'])?$_POST['appToDate']:'';
        $region_id=isset($_POST['region_id'])?$_POST['region_id']:0;
        $status_id=isset($_POST['status_id'])?$_POST['status_id']:0;
        $territory=isset($_POST['territory'])?$_POST['territory']:0;
        $district=isset($_POST['district'])?$_POST['district']:0;
        $unit_office=isset($_POST['unit_office'])?$_POST['unit_office']:0;
        $proposed_type=isset($_POST['proposed_type'])?$_POST['proposed_type']:'';
        $limit=isset($_POST['limit'])?$_POST['limit']:100;
        $col_xl=isset($_POST['col_xl'])?$_POST['col_xl']:0;
		  $data = array(
                'menu_group' => $menu_group,
                'menu_cat' => $menu_cat,
                'report_select' => $report_select,
                'report_list' => $report_list,
                'result' => $result,
                'post_sts' => $post_sts,
                'ToDate' => $ToDate,
                'FromDate' => $FromDate,
                'appToDate' => $appToDate,
                'appFromDate' => $appFromDate,
                'region_id' => $region_id,
                'territory_id' => $territory,
                'district_id' => $district,
                'unit_office_id' => $unit_office,
                'status_id' => $status_id,
                'proposed_type' => $proposed_type,
                'limit' => $limit,
                'col_xl' => $col_xl,
                'status' => $this->user_model->get_parameter_data('ref_status','id','data_status = 1 AND module_name="f_legal_notice"'),
                'region_data' => $this->user_model->get_parameter_data('ref_region','id','data_status = 1'),
                'pages' => 'cma_rt/pages/grid',
                'option' => 'daily_report'
            );
            $this->load->view('grid_layout',$data);
    }

	}
    
	function mk_xl_daily_report()
  {

      $where='';
      $ToDate = trim($this->input->post('ToDate')); 
      $FromDate = trim($this->input->post('FromDate')); 
      $appFromDate = trim($this->input->post('appFromDate')); 
      $appToDate = trim($this->input->post('appToDate')); 
      
      $result = $this->Cma_rt_model->get_xl_daily_report_data();
      $arr =$this->input->post('col_xl');
      //print_r($result);
      $sn = 1;
       /*echo "<pre>";
       print_r($result);
       echo "</pre>";

      exit;*/
      
      
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
      
     // $value=$row->OurCar.' '.number_format($row->Amount,2,'.',',')."</br>".'deal with '.$row->cptyname.' at '.$row->Rate.'% rate';
     
      //'Permanent Address','Present Address','Business Address',
      $rowNumber=3;
      $headt = array('SL No.','Requisition Type','Proposed Type','Loan A/C No.','CIF','Branch SOL','Loan A/C Name','Business Type','Spouse Name','Father Name','Mother Name','Loan Segment (Portfolio)','Current/Updated Address','Summon Send To','Region','Territory','District','Unit Office','More A/C No.','Remarks','status','Initiate By','Initiate Date','STC By','STC Date','Recommended By','Recommend Date','Acknowledge By','Acknowledge Date','Send To HOLM By','Send To HOLM Date','Verify By','Verify Date','Card Issuing Date','Expire Date','Credit Limit','Outstanding Balance','Chq Expiry Date','Last Payment Date','Last Payment Amount','Previous Auction Sts','Current Auction Sts','Current DPD','Legal Region','Loan Sanction Date','Auction Complete By','Auction Complete Date','Hold Reason','Previous Case Filling Date');

      $headings2 = array();
        if(in_array(1,$arr)){array_push($headings2, $headt[0]);}
        if(in_array(2,$arr)){array_push($headings2, $headt[1]);}
        if(in_array(3,$arr)){array_push($headings2, $headt[2]);}
        if(in_array(4,$arr)){array_push($headings2, $headt[3]);}
        if(in_array(5,$arr)){array_push($headings2, $headt[4]);}
        if(in_array(6,$arr)){array_push($headings2, $headt[5]);}
        if(in_array(7,$arr)){array_push($headings2, $headt[6]);}
        if(in_array(8,$arr)){array_push($headings2, $headt[7]);}
        if(in_array(9,$arr)){array_push($headings2, $headt[8]);}
        //if(in_array(10,$arr)){array_push($headings2, $headt[9]);}
        if(in_array(11,$arr)){array_push($headings2, $headt[10]);}
        if(in_array(12,$arr)){array_push($headings2, $headt[11]);}
        //if(in_array(13,$arr)){array_push($headings2, $headt[12]);}
        //if(in_array(14,$arr)){array_push($headings2, $headt[13]);}
        //if(in_array(15,$arr)){array_push($headings2, $headt[14]);}
        if(in_array(16,$arr)){array_push($headings2, $headt[12]);}
        //if(in_array(17,$arr)){array_push($headings2, $headt[13]);}
        if(in_array(18,$arr)){array_push($headings2, $headt[14]);}
        if(in_array(19,$arr)){array_push($headings2, $headt[15]);}
        if(in_array(20,$arr)){array_push($headings2, $headt[16]);}
        if(in_array(21,$arr)){array_push($headings2, $headt[17]);}
        if(in_array(22,$arr)){array_push($headings2, $headt[18]);}
        if(in_array(23,$arr)){array_push($headings2, $headt[19]);}
        if(in_array(24,$arr)){array_push($headings2, $headt[20]);}
        if(in_array(25,$arr)){array_push($headings2, $headt[21]);}
        if(in_array(26,$arr)){array_push($headings2, $headt[22]);}
        if(in_array(27,$arr)){array_push($headings2, $headt[23]);}
        if(in_array(28,$arr)){array_push($headings2, $headt[24]);}
        if(in_array(29,$arr)){array_push($headings2, $headt[25]);}
        if(in_array(30,$arr)){array_push($headings2, $headt[26]);}
        if(in_array(31,$arr)){array_push($headings2, $headt[27]);}
        if(in_array(32,$arr)){array_push($headings2, $headt[28]);}
        if(in_array(33,$arr)){array_push($headings2, $headt[29]);}
        if(in_array(34,$arr)){array_push($headings2, $headt[30]);}
        if(in_array(35,$arr)){array_push($headings2, $headt[31]);}
        if(in_array(36,$arr)){array_push($headings2, $headt[32]);}
        if(in_array(37,$arr)){array_push($headings2, $headt[33]);}
        if(in_array(38,$arr)){array_push($headings2, $headt[34]);}
        if(in_array(39,$arr)){array_push($headings2, $headt[35]);}
        if(in_array(40,$arr)){array_push($headings2, $headt[36]);}

        if(in_array(41,$arr)){array_push($headings2, $headt[37]);}
        if(in_array(42,$arr)){array_push($headings2, $headt[38]);}
        if(in_array(43,$arr)){array_push($headings2, $headt[39]);}
        if(in_array(44,$arr)){array_push($headings2, $headt[40]);}
        if(in_array(45,$arr)){array_push($headings2, $headt[41]);}
        if(in_array(46,$arr)){array_push($headings2, $headt[42]);}
        if(in_array(47,$arr)){array_push($headings2, $headt[43]);}
        if(in_array(48,$arr)){array_push($headings2, $headt[44]);}
        if(in_array(49,$arr)){array_push($headings2, $headt[45]);}
        if(in_array(50,$arr)){array_push($headings2, $headt[46]);}
        if(in_array(51,$arr)){array_push($headings2, $headt[47]);}
        if(in_array(52,$arr)){array_push($headings2, $headt[48]);}

      $colnum = count($headings2);
      if($colnum==0){
        $colnum=1;
      }
      
      if(in_array('Loan A/C No.',$headings2)){
        $key = array_search ('Loan A/C No.', $headings2);
        $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_NUMBER);
      }

      if(in_array('Initiate Date',$headings2)){
        $key = array_search ('Initiate Date', $headings2);
        $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_DATE_XLSX14);
      }
      if(in_array('STC Date',$headings2)){
        $key = array_search ('STC Date', $headings2);
        $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_DATE_XLSX14);
      }
      if(in_array('Recommend Date',$headings2)){
        $key = array_search ('Recommend Date', $headings2);
        $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_DATE_XLSX14);
      }
      if(in_array('Acknowledge Date',$headings2)){
        $key = array_search ('Acknowledge Date', $headings2);
        $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_DATE_XLSX14);
      }
      if(in_array('Send To HOLM Date',$headings2)){
        $key = array_search ('Send To HOLM Date', $headings2);
        $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_DATE_XLSX14);
      }
      if(in_array('Verify Date',$headings2)){
        $key = array_search ('Verify Date', $headings2);
        $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_DATE_XLSX14);
      }
      if(in_array('Card Issuing Date',$headings2)){
        $key = array_search ('Card Issuing Date', $headings2);
        $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_DATE_XLSX14);
      }
      if(in_array('Expire Date',$headings2)){
        $key = array_search ('Expire Date', $headings2);
        $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_DATE_XLSX14);
      }
      if(in_array('Chq Expiry Date',$headings2)){
        $key = array_search ('Chq Expiry Date', $headings2);
        $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_DATE_XLSX14);
      }
      if(in_array('Last Payment Date',$headings2)){
        $key = array_search ('Last Payment Date', $headings2);
        $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_DATE_XLSX14);
      }
      if(in_array('Loan Sanction Date',$headings2)){
        $key = array_search ('Loan Sanction Date', $headings2);
        $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_DATE_XLSX14);
      }
      if(in_array('Auction Complete Date',$headings2)){
        $key = array_search ('Auction Complete Date', $headings2);
        $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_DATE_XLSX14);
      }
      if(in_array('Previous Case Filling Date',$headings2)){
        $key = array_search ('Previous Case Filling Date', $headings2);
        $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_DATE_XLSX14);
      }
      $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber);
      $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFont()->setSize(10);
      $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->applyFromArray($styleArray_border);
      //$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':AD'.$rowNumber); 
      //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setSize(10);
      //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AN'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFont()->setBold(true);
      //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
      
      

      $rowNumber++;
      $tem=0;
      $total=count($result);
              foreach($result as $row){
                $acnum = $row['loan_ac'];
                $card_iss_date='';
                $card_exp_date='';
                $card_limit='';
                $outstanding_bl='';
              if($row['proposed_type']=='Card'){ 
                $acnum =$this->Common_model->stringEncryption('decrypt',$row['org_loan_ac']);
                $card_iss_date=$row['card_iss_date'];
                $card_exp_date=$row['card_exp_date'];
                $card_limit=$row['card_limit'];
                $outstanding_bl=$row['outstanding_bl'];
              }

              $e_dt=strtotime((string) $row['e_dt']);
              $stc_dt=strtotime((string) $row['stc_dt']);
              $rec_dt=strtotime((string) $row['rec_dt']);
              $ack_dt=strtotime((string) $row['ack_dt']);
              $sth_dt=strtotime((string) $row['sth_dt']);
              $v_dt=strtotime((string) $row['v_dt']);
              $card_iss_datestr=strtotime((string) $row['card_iss_date']);
              $card_exp_datestr=strtotime((string) $row['card_exp_date']);
              $dataar=array();


              if(in_array(1,$arr)){array_push($dataar, $row['sl_no']);}
              if(in_array(2,$arr)){array_push($dataar, $row['req_type']);}
              if(in_array(3,$arr)){array_push($dataar, $row['proposed_type']);}
              if(in_array(4,$arr)){array_push($dataar, $acnum);}
              if(in_array(5,$arr)){array_push($dataar, $row['cif']);}
              if(in_array(6,$arr)){array_push($dataar, $row['branch_sol']);}
              if(in_array(7,$arr)){array_push($dataar, $row['ac_name']);}
              if(in_array(8,$arr)){array_push($dataar, $row['subject_name']);}
              if(in_array(9,$arr)){array_push($dataar, $row['spouse_name']);}
              //if(in_array(10,$arr)){array_push($dataar, $row['father_name']);}
              if(in_array(11,$arr)){array_push($dataar, $row['mother_name']);}
              if(in_array(12,$arr)){array_push($dataar, $row['loan_segment']);}
              //if(in_array(13,$arr)){array_push($dataar, $row['parmanent_address']);}
              //if(in_array(14,$arr)){array_push($dataar, $row['present_address']);}
              //if(in_array(15,$arr)){array_push($dataar, $row['business_address']);}
              if(in_array(16,$arr)){array_push($dataar, $row['current_address']);}
              //if(in_array(17,$arr)){array_push($dataar, $this->sumonaddress($row['summon_address']));}
              if(in_array(18,$arr)){array_push($dataar, $row['region_name']);}
              if(in_array(19,$arr)){array_push($dataar, $row['territory_name']);}
              if(in_array(20,$arr)){array_push($dataar, $row['district_name']);}
              if(in_array(21,$arr)){array_push($dataar, $row['unit_office_name']);}
              if(in_array(22,$arr)){array_push($dataar, $row['more_acc_number']);}
              if(in_array(23,$arr)){array_push($dataar, $row['remarks']);}
              if(in_array(24,$arr)){array_push($dataar, $row['cma_sts']);}
              if(in_array(25,$arr)){array_push($dataar, $row['e_by']);}
              if(in_array(26,$arr)){array_push($dataar, (($row['e_dt']!='' && $row['e_dt']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($e_dt + date('Z', $e_dt)):''));}
              if(in_array(27,$arr)){array_push($dataar, $row['stc_by']);}
              if(in_array(28,$arr)){array_push($dataar, (($row['stc_dt']!='' && $row['stc_dt']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($stc_dt + date('Z', $stc_dt)):''));}
              if(in_array(29,$arr)){array_push($dataar, $row['rec_by']);}
              if(in_array(30,$arr)){array_push($dataar, (($row['rec_dt']!='' && $row['rec_dt']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($rec_dt + date('Z', $rec_dt)):''));}
              if(in_array(31,$arr)){array_push($dataar, $row['ack_by']);}
              if(in_array(32,$arr)){array_push($dataar, (($row['ack_dt']!='' && $row['ack_dt']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($ack_dt + date('Z', $ack_dt)):''));}
              if(in_array(33,$arr)){array_push($dataar, $row['sth_by']);}
              if(in_array(34,$arr)){array_push($dataar, (($row['sth_dt']!='' && $row['sth_dt']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($sth_dt + date('Z', $sth_dt)):''));}
              if(in_array(35,$arr)){array_push($dataar, $row['v_by']);}
              if(in_array(36,$arr)){array_push($dataar, (($row['v_dt']!='' && $row['v_dt']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($v_dt + date('Z', $v_dt)):''));}
              if(in_array(37,$arr)){array_push($dataar, (($card_iss_date!='' && $card_iss_date!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($card_iss_datestr + date('Z', $card_iss_datestr)):''));}
              if(in_array(38,$arr)){array_push($dataar, (($card_exp_date!='' && $card_exp_date!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($card_exp_datestr + date('Z', $card_exp_datestr)):''));}
              if(in_array(39,$arr)){array_push($dataar, $card_limit);}
              if(in_array(40,$arr)){array_push($dataar, $outstanding_bl);}


              $chq_expiry_date=strtotime((string) $row['chq_expiry_date']);
              $last_payment_date=strtotime((string) $row['last_payment_date']);
              $loan_sanction_dt=strtotime((string) $row['loan_sanction_dt']);
              $auction_complete_dt=strtotime((string) $row['auction_complete_dt']);
              $pre_case_fill_dt=strtotime((string) $row['pre_case_fill_dt']);

              if(in_array(41,$arr)){array_push($dataar, (($row['chq_expiry_date']!='' && $row['chq_expiry_date']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($chq_expiry_date + date('Z', $chq_expiry_date)):''));}
              if(in_array(42,$arr)){array_push($dataar, (($row['last_payment_date']!='' && $row['last_payment_date']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($last_payment_date + date('Z', $last_payment_date)):''));}
              if(in_array(43,$arr)){array_push($dataar, $row['last_payment_amount']);}
              if(in_array(44,$arr)){array_push($dataar, $row['pre_auc_sts']);}
              if(in_array(45,$arr)){array_push($dataar, $row['auction_sts']==33?'Completed':'');}
              if(in_array(46,$arr)){array_push($dataar, $row['current_dpd'].'DPD');}
              if(in_array(47,$arr)){array_push($dataar, $row['legal_region_name']);}
              if(in_array(48,$arr)){array_push($dataar, (($row['loan_sanction_dt']!='' && $row['loan_sanction_dt']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($loan_sanction_dt + date('Z', $loan_sanction_dt)):''));}
              if(in_array(49,$arr)){array_push($dataar, $row['auction_complete_by']);}
              if(in_array(50,$arr)){array_push($dataar, (($row['auction_complete_dt']!='' && $row['auction_complete_dt']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($auction_complete_dt + date('Z', $auction_complete_dt)):''));}
              if(in_array(51,$arr)){array_push($dataar, $row['hold_reason']);}
              if(in_array(52,$arr)){array_push($dataar, (($row['pre_case_fill_dt']!='' && $row['pre_case_fill_dt']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($pre_case_fill_dt + date('Z', $pre_case_fill_dt)):''));}

                  $objPHPExcel->getActiveSheet()->fromArray($dataar,NULL,'A'.$rowNumber);
                  $objPHPExcel->getActiveSheet()->setCellValueExplicit(('D'.$rowNumber), $acnum, PHPExcel_Cell_DataType::TYPE_STRING);
                  if(in_array(53,$arr)){
                    $cout=0;$c=$colnum;
                          foreach($row['guarntor'] as $val){
                            $objPHPExcel->getActiveSheet()->fromArray(array(
                                $val['type_name'],
                                $val['guarantor_name'],
                                $val['father_name'],
                                $val['present_address'],
                                $val['permanent_address'],
                                $val['business_address'],
                                $val['guar_sts_name'],
                                $val['occ_sts_name'],
                            ),NULL,xl_col($c).$rowNumber);
                            $cout++;
                            $c+=8;
                          }
                          if($tem<$cout){$tem=$cout;}
                        }
                          $rowNumber++;
                          
              }
            $c=$colnum;
            for($i=0;$i<$tem;$i++){
              $headingsarr =array('Type','Name','Father Name','Present Address','Permanent Address','Business Address','Status','Occupation');
              $objPHPExcel->getActiveSheet()->fromArray($headingsarr,NULL,xl_col($c).'3');
              
              $c+=8;
            }

            if($tem>0 && in_array(53,$arr)){
            $headings1 = array('Guarantor/Company/Director/Owner');
            $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,xl_col($colnum).'2');
            $objPHPExcel->getActiveSheet()->getStyle(xl_col($colnum).'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle(xl_col($colnum).'2:'.xl_col($c-1).'2')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'b4c6ee')));
            $objPHPExcel->getActiveSheet()->mergeCells(xl_col($colnum).'2:'.xl_col($c-1).'2');
            $objPHPExcel->getActiveSheet()->getStyle(xl_col($colnum).'2:'.xl_col($c-1).'2')->applyFromArray($styleArray_border);
            }
            if(in_array(54,$arr)){
            $tem=0;$crow=4;$col=$c;
            foreach($result as $row){
              $cout=0;$d=$c;
              if($row['proposed_type']=='Loan'){
                foreach($row['facility_loan'] as $val){
                  $disbursement_date=strtotime((string) $val['disbursement_date']);
                  $expire_date=strtotime((string) $val['expire_date']);
                  $outstanding_bl_dt=strtotime((string) $val['outstanding_bl_dt']);
                  $overdue_bl_dt=strtotime((string) $val['overdue_bl_dt']);
                  $call_up_dt=strtotime((string) $val['call_up_dt']);
                  $write_off_dt=strtotime((string) $val['write_off_dt']);

                  $objPHPExcel->getActiveSheet()->fromArray(array(
                      $val['facility_type_name'],
                      $val['ac_number'],
                      $val['ac_name'],
                      $val['sch_desc'],
                      (($val['disbursement_date']!='' && $val['disbursement_date']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($disbursement_date + date('Z', $disbursement_date)):''),
                      (($val['expire_date']!='' && $val['expire_date']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($expire_date + date('Z', $expire_date)):''),
                      $val['disbursed_amount'],
                      $val['loan_tenor'],
                      $val['due_installments'],
                      $val['payble'],
                      $val['repayment'],
                      $val['outstanding_bl'],
                      (($val['outstanding_bl_dt']!='' && $val['outstanding_bl_dt']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($outstanding_bl_dt + date('Z', $outstanding_bl_dt)):''),
                      $val['overdue_bl'],
                      (($val['overdue_bl_dt']!='' && $val['overdue_bl_dt']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($overdue_bl_dt + date('Z', $overdue_bl_dt)):''),
                      (($val['call_up_dt']!='' && $val['call_up_dt']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($call_up_dt + date('Z', $call_up_dt)):''),
                      (($val['write_off_dt']!='' && $val['write_off_dt']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($write_off_dt + date('Z', $write_off_dt)):''),
                      $val['write_off_amount'],
                      $val['recovery_after_Wf'],
                      $val['cl_bb'],
                      $val['cl_bbl'],
                  ),NULL,xl_col($d).$crow);
                  $cout++;
                  $d+=21;
                }
                if($tem<$cout){$tem=$cout;}
              }
                $crow++;
            }
            for($i=0;$i<$tem;$i++){
              $headingsarr =array('Facility Type','A/C Number','A/C Name','Sch Desc.','Disbursement Date','Expire Date','Disbursed Amount','Loan Tenor','Due installments','Payable','Repayment','Outstanding Balance','Outstanding Balance Date','Overdue Balance','Overdue BL Date','Call-up Date','Written-off Date','Written-off Amt(A)','Reco very After Written-off(B)','CL (BB)','CL (BBL)');

              $trow=$total+3;
                $key = array_search ('A/C Number', $headingsarr);
                $objPHPExcel->getActiveSheet()->getStyle(xl_col($key+$c).'4:'.xl_col($key+$c).$trow)->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_NUMBER);
              
              $key = array_search ('Disbursement Date', $headingsarr);
              $objPHPExcel->getActiveSheet()->getStyle(xl_col($key+$c).'4:'.xl_col($key+$c).$trow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX14);
              $key = array_search ('Expire Date', $headingsarr);
              $objPHPExcel->getActiveSheet()->getStyle(xl_col($key+$c).'4:'.xl_col($key+$c).$trow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX14);
              $key = array_search ('Outstanding Balance Date', $headingsarr);
              $objPHPExcel->getActiveSheet()->getStyle(xl_col($key+$c).'4:'.xl_col($key+$c).$trow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX14);
              $key = array_search ('Overdue BL Date', $headingsarr);
              $objPHPExcel->getActiveSheet()->getStyle(xl_col($key+$c).'4:'.xl_col($key+$c).$trow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX14);
              $key = array_search ('Call-up Date', $headingsarr);
              $objPHPExcel->getActiveSheet()->getStyle(xl_col($key+$c).'4:'.xl_col($key+$c).$trow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX14);
              $key = array_search ('Written-off Date', $headingsarr);
              $objPHPExcel->getActiveSheet()->getStyle(xl_col($key+$c).'4:'.xl_col($key+$c).$trow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX14);

              $objPHPExcel->getActiveSheet()->fromArray($headingsarr,NULL,xl_col($c).'3');
              $c+=21;
            }

            if($tem>0){
              $headings1 = array('Facility Details');
           
              $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,xl_col($col).'2');
              $objPHPExcel->getActiveSheet()->getStyle(xl_col($col).'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
              $objPHPExcel->getActiveSheet()->getStyle(xl_col($col).'2:'.xl_col($c-1).'2')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'c6e0b4')));
              $objPHPExcel->getActiveSheet()->mergeCells(xl_col($col).'2:'.xl_col($c-1).'2');
              $objPHPExcel->getActiveSheet()->getStyle(xl_col($col).'2:'.xl_col($c-1).'2')->applyFromArray($styleArray_border);
            }
          }

          for($i=1;$i<$c;$i++){
            $objPHPExcel->getActiveSheet()->getColumnDimension(xl_col($i))->setWidth(20);
          }

            //$d=$d+($tem*4);  
              $rowNumber++;
              $rowNumber--;
              $rowNumber--;
              $objPHPExcel->getActiveSheet()->getStyle('A4:'.xl_col($c-1).$rowNumber)->applyFromArray($styleArray_border); 

    $rowNumber = 1;
      $headings1 = array('CMA Report');
      $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
      $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber); 
      $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFont()->setSize(16);
      $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
      $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
      $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->applyFromArray($styleArray_border);
      $rowNumber++;
      $headings1 = array('Date From ('.$FromDate.' To '.$ToDate.')');
      $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
      $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber); 
      //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setSize(10);
      $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
      $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'ddebf7')));
      $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->applyFromArray($styleArray_border);

      $objPHPExcel->getActiveSheet()->getStyle('A3:'.xl_col($c-1).'3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle('A3:'.xl_col($c-1).'3')->getFont()->setBold(true);
      $objPHPExcel->getActiveSheet()->getStyle('A3:'.xl_col($c-1).'3')->applyFromArray($styleArray_border);


         

      $objPHPExcel->setActiveSheetIndex(0);
      $objPHPExcel->getActiveSheet()->setTitle('CMA Report'); 
      //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
      require_once './application/Classes/PHPExcel/IOFactory.php';
      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007

      ob_clean();

      header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
      header("Content-type:   application/x-msexcel; charset=utf-8");
      header('Content-Disposition: attachment;filename="cma_report.xls"');
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header("Cache-Control: private",false);
      $objWriter->save('php://output');   
      exit();
  }

    function sumonaddress($str=null){
    $txt ='';
    $arr =explode(",",$str);
    $counter = count($arr)-1;
    for($i=0;$i<count($arr);$i++){
      if($arr[$i]==1){$txt.='"Permanent Address"';}
        elseif($arr[$i]==2){$txt.='"Present Address"';}
        elseif($arr[$i]==3){$txt.='"Business Address"';}
        elseif($arr[$i]==4){$txt.='"Current/Updated Address"';}
        if($i!=$counter){$txt.=',';}
    }
    return $txt;
  }
	
}
?>