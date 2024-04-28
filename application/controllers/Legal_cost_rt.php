<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Legal_cost_rt extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
    $this->load->model('Common_model', '', TRUE);
    $this->load->model('Hoops_model', '', TRUE);
	}

	function view($menu_group, $menu_cat){

		$report_list = array(
            'legal_cost_rt/daily_report' => 'Daily Report',
		);
		$report_select = 'legal_cost_rt/daily_report';
		$result = array();
		$post_sts = 0;
        $region_id=isset($_POST['region_id'])?$_POST['region_id']:0;
        $req_type=isset($_POST['req_type'])?$_POST['req_type']:0;
        $district=isset($_POST['district'])?$_POST['district']:0;
        $case_number=isset($_POST['case_number'])?$_POST['case_number']:"";
        $proposed_type=isset($_POST['proposed_type'])?$_POST['proposed_type']:0;
        
        $limit=isset($_POST['limit'])?$_POST['limit']:100;
		$data = array(
            'menu_group' => $menu_group,
            'menu_cat' => $menu_cat,
            'report_select' => $report_select,
            'report_list' => $report_list,
            'result' => $result,
            'post_sts' => $post_sts,
            'region_id' => $region_id,
            'req_type_id' => $req_type,
            'district_id' => $district,
            'case_number' => $case_number,
            'proposed_type' => $proposed_type,
            'limit' => $limit,
            'status' => $this->user_model->get_parameter_data('ref_status','id','data_status = 1 AND module_name="f_legal_notice"'),
            'region_data' => $this->user_model->get_parameter_data('ref_region','id','data_status = 1'),
            'lawyer' => $this->user_model->get_parameter_data('ref_lawyer','id','data_status = 1'),
            'pages' => 'legal_cost_rt/pages/grid',
            'option' => 'daily_report'
        );
        $this->load->view('grid_layout',$data);

	}	


	function daily_report($menu_group, $menu_cat){
		$report_list = array(
                'legal_cost_rt/daily_report' => 'Daily Report',
            );
		$report_select = 'legal_cost_rt/daily_report';
		$result = array();
	    if(isset($_POST['xlsts'])){
	      $this->mk_xl_daily_report();
	    }else{
			$post_sts = isset($_POST['post_sts']) ? 1 : 0;
		if ($post_sts == 1) {
			$result = $this->Hoops_model->get_old_legal_cost_report_data();
		}
        $region_id=isset($_POST['region_id'])?$_POST['region_id']:0;
        $req_type=isset($_POST['req_type'])?$_POST['req_type']:0;
        $district=isset($_POST['district'])?$_POST['district']:0;
        $case_number=isset($_POST['case_number'])?$_POST['case_number']:"";
        $proposed_type=isset($_POST['proposed_type'])?$_POST['proposed_type']:'';
        $limit=isset($_POST['limit'])?$_POST['limit']:100;

 
		$data = array(
                'menu_group' => $menu_group,
                'menu_cat' => $menu_cat,
                'report_select' => $report_select,
                'report_list' => $report_list,
                'result' => $result,
                'post_sts' => $post_sts,
                'region_id' => $region_id,
                'req_type_id' => $req_type,
                'district_id' => $district,
                'case_number' => $case_number,
                'proposed_type' => $proposed_type,
                'limit' => $limit,
                'status' => $this->user_model->get_parameter_data('ref_status','id','data_status = 1 AND module_name="f_legal_notice"'),
                'region_data' => $this->user_model->get_parameter_data('ref_region','id','data_status = 1'),
                'pages' => 'legal_cost_rt/pages/grid',
                'option' => 'daily_report'
            );
    
            $this->load->view('grid_layout',$data);
      }
	}

    function mk_xl_daily_report(){
    	$result = $this->Hoops_model->get_old_legal_cost_report_data();
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
		$headings2 = array('SL No.','Requisition Type','Loan A/C No.','Loan A/C Name','Case Number','Case Claim Amount','Legal Cost','Region','Loan Segment','District');

		$colnum = count($headings2);
        if($colnum==0){
          $colnum=1;
        }
        $rowNumber=1;
        $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->applyFromArray($styleArray_border);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFont()->setBold(true);
        $rowNumber++;
        $sl = 0;
        foreach($result as $row){
          $sl++;
			$acnum = $row->loan_ac;
			if($row->proposed_type=='Card'){ 
				$acnum =$this->Common_model->stringEncryption('decrypt',$row->org_loan_ac);
			}
			$dataar = array(
                  $sl,
                  $row->req_type_name,
                  $acnum,
                  $row->ac_name,
                  $row->case_number,
                  $row->case_claim_amount,
                  $row->legal_cost,
                  $row->region_name,
                  $row->loan_segment_name,
                  $row->district_name,
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
        $objPHPExcel->getActiveSheet()->setTitle('Old Legal Cost Report'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007

        ob_clean();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="old_legal_cost_report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
	}
	
}
?>