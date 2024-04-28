<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auction_rt extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Auction_rt_model', '', TRUE);
        $this->load->model('User_model', '', TRUE);
        $this->load->model('Common_model', '', TRUE);
	}

	function view($menu_group, $menu_cat){

		$report_list = array(
                                'auction_rt/daily_report' => 'Daily Report',
							);
		$report_select = 'auction_rt/daily_report';
		$result = array();
		$post_sts = 0;
		$ToDate=isset($_POST['ToDate'])?$_POST['ToDate']:'';
		$FromDate=isset($_POST['FromDate'])?$_POST['FromDate']:'';
        $region_id=isset($_POST['region_id'])?$_POST['region_id']:0;
        $status_id=isset($_POST['status_id'])?$_POST['status_id']:0;
		$data = array(
                'menu_group' => $menu_group,
                'menu_cat' => $menu_cat,
                'report_select' => $report_select,
                'report_list' => $report_list,
                'result' => $result,
                'post_sts' => $post_sts,
                'FromDate' => $FromDate,
                'ToDate' => $ToDate,
                'region_id' => $region_id,
                'status_id' => $status_id,
                'status' => $this->user_model->get_parameter_data('ref_status','id','data_status = 1 AND module_name IN ("Auction","cma")'),
                'region_data' => $this->user_model->get_parameter_data('ref_region','id','data_status = 1'),
                'pages' => 'auction_rt/pages/grid',
                'option' => 'daily_report'
            );
            $this->load->view('grid_layout',$data);

	}	

	function daily_report($menu_group, $menu_cat){

		$report_list = array(
                'auction_rt/daily_report' => 'Daily Report',
            );
		$report_select = 'auction_rt/daily_report';
		$result = array();
     if(isset($_POST['xlsts'])){
      $this->mk_xl_daily_report();
    }else{
		$post_sts = isset($_POST['post_sts']) ? 1 : 0;
		$ToDate=isset($_POST['ToDate'])?$_POST['ToDate']:'';
		$FromDate=isset($_POST['FromDate'])?$_POST['FromDate']:'';
		if ($post_sts == 1) {
			$result = $this->Auction_rt_model->get_daily_report_data();

		}
    //echo '<pre>';print_r($result);echo '</pre>';exit;
        $status_id=isset($_POST['status_id'])?$_POST['status_id']:0;
        $region_id=isset($_POST['region_id'])?$_POST['region_id']:0;
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
                'region_id' => $region_id,
                'status_id' => $status_id,
                'territory_id' => $territory,
                'district_id' => $district,
                'unit_office_id' => $unit_office,
                'proposed_type' => $proposed_type,
                'limit' => $limit,
                'col_xl' => $col_xl,
                'status' => $this->user_model->get_parameter_data('ref_status','id','data_status = 1 AND module_name="Auction"'),
                'region_data' => $this->user_model->get_parameter_data('ref_region','id','data_status = 1'),
                'pages' => 'auction_rt/pages/grid',
                'option' => 'daily_report'
            );
            $this->load->view('grid_layout',$data);
      }
	}
    
	function mk_xl_daily_report(){
        $where='';
        $ToDate = trim((string) $this->input->post('ToDate')); 
        $FromDate = trim((string) $this->input->post('FromDate')); 
        $appFromDate = trim((string) $this->input->post('appFromDate')); 
        $appToDate = trim((string) $this->input->post('appToDate'));
        $col_xl = $this->input->post('col_xl');
        /*
        $FromDate = implode('-',array_reverse(explode('-',$FromDate)));
        $ToDate = implode('-',array_reverse(explode('-',$ToDate)));*/
        $results = $this->Auction_rt_model->get_xl_daily_report_data();
        $sn = 1;
         /*echo "<pre>";
         print_r($results);
         echo "</pre>";
         exit;*/
        require_once('./application/Classes/PHPExcel.php'); 
        
        $objPHPExcel = new PHPExcel();
        $i=0;
        $head1 = array('SL No.','Loan A/C No.','Loan A/C Name','Auction Team Remarks','Classifications','Paper Vendor','Paper Name','Paper Date','Auction Date','Auction Time','Auction Address','Paper Remarks','Legal Checker','Legal Ack by','Legal Ack Date','Lawyer','Legal Notice Serve Date','Legal Notice Expiry Date','Legal Response','Legal Response Date','Auction Remarks','Auction Complete','Auction Complete Date','Auction Status');
        $head2=array();
             foreach($col_xl as $val){
                array_push($head2,$head1[$val]);
             }
        
        foreach ($results as $key=>$result) {

            
            // Add new sheet
            $objWorkSheet = $objPHPExcel->createSheet($result['sl_no']); //Setting index when creating
            $objPHPExcel->setActiveSheetIndex($key);
            $styleArray_border = array(
                  'borders' => array(
                      'allborders' => array(
                          'style' => PHPExcel_Style_Border::BORDER_THIN
                      )
                  )
              ); 
            
            $rownumber=1;
            $objWorkSheet->setCellValue('A2','Auction Report');
            $objWorkSheet->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objWorkSheet->getStyle('A2')->getFont()->setSize(14);
            $objWorkSheet->getStyle('A2')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
            $objWorkSheet->mergeCells('A2:X2');

            $objWorkSheet->getStyle('A3:X3')->applyFromArray($styleArray_border);
            
            $rownumber++;
            $rownumber++;
            
            $datar = array();
            if(in_array(0,$col_xl)){array_push($datar, $result['sl_no']);}
            if(in_array(1,$col_xl)){array_push($datar, $result['loan_ac']);}
            if(in_array(2,$col_xl)){array_push($datar, $result['loan_ac_name']);}
            if(in_array(3,$col_xl)){array_push($datar, $result['auction_team_remarks']);}
            if(in_array(4,$col_xl)){array_push($datar, $result['loan_classification']);}
            if(in_array(5,$col_xl)){array_push($datar, $result['paper_vendor']);}
            if(in_array(6,$col_xl)){array_push($datar, $result['paper_name']);}
            if(in_array(7,$col_xl)){array_push($datar, $result['paper_date']);}
            if(in_array(8,$col_xl)){array_push($datar, $result['auction_date']);}
            if(in_array(9,$col_xl)){array_push($datar, $result['auction_time']);}
            if(in_array(10,$col_xl)){array_push($datar, $result['auction_address']);}
            if(in_array(11,$col_xl)){array_push($datar, $result['paper_remarks']);}
            if(in_array(12,$col_xl)){array_push($datar, $result['legal_checker']);}
            if(in_array(13,$col_xl)){array_push($datar, $result['legal_ack_by']);}
            if(in_array(14,$col_xl)){array_push($datar, $result['legal_ack_dt']);}
            if(in_array(15,$col_xl)){array_push($datar, $result['lawyer']);}
            if(in_array(16,$col_xl)){array_push($datar, $result['ln_serve_dt']);}
            if(in_array(17,$col_xl)){array_push($datar, $result['ln_expiry_dt']);}
            if(in_array(18,$col_xl)){array_push($datar, $result['legal_response_by']);}
            if(in_array(19,$col_xl)){array_push($datar, $result['legal_response_dt']);}
            if(in_array(20,$col_xl)){array_push($datar, $result['auction_remarks']);}
            if(in_array(21,$col_xl)){array_push($datar, $result['auction_complete_by']);}
            if(in_array(22,$col_xl)){array_push($datar, $result['auction_complete_dt']);}
            if(in_array(23,$col_xl)){array_push($datar, $result['auction_sts']);}
            
            //$objWorkSheet->getColumnDimension('A')->setWidth(15);
            $objWorkSheet->setCellValue()->fromArray($head2, null, 'A'.$rownumber);
            $objWorkSheet->getStyle('A'.$rownumber.':X'.$rownumber)->applyFromArray($styleArray_border);
            
            $rownumber++;
            $objWorkSheet->setCellValue()->fromArray($datar, null, 'A'.$rownumber);
            $objWorkSheet->getStyle('A'.$rownumber.':X'.$rownumber)->applyFromArray($styleArray_border);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit(('B'.$rownumber), $result['loan_ac'], PHPExcel_Cell_DataType::TYPE_STRING);
            $rownumber++;
            $rownumber++;
            $objWorkSheet->setCellValue('A'.$rownumber,'Mortgage Info');
            $objWorkSheet->getStyle('A'.$rownumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objWorkSheet->getStyle('A'.$rownumber)->getFont()->setSize(14);
            $objWorkSheet->getStyle('A'.$rownumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'C6E0B4')));
            $objWorkSheet->mergeCells('A'.$rownumber.':O'.$rownumber);

            $objWorkSheet->getStyle('A'.$rownumber.':O'.$rownumber)->applyFromArray($styleArray_border);


            $rownumber++;

            $mothead = array('Schedule Name','Schedule Description','Deed Number','Mortgage Date','Valuator Name','Valuator Date','Valuator MV','Valuator FSV','Re-Valuator Name','Re-Valuator Date','Re-Valuator MV','Re-Valuator FSV','Gov’t Mouza Rate','Total Land Area','Butted and bounded by');
            $objWorkSheet->setCellValue()->fromArray($mothead, null, 'A'.$rownumber);
            $objWorkSheet->getStyle('A'.$rownumber.':O'.$rownumber)->applyFromArray($styleArray_border);
           
            $rownumber++;
            foreach($result['mortgage'] as $key=>$mort){
                $datamort = array(
                    $mort['mort_schedule_name'],
                    $mort['mort_schedule_desc'],
                    $mort['deed_number'],
                    $mort['mortgage_date'],
                    $mort['valuator_name'],
                    $mort['valuator_date'],
                    $mort['valuator_mv'],
                    $mort['valuator_fsv'],
                    $mort['re_valuator_name'],
                    $mort['re_valuator_date'],
                    $mort['re_valuator_mv'],
                    $mort['re_valuator_fsv'],
                    $mort['gov_mouza_rate'],
                    $mort['land_area'],
                    $mort['bounded_by'],
                );

                $objWorkSheet->setCellValue()->fromArray($datamort, null, 'A'.$rownumber);
                $objWorkSheet->getStyle('A'.$rownumber.':O'.$rownumber)->applyFromArray($styleArray_border);
                $rownumber++;
            }
            $rownumber++;
            $rownumber++;
            $objWorkSheet->setCellValue('A'.$rownumber,'Security Info');
            $objWorkSheet->getStyle('A'.$rownumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objWorkSheet->getStyle('A'.$rownumber)->getFont()->setSize(14);
            $objWorkSheet->getStyle('A'.$rownumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FFE699')));
            $objWorkSheet->mergeCells('A'.$rownumber.':V'.$rownumber);

            $objWorkSheet->getStyle('A'.$rownumber.':V'.$rownumber)->applyFromArray($styleArray_border);


            $rownumber++;
            $sechead = array('Deed Number','Reg. Date','Deed Type','District','Thana','Sub Reg Office','Mouza','Land Area','Plot Number','Holding number','Jote No.','CS Khatian no.','SA/PS Khatian no.','RS /MRR Khatian no.','BS/DP/ROR Khatian no.','City Jorip Khatian no.','Mutation Khatian no.','CS Dag no.','SA Dag no.','RS Dag no.','BS/DP Dag no.','City Jorip Dag no.');
            $objWorkSheet->setCellValue()->fromArray($sechead, null, 'A'.$rownumber);
            $objWorkSheet->getStyle('A'.$rownumber.':V'.$rownumber)->applyFromArray($styleArray_border);
            $rownumber++;
            foreach($result['mortgage_security'] as $key=>$mort){
                $datasec = array(
                    $mort['title_deed_number'],
                    $mort['reg_date'],
                    $mort['deed_type'],
                    $mort['district'],
                    $mort['thana'],
                    $mort['sub_reg_office'],
                    $mort['mouza'],
                    $mort['land_area'],
                    $mort['plot_number'],
                    $mort['holding_number'],
                    $mort['jote_no'],
                    $mort['cs_khatian_no'],
                    $mort['sa_khatian_no'],
                    $mort['rs_khatian_no'],
                    $mort['bs_dp_khatian_no'],
                    $mort['city_jorip_khatian_no'],
                    $mort['mutation_khatian_no'],
                    $mort['cs_dag_no'],
                    $mort['sa_dag_no'],
                    $mort['rs_dag_no'],
                    $mort['bs_dp_dag_no'],
                    $mort['city_jorip_dag_no'],
                );

                $objWorkSheet->setCellValue()->fromArray($datasec, null, 'A'.$rownumber);
                $objWorkSheet->getStyle('A'.$rownumber.':V'.$rownumber)->applyFromArray($styleArray_border);
                $rownumber++;
            }

            $rownumber++;
            $rownumber++;
            $objWorkSheet->setCellValue('A'.$rownumber,'Bidder Info');
            $objWorkSheet->getStyle('A'.$rownumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objWorkSheet->getStyle('A'.$rownumber)->getFont()->setSize(14);
            $objWorkSheet->getStyle('A'.$rownumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'DDEBF7')));
            $objWorkSheet->mergeCells('A'.$rownumber.':J'.$rownumber);

            $objWorkSheet->getStyle('A'.$rownumber.':J'.$rownumber)->applyFromArray($styleArray_border);


            $rownumber++;
            $bidhead = array('Bidder Name','Bidder Details','Bidder Rank','Selection','Pay Order No','Pay order date','Pay Order Amount','Bid Amount','Rs Plot No','Remarks');
            $objWorkSheet->setCellValue()->fromArray($bidhead, null, 'A'.$rownumber);
            $objWorkSheet->getStyle('A'.$rownumber.':J'.$rownumber)->applyFromArray($styleArray_border);
            $rownumber++;
            foreach($result['bidder'] as $key=>$mort){
                $databid = array(
                    $mort['bidder_name'],
                    $mort['bidder_details'],
                    $mort['bidder_rank'],
                    $mort['selected'],
                    $mort['pay_order_no'],
                    $mort['pay_order_date'],
                    $mort['pay_order_amount'],
                    $mort['bid_amount'],
                    $mort['r_s_plot_no'],
                    $mort['remarks'],
                );

                $objWorkSheet->setCellValue()->fromArray($databid, null, 'A'.$rownumber);
                $objWorkSheet->getStyle('A'.$rownumber.':J'.$rownumber)->applyFromArray($styleArray_border);
                $rownumber++;
            }

            $slno=$result['sl_no'];
            // Rename sheet
             $objWorkSheet->setTitle("SL-$slno");

            
        }

        $filename='file-name'.'.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cach

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        
  }
	
}
?>