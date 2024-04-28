<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Legal_notice_rt extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Legal_notice_rt_model', '', TRUE);
        $this->load->model('User_model', '', TRUE);
        $this->load->model('Common_model', '', TRUE);
	}

	function view($menu_group, $menu_cat){

		$report_list = array(
                                'Legal_notice_rt/daily_report' => 'Daily Report',
							);
		$report_select = 'Legal_notice_rt/daily_report';
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
                'pages' => 'legal_notice_rt/pages/grid',
                'option' => 'daily_report'
            );
            $this->load->view('grid_layout',$data);

	}	


	function daily_report($menu_group, $menu_cat){
    
    //print_r($_POST);
    //exit;
		$report_list = array(
                'legal_notice_rt/daily_report' => 'Daily Report',
            );
		$report_select = 'legal_notice_rt/daily_report';
		$result = array();
    if(isset($_POST['xlsts'])){
      $this->mk_xl_daily_report();
    }else if(isset($_POST['brxls'])){
      $this->xl_daily_report_br();
    }else{
		$post_sts = isset($_POST['post_sts']) ? 1 : 0;
    
		$ToDate=isset($_POST['ToDate'])?$_POST['ToDate']:'';
		$FromDate=isset($_POST['FromDate'])?$_POST['FromDate']:'';
    $appFromDate=isset($_POST['appFromDate'])?$_POST['appFromDate']:'';
    $appToDate=isset($_POST['appToDate'])?$_POST['appToDate']:'';
		if ($post_sts == 1) {
			$result = $this->Legal_notice_rt_model->get_daily_report_data();
		}
        $status_id=isset($_POST['status_id'])?$_POST['status_id']:0;
        $region_id=isset($_POST['region_id'])?$_POST['region_id']:0;
        $territory=isset($_POST['territory'])?$_POST['territory']:0;
        $district=isset($_POST['district'])?$_POST['district']:0;
        $unit_office=isset($_POST['unit_office'])?$_POST['unit_office']:0;
        $proposed_type=isset($_POST['proposed_type'])?$_POST['proposed_type']:'';
        $limit=isset($_POST['limit'])?$_POST['limit']:'';
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
                'status' => $this->user_model->get_parameter_data('ref_status','id','data_status = 1 AND module_name="f_legal_notice" AND id<>34'),
                'region_data' => $this->user_model->get_parameter_data('ref_region','id','data_status = 1'),
                'pages' => 'legal_notice_rt/pages/grid',
                'option' => 'daily_report'
            );
    
            $this->load->view('grid_layout',$data);
      }
	}

	function mk_xl_daily_report(){
        
        $where='';
        $ToDate = trim($this->input->post('ToDate')); 
        $FromDate = trim($this->input->post('FromDate')); 
        //$appFromDate = trim($this->input->post('appFromDate')); 
        //$appToDate = trim($this->input->post('appToDate')); 
        $result = $this->Legal_notice_rt_model->get_xl_daily_report_data();
        //print_r($result);
        $arr =$this->input->post('col_xl');
        $sn = 1;
         
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
       
        //'Permanent Address','Present Address','Business Address',
        $rowNumber=3;
        $headt = array('SL No.','Proposed Type','Loan A/C No.','CIF','Branch SOL','Loan A/C Name','Business Type','Spouse Name','Father Name','Mother Name','Loan Segment (Portfolio)','Current/Updated Address','Summon Send To','Region','Territory','District','Unit Office','Hold Reason','More A/C No.','Remarks','Status','Initiate By','Initiate Date','STC By','STC Date','Recommended By','Recommend Date','Acknowledge By','Acknowledge Date','Send To HOLM By','Send To HOLM Date','Verify By','Verify Date','Customer Contact','Legal Notice sent by','Legal Notice sent Date','Lawyer Name','Call up Date','LN Serial');

        $headings2 = array();
          if(in_array(1,$arr)){array_push($headings2, $headt[0]);}
          if(in_array(2,$arr)){array_push($headings2, $headt[1]);}
          if(in_array(3,$arr)){array_push($headings2, $headt[2]);}
          if(in_array(4,$arr)){array_push($headings2, $headt[3]);}
          if(in_array(5,$arr)){array_push($headings2, $headt[4]);}
          if(in_array(6,$arr)){array_push($headings2, $headt[5]);}
          if(in_array(7,$arr)){array_push($headings2, $headt[6]);}
          if(in_array(8,$arr)){array_push($headings2, $headt[7]);}
          //if(in_array(9,$arr)){array_push($headings2, $headt[8]);}
          if(in_array(10,$arr)){array_push($headings2, $headt[9]);}
          if(in_array(11,$arr)){array_push($headings2, $headt[10]);}
          //if(in_array(12,$arr)){array_push($headings2, $headt[11]);}
          //if(in_array(13,$arr)){array_push($headings2, $headt[12]);}
          //if(in_array(14,$arr)){array_push($headings2, $headt[13]);}
          if(in_array(15,$arr)){array_push($headings2, $headt[11]);}
          //if(in_array(16,$arr)){array_push($headings2, $headt[12]);}
          if(in_array(17,$arr)){array_push($headings2, $headt[13]);}
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
          $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX14);
        }
        if(in_array('STC Date',$headings2)){
          $key = array_search ('STC Date', $headings2);
          $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX14);
        }
        if(in_array('Recommend Date',$headings2)){
          $key = array_search ('Recommend Date', $headings2);
          $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX14);
        }
        if(in_array('Acknowledge Date',$headings2)){
          $key = array_search ('Acknowledge Date', $headings2);
          $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX14);
        }
        if(in_array('Send To HOLM Date',$headings2)){
          $key = array_search ('Send To HOLM Date', $headings2);
          $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX14);
        }
        if(in_array('Verify Date',$headings2)){
          $key = array_search ('Verify Date', $headings2);
          $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX14);
        }
        if(in_array('Legal Notice sent Date',$headings2)){
          $key = array_search ('Legal Notice sent Date', $headings2);
          $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX14);
        }
        if(in_array('Call up Date',$headings2)){
          $key = array_search ('Call up Date', $headings2);
          $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX14);
        }


        $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber); 
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFont()->setSize(10);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        $tem=0;
        $total=count($result);
              foreach($result as $row){
                $acnum = $row['loan_ac'];
                if($row['proposed_type']=='Card'){ 
                  $acnum =$this->Common_model->stringEncryption('decrypt',$row['org_loan_ac']);}

                  $e_dt=strtotime((string) $row['e_dt']);
                  $stc_dt=strtotime((string) $row['stc_dt']);
                  $rec_dt=strtotime((string) $row['rec_dt']);
                  $ack_dt=strtotime((string) $row['ack_dt']);
                  $sth_dt=strtotime((string) $row['sth_dt']);
                  $v_dt=strtotime((string) $row['v_dt']);
                  $legal_notice_s_dt=strtotime((string) $row['legal_notice_s_dt']);
                  $call_up_dt=strtotime((string) $row['call_up_dt']);
                $dataar=array();
                if(in_array(1,$arr)){array_push($dataar, $row['sl_no']);}
                if(in_array(2,$arr)){array_push($dataar, $row['proposed_type']);}
                if(in_array(3,$arr)){array_push($dataar, $acnum);}
                if(in_array(4,$arr)){array_push($dataar, $row['cif']);}
                if(in_array(5,$arr)){array_push($dataar, $row['branch_sol']);}
                if(in_array(6,$arr)){array_push($dataar, $row['ac_name']);}
                if(in_array(7,$arr)){array_push($dataar, $row['subject_name']);}
                if(in_array(8,$arr)){array_push($dataar, $row['spouse_name']);}
                //if(in_array(9,$arr)){array_push($dataar, $row['father_name']);}
                if(in_array(10,$arr)){array_push($dataar, $row['mother_name']);}
                if(in_array(11,$arr)){array_push($dataar, $row['loan_segment']);}
                //if(in_array(12,$arr)){array_push($dataar, $row['parmanent_address']);}
                //if(in_array(13,$arr)){array_push($dataar, $row['present_address']);}
                //if(in_array(14,$arr)){array_push($dataar, $row['business_address']);}
                if(in_array(15,$arr)){array_push($dataar, $row['current_address']);}
                //if(in_array(16,$arr)){array_push($dataar, $this->sumonaddress($row['summon_address']));}
                if(in_array(17,$arr)){array_push($dataar, $row['region_name']);}
                if(in_array(18,$arr)){array_push($dataar, $row['territory_name']);}
                if(in_array(19,$arr)){array_push($dataar, $row['district_name']);}
                if(in_array(20,$arr)){array_push($dataar, $row['unit_office_name']);}
                if(in_array(21,$arr)){array_push($dataar, $row['hold_reason']);}
                if(in_array(22,$arr)){array_push($dataar, $row['more_acc_number']);}
                if(in_array(23,$arr)){array_push($dataar, $row['remarks']);}
                if(in_array(24,$arr)){array_push($dataar, $row['legal_notice_sts']);}
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
                if(in_array(37,$arr)){array_push($dataar, $row['mobile_no']);}
                if(in_array(38,$arr)){array_push($dataar, $row['l_sent_by']);}
                if(in_array(39,$arr)){array_push($dataar, (($row['legal_notice_s_dt']!='' && $row['legal_notice_s_dt']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($legal_notice_s_dt + date('Z', $legal_notice_s_dt)):''));}
                if(in_array(40,$arr)){array_push($dataar, $row['lawyer_name']);}
                if(in_array(41,$arr)){array_push($dataar, (($row['call_up_dt']!='' && $row['call_up_dt']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($call_up_dt + date('Z', $call_up_dt)):''));}
                if(in_array(42,$arr)){array_push($dataar, $row['ln_serial']);}

                $objPHPExcel->getActiveSheet()->fromArray($dataar,NULL,'A'.$rowNumber);
                if(in_array('Loan A/C No.',$headings2)){
                  $key = array_search ('Loan A/C No.', $headings2);
                  $objPHPExcel->getActiveSheet()->setCellValueExplicit((xl_col($key).$rowNumber), $acnum, PHPExcel_Cell_DataType::TYPE_STRING);
                }

                if(in_array(43,$arr)){
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
              if(count($row['guarntor'])>0 && in_array(43,$arr)){
              $headings1 = array('Guarantor/Company/Director/Owner');
              $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,xl_col($colnum).'2');
              $objPHPExcel->getActiveSheet()->getStyle(xl_col($colnum).'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
              $objPHPExcel->getActiveSheet()->getStyle(xl_col($colnum).'2:'.xl_col($c-1).'2')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'b4c6ee')));
              $objPHPExcel->getActiveSheet()->mergeCells(xl_col($colnum).'2:'.xl_col($c-1).'2');
              $objPHPExcel->getActiveSheet()->getStyle(xl_col($colnum).'2:'.xl_col($c-1).'2')->applyFromArray($styleArray_border);
              }

            if(in_array(44,$arr)){
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

                    $objPHPExcel->getActiveSheet()->fromArray(array(
                        $val['facility_type_name'],
                        $val['ac_number'],
                        $val['ac_name'],
                        $val['sch_desc'],
                        (($val['disbursement_date']!='' && $val['disbursement_date']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($disbursement_date + date('Z', $disbursement_date)):''),
                        (($val['expire_date']!='' && $val['expire_date']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($expire_date + date('Z', $expire_date)):''),
                        $val['disbursed_amount'],
                        $val['due_installments'],
                        $val['payble'],
                        $val['repayment'],
                        $val['outstanding_bl'],
                        (($val['outstanding_bl_dt']!='' && $val['outstanding_bl_dt']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($outstanding_bl_dt + date('Z', $outstanding_bl_dt)):''),
                        $val['overdue_bl'],
                        (($val['overdue_bl_dt']!='' && $val['overdue_bl_dt']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($overdue_bl_dt + date('Z', $overdue_bl_dt)):''),
                        (($val['call_up_dt']!='' && $val['call_up_dt']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($call_up_dt + date('Z', $call_up_dt)):''),
                        $val['cl_bb'],
                        $val['cl_bbl'],
                    ),NULL,xl_col($d).$crow);
                    $cout++;
                    $d+=17;
                  }
                  if($tem<$cout){$tem=$cout;}
                }
                  
                  $crow++;
              }
              $checkfac=$c;
              for($i=0;$i<$tem;$i++){
                $headingsarr =array('Facility Type','A/C Number','A/C Name','Sch Desc.','Disbursement Date','Expire Date','Disbursed Amount','Due installments','Payable','Repayment','Outstanding Balance','Outstanding Balance Date','Overdue Balance','Overdue BL Date','Call-up Date','CL (BB)','CL (BBL)');
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
              
                $objPHPExcel->getActiveSheet()->fromArray($headingsarr,NULL,xl_col($c).'3');

                $c+=17;
              }


              $d=$c;
              $tem=0;$crow=4;
              foreach($result as $row){
                $cout=0;$e=$d;
                if($row['proposed_type']!='Loan'){
                  foreach($row['facility'] as $val){
                    $card_iss_date=strtotime((string) $val['card_iss_date']);
                    $card_exp_date=strtotime((string) $val['card_exp_date']);
                    $objPHPExcel->getActiveSheet()->fromArray(array(
                        (($val['card_iss_date']!='' && $val['card_iss_date']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($card_iss_date + date('Z', $card_iss_date)):''),
                        (($val['card_exp_date']!='' && $val['card_exp_date']!='0000-00-00')?PHPExcel_Shared_Date::PHPToExcel($card_exp_date + date('Z', $card_exp_date)):''),
                        $val['card_limit'],
                        $val['outstanding_bl'],
                    ),NULL,xl_col($e).$crow);
                    $cout++;
                    $e+=4;
                  }
                  if($tem<$cout){$tem=$cout;}
                }
                  
                  $crow++;
              }

              for($i=0;$i<$tem;$i++){
                $headingsarr =array('Card Issuing Date','Expire Date','Credit Limit','Outstanding Balance');
                $trow=$total+3;
                $key = array_search ('Card Issuing Date', $headingsarr);
                $objPHPExcel->getActiveSheet()->getStyle(xl_col($key+$c).'4:'.xl_col($key+$c).$trow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX14);
                $key = array_search ('Expire Date', $headingsarr);
                $objPHPExcel->getActiveSheet()->getStyle(xl_col($key+$c).'4:'.xl_col($key+$c).$trow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX14);
                $objPHPExcel->getActiveSheet()->fromArray($headingsarr,NULL,xl_col($c).'3');
                $c+=4;
              }
              //exit;
              if($checkfac < $c){
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
            
                $rowNumber++;
                $rowNumber--;
                $rowNumber--;
        $objPHPExcel->getActiveSheet()->getStyle('A4:'.xl_col($c-1).$rowNumber)->applyFromArray($styleArray_border);  

        $rowNumber = 1;
        $headings1 = array('1st Legal Notice Report');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber); 
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        $headings1 = array('Date From ('.implode('-',array_reverse(explode('/',$FromDate))).' To '.implode('-',array_reverse(explode('/',$ToDate))).')');
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
        $objPHPExcel->getActiveSheet()->setTitle('1st Legal Notice Report'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="1st_legal_notice_report.xls"');
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

  function xl_daily_report_br(){
    $where='';
        $ToDate = trim($this->input->post('ToDate')); 
        $FromDate = trim($this->input->post('FromDate')); 
        $appFromDate = trim($this->input->post('appFromDate')); 
        $appToDate = trim($this->input->post('appToDate')); 
        $result = $this->Legal_notice_rt_model->xl_daily_report_br();
        //print_r($result);
        $arr =$this->input->post('col_xl');
        $sn = 1;
         
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
       
        //'Permanent Address','Present Address','Business Address',
        $rowNumber=1;
        $headings2 = array('BR Serial','SL No.','ACC NO','Loan A/C Name','Name','Type','Address Type','Address','Portfolio','Dristrict','Region','Initiator','Legal Notice initiate Date','Legal Notice Sending Date');
        
        $colnum = count($headings2);
        if($colnum==0){
          $colnum=1;
        }
      

        $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber); 
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FFFF00')));
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->applyFromArray($styleArray_border);

        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(80);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
        $rowNumber++;
        $tem=0;
        $total=count($result);
              foreach($result as $row){
                $acnum = $row['loan_ac'];
                if($row['proposed_type']=='Card'){ 
                  $acnum =$this->Common_model->stringEncryption('decrypt',$row['org_loan_ac']);
                }
                $dataar=array(
                      $row['br_counter'],
                      $row['sl_no'],
                      $acnum,
                      $row['ac_name'],
                      $row['brrower_name'],
                      $row['type_name'],
                      $row['adress_field'],
                      $row['adress'],
                      $row['loan_segment'],
                      $row['district_name'],
                      $row['region_name'],
                      $row['e_by'],
                      $row['e_dt'],
                      $row['legal_notice_s_dt']
                    );
                
                $objPHPExcel->getActiveSheet()->fromArray($dataar,NULL,'A'.$rowNumber);
                if(in_array('ACC NO',$headings2)){
                  $key = array_search ('ACC NO', $headings2);
                  $objPHPExcel->getActiveSheet()->setCellValueExplicit((xl_col($key).$rowNumber), $acnum, PHPExcel_Cell_DataType::TYPE_STRING);
                }
                
                $rowNumber++;

              }
                
             
                $rowNumber++;
                $rowNumber--;
                $rowNumber--;
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.xl_col($colnum-1).$rowNumber)->applyFromArray($styleArray_border);

        

        
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('1st Legal Notice Report'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="1st_legal_notice_report_br.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
  }
	
}
?>