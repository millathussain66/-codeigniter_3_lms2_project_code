<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hoops_rt extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Hoops_model', '', TRUE);
        $this->load->model('User_model', '', TRUE);
        $this->load->model('Common_model', '', TRUE);
	}

	function view($menu_group, $menu_cat){

		$report_list = array(
            'hoops_rt/daily_report' => 'Daily Report',
		);
		$report_select = 'hoops_rt/daily_report';
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
            'limit' => $limit,
            'status' => $this->user_model->get_parameter_data('ref_status','id','data_status = 1 AND module_name="f_legal_notice"'),
            'region_data' => $this->user_model->get_parameter_data('ref_region','id','data_status = 1'),
            'pages' => 'hoops_rt/pages/grid',
            'option' => 'daily_report'
        );
        $this->load->view('grid_layout',$data);

	}	


	function daily_report($menu_group, $menu_cat){
		$report_list = array(
                'hoops_rt/daily_report' => 'Daily Report',
            );
		$report_select = 'hoops_rt/daily_report';
		$result = array();
	    if(isset($_POST['xlsts'])){
	      $this->mk_xl_daily_report();
	    }else{
			$post_sts = isset($_POST['post_sts']) ? 1 : 0;
	    
			$ToDate=isset($_POST['ToDate'])?$_POST['ToDate']:'';
			$FromDate=isset($_POST['FromDate'])?$_POST['FromDate']:'';
	    	$appFromDate=isset($_POST['appFromDate'])?$_POST['appFromDate']:'';
	    	$appToDate=isset($_POST['appToDate'])?$_POST['appToDate']:'';
		if ($post_sts == 1) {
			$result = $this->Hoops_model->get_report_data();
		}
        $status_id=isset($_POST['status_id'])?$_POST['status_id']:0;
        $region_id=isset($_POST['region_id'])?$_POST['region_id']:0;
        $territory=isset($_POST['territory'])?$_POST['territory']:0;
        $district=isset($_POST['district'])?$_POST['district']:0;
        $unit_office=isset($_POST['unit_office'])?$_POST['unit_office']:0;
        $proposed_type=isset($_POST['proposed_type'])?$_POST['proposed_type']:'';
        $limit=isset($_POST['limit'])?$_POST['limit']:100;

 
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
                'status' => $this->user_model->get_parameter_data('ref_status','id','data_status = 1 AND module_name="f_legal_notice"'),
                'region_data' => $this->user_model->get_parameter_data('ref_region','id','data_status = 1'),
                'pages' => 'hoops_rt/pages/grid',
                'option' => 'daily_report'
            );
    
            $this->load->view('grid_layout',$data);
      }
	}

  function mk_xl_daily_report(){
    	$result = $this->Hoops_model->get_report_data();
		/*echo '<pre>';
		print_r($result);
		echo '</pre>';*/
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
		$headings2 = array('SL No.','Requisition Type','Proposed Type','Loan A/C No.','CIF','Branch SOL','Loan A/C Name','Spouse Name','Mother Name','Loan Segment (Portfolio)','Current/Updated Address','Region','Territory','District','Unit Office','More A/C No.','Initiate By','Initiate Date','Reject/Return Reason','Send to Checker By','Send to Checker Date','REC By','REC Date','Send To HOLM By','Send To HOLM Date','Verify By','Verify Date');

		$colnum = count($headings2);
        if($colnum==0){
          $colnum=1;
        }
        $rowNumber=1;
        $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->applyFromArray($styleArray_border);
        //$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':AD'.$rowNumber); 
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setSize(10);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AN'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
        $rowNumber++;
        foreach($result as $row){
			$acnum = $row->loan_ac;
			if($row->proposed_type=='Card'){ 
				$acnum =$this->Common_model->stringEncryption('decrypt',$row->org_loan_ac);
			}
			$dataar = array(
                  $row->sl_no,
                  $row->req_type,
                  $row->proposed_type,
                  $acnum,
                  $row->cif,
                  $row->branch_sol,
                  $row->ac_name,
                  $row->spouse_name,
                  $row->mother_name,
                  $row->loan_segment,
                  $row->current_address,
                  $row->legal_region_name,
                  $row->territory_name,
                  $row->district_name,
                  $row->unit_office_name,
                  $row->more_acc_number,
                  $row->e_by,
                  $row->e_dt,
                  $row->stc_by,
                  $row->stc_dt,
                  $row->rec_by,
                  $row->rec_dt,
                  $row->sth_by,
                  $row->sth_dt,
                  $row->v_by,
                  $row->v_dt,
              );
			$objPHPExcel->getActiveSheet()->fromArray($dataar,NULL,'A'.$rowNumber);
			if(in_array('Loan A/C No.',$headings2)){
              	$key = array_search ('Loan A/C No.', $headings2);
              	$objPHPExcel->getActiveSheet()->setCellValueExplicit((xl_col($key).$rowNumber), $acnum, PHPExcel_Cell_DataType::TYPE_STRING);
            }
			$rowNumber++;
		}
		$rowNumber++;
		$rowNumber--;
		$rowNumber--;
		$objPHPExcel->getActiveSheet()->getStyle('A1:'.xl_col($colnum-1).$rowNumber)->applyFromArray($styleArray_border); 

		$objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Hoops Report'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007

        ob_clean();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="Hoops_report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
	}

  function mk_xl_all_report(){
      $result = $this->Hoops_model->get_all_report_data();
    /*echo '<pre>';
    print_r($result);
    echo '</pre>';*/
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
    $headings2 = array('SL No.','Status','Requisition Type','Proposed Type','Loan A/C No.','CIF','Branch SOL','Loan A/C Name','Spouse Name','Mother Name','Loan Segment (Portfolio)','Current/Updated Address','Region','Territory','District','Unit Office','More A/C No.','CL Status','Int. Rate','Initiate By','Initiate Date','Send to Checker By','Send to Checker Date','REC By','REC Date','Send To HOLM By','Send To HOLM Date','Send To Legal By','Send To Legal Date and Time','Legal Acknowledge By','Legal Acknowledge Date and Time','Verify By','Verify Date','Final Status');

    $colnum = count($headings2);
        if($colnum==0){
          $colnum=1;
        }
        $rowNumber=1;
        $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->applyFromArray($styleArray_border);
        //$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':AD'.$rowNumber); 
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setSize(10);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AN'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
        $rowNumber++;
        foreach($result as $row){
      if($row->proposed_type=='Card' && $this->session->userdata['ast_user']['unmasked_card_access']==1)
        {
          $acnum = $this->Common_model->stringEncryption('decrypt',$row->org_loan_ac);
        }
        else
        {
          $acnum = $row->loan_ac;
        }
      $dataar = array(
                  $row->sl_no,
                  $row->status,
                  $row->req_type,
                  $row->proposed_type,
                  $acnum,
                  $row->cif,
                  $row->branch_sol,
                  $row->ac_name,
                  $row->spouse_name,
                  $row->mother_name,
                  $row->loan_segment,
                  $row->current_address,
                  $row->region_name,
                  $row->territory_name,
                  $row->district_name,
                  $row->unit_office_name,
                  $row->more_acc_number,
                  $row->cl_bbl,
                  $row->int_rate,
                  $row->e_by,
                  $row->e_dt,
                  $row->stc_by,
                  $row->stc_dt,
                  $row->rec_by,
                  $row->rec_dt,
                  $row->sth_by,
                  $row->sth_dt,
                  $row->deliver_by,
                  $row->deliver_dt,
                  $row->legal_ack_by,
                  $row->legal_ack_dt,
                  $row->v_by,
                  $row->v_dt,
                  $row->final_status,
              );
      $objPHPExcel->getActiveSheet()->fromArray($dataar,NULL,'A'.$rowNumber);
      if(in_array('Loan A/C No.',$headings2)){
                $key = array_search ('Loan A/C No.', $headings2);
                $objPHPExcel->getActiveSheet()->setCellValueExplicit((xl_col($key).$rowNumber), $acnum, PHPExcel_Cell_DataType::TYPE_STRING);
            }
      $rowNumber++;
    }
    $rowNumber++;
    $rowNumber--;
    $rowNumber--;
    $objPHPExcel->getActiveSheet()->getStyle('A1:'.xl_col($colnum-1).$rowNumber)->applyFromArray($styleArray_border); 

    $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Hoops Report'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007

        ob_start();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="Hoops_report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output'); 
        $xlsData = ob_get_contents();

        /*ob_start();
        $objWriter->save("php://output");
        $xlsData = ob_get_contents();*/
        ob_end_clean();
        //ob_clean();
        $csrf_token = $this->security->get_csrf_hash();
        $response =  array(
            'op' => 'ok',
            'csrf_token'=>$csrf_token,
            'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
        );

        die(json_encode($response));
        //exit();
  }
	
}
?>