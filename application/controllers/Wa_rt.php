<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wa_rt extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Wa_rt_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat,$menu_link=null,$submenu=null)
	{

		$add_edit='';$id="";
		$data = array(
			'add_edit' => $add_edit,
			'submenu' => $submenu,
			'menu_link' => $menu_link,
			'id' => $id,
			'req_type'=>$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
			'nature_warrent'=>$this->User_model->get_parameter_data('ref_nature_warrent_arrest','name','data_status = 1'),
			'disposal_sts'=>$this->User_model->get_parameter_data('ref_disposal_sts','name','data_status = 1'),
			'executor_type'=>$this->User_model->get_parameter_data('user_group','group_name','data_status = 1'),
			'quarter'=>$this->User_model->get_parameter_data('ref_quarter','segment_text','sts = 0'),
			//'executor_type'=>$this->Warrant_arrest_model->get_executor_type('user_group','id',array(1,2,3,4),'group_name,id'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			
	   		'per_page' => $this->config->item('per_pagess')
		   );

		if($submenu=='executed'){
			$data['pages']='wa_rt/pages/executed_grid';
		}elseif($submenu=='month_region_rt'){
			$data['pages']='wa_rt/pages/month_region_rt';
		}elseif($submenu=='month_type_rt'){
			$data['pages']='wa_rt/pages/month_type_rt';
		}
		elseif($submenu=='master_case_status'){
			$data['pages']='wa_rt/pages/master_case_status';
		}
		elseif($submenu=='case_scenario'){
			$data['pages']='wa_rt/pages/case_scenario';
		}
		elseif($submenu=='month_wise_total_case'){
			$data['pages']='wa_rt/pages/month_wise_total_case';
		}
		elseif($submenu=='total_existing_case'){
			$data['pages']='wa_rt/pages/total_existing_case';
		}
		elseif($submenu=='findings_summary'){
			$data['pages']='wa_rt/pages/findings_summary';
		}
		elseif($submenu=='risk_issues_summaray'){
			$data['pages']='wa_rt/pages/risk_issues_summaray';
		}
		
		else{
			$data['pages']='wa_rt/pages/grid';
		}
		$this->load->view('grid_layout',$data);
	}


	function execution_rt()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$suit_row = $this->Wa_rt_model->execution_rt();
		
		$str_html="";
		if(count($suit_row)>0)
		{
			$str_html.="<br/><table cellpadding='5' cellspacing='0' style='_width:96%;border-collapse: collapse;border-color:#c0c0c0;' >
			<tr bgcolor='#e8e8e8' ><td style='_width:5%;border:1px solid #a0a0a0;text-align:center'><strong>SL #</strong></td>
			<td style='_width:15%;border:1px solid #a0a0a0'><strong>A/C NO</strong></td>
			<td style='_width:27%;border:1px solid #a0a0a0'><strong>Name of Enterprise</strong></td>
			<td style='_width:20%;border:1px solid #a0a0a0'><strong>Case Number</strong></td>
			<td style='_width:20%;border:1px solid #a0a0a0'><strong>Type of Case</strong></td>
			<td style='_width:20%;border:1px solid #a0a0a0'><strong>Nature of W/A</strong></td>
			<td style='_width:20%;border:1px solid #a0a0a0'><strong>Arrested by</strong></td>
			<td style='_width:20%;border:1px solid #a0a0a0'><strong>Date</strong></td>
			<td style='_width:20%;border:1px solid #a0a0a0'><strong>WA Executor Name</strong></td>
			<td style='_width:20%;border:1px solid #a0a0a0'><strong>WA Executor PIN</strong></td>
			<td style='_width:20%;border:1px solid #a0a0a0'><strong>District</strong></td>
			<td style='_width:20%;border:1px solid #a0a0a0'><strong>Territory</strong></td>
			<td style='_width:20%;border:1px solid #a0a0a0'><strong>Region</strong></td>
			<td style='_width:20%;border:1px solid #a0a0a0'><strong>Portfolio</strong></td>
			<td style='_width:20%;border:1px solid #a0a0a0'><strong>Who Executed ?</strong></td>
			<td style='_width:20%;border:1px solid #a0a0a0'><strong>Execution Citiria</strong></td>
			<td style='_width:20%;border:1px solid #a0a0a0'><strong>Remarks</strong></td>
			";
			$sl =1;
			foreach($suit_row as $row)
			{

				$str_html.="<tr>
				<td style='border:1px solid #a0a0a0;text-align:center'>".$sl."</td>
				<td style='border:1px solid #a0a0a0'>".$row->loan_ac."</td>
				<td style='border:1px solid #a0a0a0'>".$row->ac_name."</td>
				<td style='border:1px solid #a0a0a0'>".$row->case_number."</td>
				<td style='border:1px solid #a0a0a0'>".$row->req_type."</td>
				<td style='border:1px solid #a0a0a0'>".$row->na_wa."</td>
				<td style='border:1px solid #a0a0a0'>".$row->arrested_by."</td>
				<td style='border:1px solid #a0a0a0'>".$row->executed_dt."</td>
				<td style='border:1px solid #a0a0a0'>".$row->executor_name."</td>
				<td style='border:1px solid #a0a0a0'>".$row->pin."</td>
				<td style='border:1px solid #a0a0a0'>".$row->district."</td>
				<td style='border:1px solid #a0a0a0'>".$row->territory."</td>
				<td style='border:1px solid #a0a0a0'>".$row->region."</td>
				<td style='border:1px solid #a0a0a0'>".$row->loan_segment."</td>
				<td style='border:1px solid #a0a0a0'>".$row->guarantor_name."</td>
				<td style='border:1px solid #a0a0a0'>".$row->executed_criterea."</td>
				<td style='border:1px solid #a0a0a0'>".$row->remarks."</td>
				</tr>";
				$sl++;
			}
			$str_html.="
				<tr><td colspan='13'></td></tr>
			</table>";
		}
		else
		{
			$str_html.="No Result Found !!!";
		}
		echo $str_html."####".$csrf_token;
	}
	function execution_rt_xl(){
		$result = $this->Wa_rt_model->execution_rt();
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
        $rowNumber=1;
        $headings2 = array('SL No.','A/C NO','Name of Enterprise','Case Number','Type of Case','Nature of W/A','Arrested by','Date','WA Executor Name','WA Executor PIN','District','Territory','Region','Portfolio','Who Executed ?','Execution Citiria','Remarks');
      
    	$objPHPExcel->getActiveSheet()->getStyle('B')->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_NUMBER);
        $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':Q'.$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':Q'.$rowNumber)->applyFromArray($styleArray_border);
        
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':Q'.$rowNumber)->getFont()->setBold(true);
        
        
        $rowNumber++;
        $tem=0;
        $total=count($result);
       	foreach($result as $key=> $row){
       		$i= $key+1;
            $dataar=array(
            	$i,
            	$row->loan_ac,
				$row->ac_name,
				$row->case_number,
				$row->req_type,
				$row->na_wa,
				$row->arrested_by,
				$row->executed_dt,
				$row->executor_name,
				$row->pin,
				$row->district,
				$row->territory,
				$row->region,
				$row->loan_segment,
				$row->guarantor_name,
				$row->executed_criterea,
				$row->remarks,
            );
            
			$objPHPExcel->getActiveSheet()->fromArray($dataar,NULL,'A'.$rowNumber);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit(('B'.$rowNumber), $row->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
            $rowNumber++;
            
        }

        $rowNumber++;
        $rowNumber--;
        $rowNumber--;
        $objPHPExcel->getActiveSheet()->getStyle('A1:Q'.$rowNumber)->applyFromArray($styleArray_border); 


        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Warrant Execution Report'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007

        ob_clean();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="Warrant_Execution_Report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
	}

	function execution_incentive_rt()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Wa_rt_model->execution_incentive_rt();
				
		$str_html="";
		//echo $result[0]['executor_max'];
		if(count($result)>0)
		{
			$str_html.="<br/><table cellpadding='5' cellspacing='0' style='width:96%;border-collapse: collapse;border-color:#c0c0c0;' >
			<tr bgcolor='#e8e8e8' ><td style='width:5%;border:1px solid #a0a0a0;text-align:center'><strong>SL #</strong></td>
			<td style='width:15%;border:1px solid #a0a0a0'><strong>A/C NO</strong></td>
			<td style='width:27%;border:1px solid #a0a0a0'><strong>Name of Enterprise</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Case Number</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Filing Date</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Filing year</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Type of Case</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Nature of W/A</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Arrested by</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Execution Date</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>District</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Territory</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>TM Name</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Region</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Portfolio</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Who Executed ?</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Execution Citiria</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Remarks</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Confirm by Regional Legal Manager</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Confirm by Territory Manager</strong></td>";
			for($i=0;$i<$result[0]['executor_max'];$i++){
				$str_html.="<td style='width:20%;border:1px solid #a0a0a0'><strong>WA Executor PIN</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Incentive in BDT</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Group</strong></td>";
			}
			

			$str_html.="<td style='width:20%;border:1px solid #a0a0a0'><strong>Incentive in BDT</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Pending Status</strong></td>
			";
			$sl =1;
			foreach($result as $row)
			{

				$str_html.="<tr>
				<td style='border:1px solid #a0a0a0;text-align:center'>".$sl."</td>
				<td style='border:1px solid #a0a0a0'>".$row['loan_ac']."</td>
				<td style='border:1px solid #a0a0a0'>".$row['ac_name']."</td>
				<td style='border:1px solid #a0a0a0'>".$row['case_number']."</td>
				<td style='border:1px solid #a0a0a0'>".$row['filling_date']."</td>
				<td style='border:1px solid #a0a0a0'>".$row['filling_date']."</td>
				<td style='border:1px solid #a0a0a0'>".$row['req_type']."</td>
				<td style='border:1px solid #a0a0a0'>".$row['na_wa']."</td>
				<td style='border:1px solid #a0a0a0'>".$row['arrested_by']."</td>
				<td style='border:1px solid #a0a0a0'></td>
				<td style='border:1px solid #a0a0a0'>".$row['district']."</td>
				<td style='border:1px solid #a0a0a0'>".$row['territory']."</td>
				<td style='border:1px solid #a0a0a0'>".$row['e_name']."</td>
				<td style='border:1px solid #a0a0a0'>".$row['region']."</td>
				<td style='border:1px solid #a0a0a0'>".$row['loan_segment']."</td>
				<td style='border:1px solid #a0a0a0'>".$row['gname']."</td>
				<td style='border:1px solid #a0a0a0'>".$row['executed_criterea']."</td>
				<td style='border:1px solid #a0a0a0'></td>
				<td style='border:1px solid #a0a0a0'>".$row['v_name']."</td>
				<td style='border:1px solid #a0a0a0'>".$row['e_name']."</td>";
				foreach($row['executor'] as $exetue){
				$str_html .="<td style='border:1px solid #a0a0a0'>".$exetue->pin."</td>
				<td style='border:1px solid #a0a0a0'>".$exetue->amount."</td>
				<td style='border:1px solid #a0a0a0'>".$exetue->group_name."</td>";
				}
				for($i=0;$i<$result[0]['executor_max']-count($row['executor']);$i++){
					$str_html .="<td style='border:1px solid #a0a0a0'></td>
				<td style='border:1px solid #a0a0a0'></td>
				<td style='border:1px solid #a0a0a0'></td>";
				}

				$str_html .="<td style='border:1px solid #a0a0a0'>".$row['amount']."</td>
				<td style='border:1px solid #a0a0a0'></td>
				</tr>";
				$sl++;
			}
			$str_html.="
				<tr><td colspan='13'></td></tr>
			</table>";
		}
		else
		{
			$str_html.="No Result Found !!!";
		}
		echo $str_html."####".$csrf_token;
	}
	function execution_incentive_rt_xl(){
		$result = $this->Wa_rt_model->execution_incentive_rt();
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
        
        $rowNumber=1;
        $headings2 = array('SL No.','A/C NO','Name of Enterprise','Case Number','Filing Date','Filing year','Type of Case','Nature of W/A','Arrested by','Execution Date','District','Territory','TM Name','Region','Portfolio','Who Executed ?','Execution Citiria','Remarks','Confirm by Regional Legal Manager','Confirm by Territory Manager');

        for($i=0;$i<$result[0]['executor_max'];$i++){
        	array_push($headings2, 'WA Executor PIN');
        	array_push($headings2, 'Incentive in BDT');
        	array_push($headings2, 'Group');
        	
        }
        array_push($headings2, 'Incentive in BDT');
        array_push($headings2, 'Pending Status');

        $cols = count($headings2)-1;
    		
        $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($cols).$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($cols).$rowNumber)->applyFromArray($styleArray_border);
        //$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':AD'.$rowNumber); 
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setSize(10);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AN'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($cols).$rowNumber)->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
        
        $rowNumber++;
        $tem=0;
        $total=count($result);
       	foreach($result as $key=> $row){
       		
					
       		$i= $key+1;
            $dataar=array(
            	$i,
            	$row['loan_ac'],
							$row['ac_name'],
							$row['case_number'],
							$row['filling_date'],
							$row['filling_date'],
							$row['req_type'],
							$row['na_wa'],
							$row['arrested_by'],
							'',
							$row['district'],
							$row['territory'],
							$row['e_name'],
							$row['region'],
							$row['loan_segment'],
							$row['gname'],
							$row['executed_criterea'],
							'',
							$row['v_name'],
							$row['e_name'],
            );
	        foreach($row['executor'] as $exetue){
	        	array_push($dataar,$exetue->pin);
	        	array_push($dataar,$exetue->amount);
	        	array_push($dataar,$exetue->group_name);
					}
					for($i=0;$i<$result[0]['executor_max']-count($row['executor']);$i++){
						array_push($dataar,'');
	        	array_push($dataar,'');
	        	array_push($dataar,'');
					}
					array_push($dataar,$row['amount']);
	        array_push($dataar,'');
					$objPHPExcel->getActiveSheet()->fromArray($dataar,NULL,'A'.$rowNumber);
					$objPHPExcel->getActiveSheet()->setCellValueExplicit(('B'.$rowNumber), $row['loan_ac'], PHPExcel_Cell_DataType::TYPE_STRING);
	            $rowNumber++;
            
        }

        //$d=$d+($tem*4);  
        $rowNumber++;
        $rowNumber--;
        $rowNumber--;
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.xl_col($cols).$rowNumber)->applyFromArray($styleArray_border); 


        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('WA Execution Incentive'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007

        ob_clean();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="Warrant_Execution_Incentive_Report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
	}

	function month_region_rt(){
		$month_code = explode(',',$this->input->post('quarter'));
		$csrf_token=$this->security->get_csrf_hash();
		//$result = $this->Wa_rt_model->month_region_rt();
		$region = $this->db->query('SELECT * FROM ref_region WHERE data_status=1')->result();
		$nature_wa = $this->db->query('SELECT * FROM ref_nature_warrent_arrest WHERE data_status=1')->result();
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
		$str_html="";
		$str_html.="<table cellpadding='5' cellspacing='0' border='1' style='width:96%;border-collapse: collapse;border-color:#c0c0c0;' >
			<tr >
				<td rowspan='2' style='text-align:center;'><strong>Region</strong></td>
				<td rowspan='2' style='text-align:center;'><strong>Nature of W/A</strong></td>
				<td colspan='7' style='text-align:center;'><strong>WA Execution of YRS</strong></td>
				<td rowspan='2' style='text-align:center;'><strong>WA Proced Jan to Jun-21</strong></td>
			</tr>
			<tr>";
				foreach($month_code as $val){
					$str_html.="<td style='text-align:center;'><strong>".$months[$val]."</strong></td>";
				}
				$str_html.="
				<td><strong style='text-align:center;'>Grand Total</strong></td>
			</tr>";
			$grand_total = array();
			foreach($region as $k=> $regi){
				$col_sub_total = array();
				foreach($nature_wa as $key=> $na_wa){
					$str_html.="<tr>";
					if($key==0){
						$str_html.="<td rowspan='".count($nature_wa)."' style='text-align:center;'>".$regi->name."</td>";
					}
					$str_html.="<td >".$na_wa->name."</td>";
					$row_total =0;
					foreach($month_code as $month){
						if($key==0){
							$col_sub_total[$month]=0;
						}
						$result = $this->Wa_rt_model->month_region_rt($regi->id,$na_wa->id,$month);
						if(!empty((array) $result)){
							$str_html.="<td>".$result->total."</td>";
							$row_total+=$result->total;
							$col_sub_total[$month]+=$result->total;
						}else{
							$str_html.="<td></td>";
						}
						
					}
					$str_html.="<td>".$row_total."</td>";
					$str_html.="<td></td>";
					$str_html.="</tr>";
				}
				$str_html.="<tr style='background:#ddd;'>";
				$str_html.="<td colspan='2' style='text-align:center;'>".$regi->name." Total</td>";
				$row_to =0;
				foreach($month_code as $month){
					if($k==0){
						$grand_total[$month]=0;
					}
					$str_html.="<td>".$col_sub_total[$month]."</td>";
					$grand_total[$month]+=$col_sub_total[$month];
					$row_to+=$col_sub_total[$month];
				}
				$str_html.="<td>".$row_to."</td>";
				$str_html.="<td></td>";
				$str_html.="</tr>";
			}

				$str_html.="<tr>";
				$str_html.="<td colspan='2' style='text-align:center;'>Grand Total</td>";
				$total_grand =0;
				foreach($month_code as $month){
					$str_html.="<td>".$grand_total[$month]."</td>";
					$total_grand+=$grand_total[$month];
				}
				$str_html.="<td>".$total_grand."</td>";
				$str_html.="<td></td>";
				$str_html.="</tr>";

			$str_html.="</table>";

		echo $str_html."####".$csrf_token;
	}

	function month_region_rt_xl(){
		$month_code = explode(',',$this->input->post('quarter'));
		$csrf_token=$this->security->get_csrf_hash();
		//$result = $this->Wa_rt_model->month_region_rt();
		$region = $this->db->query('SELECT * FROM ref_region WHERE data_status=1')->result();
		$nature_wa = $this->db->query('SELECT * FROM ref_nature_warrent_arrest WHERE data_status=1')->result();
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');

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

		    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20); 
		    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);

        $rowNumber=1;
       
       
    		$marge_row = $rowNumber+1;
        $objPHPExcel->getActiveSheet()->fromArray(array('Region'),NULL,'A'.$rowNumber);
				$objPHPExcel->getActiveSheet()->mergeCells("A".$rowNumber.":A".$marge_row);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$marge_row)->getFont()->setSize(11);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$marge_row)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$marge_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$objPHPExcel->getActiveSheet()->fromArray(array('Nature of W/A'),NULL,'B'.$rowNumber);
				$objPHPExcel->getActiveSheet()->mergeCells("B".$rowNumber.":B".$marge_row);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$marge_row)->getFont()->setSize(11);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$marge_row)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$marge_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$objPHPExcel->getActiveSheet()->fromArray(array('WA Execution of YRS'),NULL,'C'.$rowNumber);
				$objPHPExcel->getActiveSheet()->mergeCells("C".$rowNumber.":I".$rowNumber);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':I'.$rowNumber)->getFont()->setSize(11);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':I'.$rowNumber)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':I'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


				$objPHPExcel->getActiveSheet()->fromArray(array('WA Proced Jan to Jun-21'),NULL,'J'.$rowNumber);
				$objPHPExcel->getActiveSheet()->mergeCells("J".$rowNumber.":J".$marge_row);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber.':J'.$marge_row)->getFont()->setSize(11);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber.':J'.$marge_row)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber.':J'.$marge_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$rowNumber++;
				$heading_month = array();
				foreach($month_code as $val){
					array_push($heading_month,$months[$val]); 
				}
				array_push($heading_month,'Grand Total');
				$objPHPExcel->getActiveSheet()->fromArray($heading_month,NULL,'C'.$rowNumber);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':I'.$rowNumber)->getFont()->setSize(11);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':I'.$rowNumber)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':I'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$rowNumber++;

				$grand_total = array();
			foreach($region as $k=> $regi){
				$col_sub_total = array();
				foreach($nature_wa as $key=> $na_wa){
					if($key==0){
						$marge_row=$rowNumber+count($nature_wa)-1;
						$objPHPExcel->getActiveSheet()->fromArray(array($regi->name),NULL,'A'.$rowNumber);
						$objPHPExcel->getActiveSheet()->mergeCells("A".$rowNumber.":A".$marge_row);
					}
					$objPHPExcel->getActiveSheet()->fromArray(array($na_wa->name),NULL,'B'.$rowNumber);
					
					$row_total =0;
					$cols = 1;
					foreach($month_code as $month){
						if($key==0){
							$col_sub_total[$month]=0;
						}
						$result = $this->Wa_rt_model->month_region_rt($regi->id,$na_wa->id,$month);
						if(!empty((array) $result)){
							
							$objPHPExcel->getActiveSheet()->fromArray(array($result->total),NULL,xl_col($cols).$rowNumber);
							$row_total+=$result->total;
							$col_sub_total[$month]+=$result->total;
						}else{
							$objPHPExcel->getActiveSheet()->fromArray(array(''),NULL,xl_col($cols).$rowNumber);
						}
						$cols++;
					}
					$objPHPExcel->getActiveSheet()->fromArray(array($row_total),NULL,'I'.$rowNumber);
					$objPHPExcel->getActiveSheet()->fromArray(array(''),NULL,'J'.$rowNumber);
					$rowNumber++;
				}

				$objPHPExcel->getActiveSheet()->fromArray(array($regi->name.' Total'),NULL,'A'.$rowNumber);
				$objPHPExcel->getActiveSheet()->mergeCells("A".$rowNumber.":B".$rowNumber);

				$row_to =0;$cols = 1;
				foreach($month_code as $month){
					if($k==0){
						$grand_total[$month]=0;
					}
					$objPHPExcel->getActiveSheet()->fromArray(array($col_sub_total[$month]),NULL,xl_col($cols).$rowNumber);
					$grand_total[$month]+=$col_sub_total[$month];
					$row_to+=$col_sub_total[$month];
					$cols++;
				}
				$objPHPExcel->getActiveSheet()->fromArray(array($row_to),NULL,'I'.$rowNumber);
				$objPHPExcel->getActiveSheet()->fromArray(array(''),NULL,'J'.$rowNumber);
				$rowNumber++;
			}

				$objPHPExcel->getActiveSheet()->fromArray(array('Grand Total'),NULL,'A'.$rowNumber);
				$objPHPExcel->getActiveSheet()->mergeCells("A".$rowNumber.":B".$rowNumber);

				$total_grand =0;$cols = 1;
				foreach($month_code as $month){
					$objPHPExcel->getActiveSheet()->fromArray(array($grand_total[$month]),NULL,xl_col($cols).$rowNumber);
					$total_grand+=$grand_total[$month];
					$cols++;
				}
				$objPHPExcel->getActiveSheet()->fromArray(array($total_grand),NULL,'I'.$rowNumber);
				$objPHPExcel->getActiveSheet()->fromArray(array(''),NULL,'J'.$rowNumber);
				
        $rowNumber++;
        $rowNumber--;
        $objPHPExcel->getActiveSheet()->getStyle('A1:J'.$rowNumber)->applyFromArray($styleArray_border); 


        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Master Case Status Report'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007

        ob_clean();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="master_case_sts_Report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
	}

	function month_type_rt(){
		$csrf_token=$this->security->get_csrf_hash();
		$nature = $this->User_model->get_parameter_data('ref_nature_warrent_arrest','name','data_status = 1');
		$result = $this->Wa_rt_model->month_type_rt();
		$str_html="";
		//print_r($nature);
		if(count($result)>0)
		{
			$str_html.="<table cellpadding='5' cellspacing='0' border='1' style='width:96%;border-collapse: collapse;border-color:#c0c0c0;' >
			<tr >
				<td><strong>WA Executed Month</strong></td>";
				foreach($nature as $val){
				$str_html.="<td><strong>".$val->name."</strong></td>";
				}
				$str_html.="<td><strong>Grand Total</strong></td>
			</tr>";
			$sum=$sum1=$sum2=$sum3=0;
			foreach($result as $value){
				$sumt=$value->total3+$value->total2+$value->total1;
				$sum+=$value->total3+$value->total2+$value->total1;
				$sum1+=$value->total1;
				$sum2+=$value->total2;
				$sum3+=$value->total3;
			$str_html.="<tr>
				<td>".$value->months."</td>
				<td>".$value->total3."</td>
				<td>".$value->total2."</td>
				<td>".$value->total1."</td>
				<td>".$sumt."</td>
			</tr>";
			}

			$str_html.="<tr>
				<td><strong>Grand Total</strong></td>
				<td><strong>".$sum3."</strong></td>
				<td><strong>".$sum2."</strong></td>
				<td><strong>".$sum1."</strong></td>
				<td><strong>".$sum1."</strong></td>
			</tr></table>";
		}else
		{
			$str_html.="No Result Found !!!";
		}
		echo $str_html."####".$csrf_token;
	}

	function month_type_rt_xl(){
		$nature = $this->User_model->get_parameter_data('ref_nature_warrent_arrest','name','data_status = 1');
		$result = $this->Wa_rt_model->month_type_rt();
		
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
        $headings2 = array('WA Executed Month');

        foreach($nature as $val){
        	array_push($headings2, $val->name);
        	
        }
        array_push($headings2, 'Grand Total');

        $rowNumber=2;
            $objPHPExcel->getActiveSheet()->fromArray(array('WA Executed'.$this->input->post('year')),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':E'.$rowNumber); 
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':E'.$rowNumber)->getFont()->setSize(16);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':E'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleArray_border);

        $rowNumber++;
        $cols = count($headings2)-1;
    		$objPHPExcel->getActiveSheet()->getStyle('B')->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_NUMBER);
        $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($cols).$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($cols).$rowNumber)->applyFromArray($styleArray_border);
        //$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':AD'.$rowNumber); 
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setSize(10);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AN'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($cols).$rowNumber)->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
        
        $rowNumber++;
        $tem=0;
        $total=count($result);
        $sum=$sum1=$sum2=$sum3=0;
       	foreach($result as $key=> $row){
					$sumt=$row->total3+$row->total2+$row->total1;
					$sum+=$row->total3+$row->total2+$row->total1;
					$sum1+=$row->total1;
					$sum2+=$row->total2;
					$sum3+=$row->total3;
            $dataar=array(
            	$row->months,
            	$row->total3,
            	$row->total2,
            	$row->total1,
            	$sumt
            );
					$objPHPExcel->getActiveSheet()->fromArray($dataar,NULL,'A'.$rowNumber);
	            $rowNumber++;
            
        }

        $datar=array(
            	'Grand Total',
            	$sum3,
            	$sum2,
            	$sum1,
            	$sum
            );
        $objPHPExcel->getActiveSheet()->fromArray($datar,NULL,'A'.$rowNumber);
	      $rowNumber++;      
        //$d=$d+($tem*4);  
        $rowNumber++;
        $rowNumber--;
        $rowNumber--;
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.xl_col($cols).$rowNumber)->applyFromArray($styleArray_border); 


        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('WA Month & Type'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007

        ob_clean();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="month_type.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
	}

	function master_case_rt()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$suit_row = $this->Wa_rt_model->master_case_rt();
		
		$str_html="";
		if(count($suit_row)>0)
		{
			$str_html.="<br/><table cellpadding='5' cellspacing='0' style='width:96%;border-collapse: collapse;border-color:#c0c0c0;' >
			<tr bgcolor='#e8e8e8' ><td style='width:5%;border:1px solid #a0a0a0;text-align:center'><strong>SL #</strong></td>
			<td style='width:15%;border:1px solid #a0a0a0'><strong>Loan Account No </strong></td>
			<td style='width:27%;border:1px solid #a0a0a0'><strong>Name of Enterprise</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Customer ID</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Another A/c-1</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>3 Type of Case</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Type of Case</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Filing Date</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Case Number</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Case claim Amount</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Previous date</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Case Status on the Previous date</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Activities Taken On The Previous  Date</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Next Date</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Case Status on the Next date</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Remarks on Case Status on the Previous date</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Filling  Plaintiff</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Present Plaintiff</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Plaintiff PIN No</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Plaintiff Mobile No</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Case Dealings Officer</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Case Dealing Officer/AM Legal PIN</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Case Dealing Officer/AM Legal Mobile No.</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>AM Recovery</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Lawyer's Name</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Previous Name Of The Court</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Present Name Of The Court</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>District</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Unit Office</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Recovery Territory</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Remarks</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Portfolio</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Legal Region</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>50% Deposited money</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Deposited Date</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Deposited Money Withdrawn</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Withdrawn Date</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Nature of WA</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>WA Executed ?</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>WA Execution Date</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Closing Years</strong></td>
			";
			$sl =1;
			foreach($suit_row as $row)
			{
				$str_html.="<tr>
				<td style='border:1px solid #a0a0a0;text-align:center'>".$sl."</td>
				<td style='border:1px solid #a0a0a0'>".$row->loan_ac."</td>
				<td style='border:1px solid #a0a0a0'>".$row->ac_name."</td>
				<td style='border:1px solid #a0a0a0'>".$row->customer_id."</td>
				<td style='border:1px solid #a0a0a0'>".$row->more_acc_number."</td>
				<td style='border:1px solid #a0a0a0'>".$row->case_name."</td>
				<td style='border:1px solid #a0a0a0'>".$row->type_case."</td>
				<td style='border:1px solid #a0a0a0'>".$row->filling_date."</td>
				<td style='border:1px solid #a0a0a0'>".$row->case_number."</td>
				<td style='border:1px solid #a0a0a0'>".$row->case_claim_amount."</td>
				<td style='border:1px solid #a0a0a0'>".$row->prev_date."</td>
				<td style='border:1px solid #a0a0a0'>".$row->case_sts_prev_dt."</td>
				<td style='border:1px solid #a0a0a0'>".$row->act_prev_date."</td>
				<td style='border:1px solid #a0a0a0'>".$row->next_date."</td>
				<td style='border:1px solid #a0a0a0'>".$row->case_sts_next_dt."</td>
				<td style='border:1px solid #a0a0a0'>".$row->remarks_prev_date."</td>
				<td style='border:1px solid #a0a0a0'>".$row->filling_plaintiff."</td>
				<td style='border:1px solid #a0a0a0'>".$row->filling_plaintiff."</td>
				<td style='border:1px solid #a0a0a0'>".$row->filling_plaintiff_pin."</td>
				<td style='border:1px solid #a0a0a0'>".$row->plaintiff_mobile."</td>
				<td style='border:1px solid #a0a0a0'>".$row->case_deal_officer."</td>
				<td style='border:1px solid #a0a0a0'>".$row->case_deal_officer_pin."</td>
				<td style='border:1px solid #a0a0a0'>".$row->deal_mobile_number."</td>
				<td style='border:1px solid #a0a0a0'>".$row->recovery_am."</td>
				<td style='border:1px solid #a0a0a0'>".$row->lawyer_name."</td>
				<td style='border:1px solid #a0a0a0'>".$row->prev_court_name."</td>
				<td style='border:1px solid #a0a0a0'>".$row->present_court_name."</td>
				<td style='border:1px solid #a0a0a0'>".$row->district."</td>
				<td style='border:1px solid #a0a0a0'>".$row->unit_office."</td>
				<td style='border:1px solid #a0a0a0'>".$row->territory."</td>
				<td style='border:1px solid #a0a0a0'>".$row->final_remarks."</td>
				<td style='border:1px solid #a0a0a0'>".$row->loan_segment."</td>
				<td style='border:1px solid #a0a0a0'>".$row->legal_region."</td>
				<td style='border:1px solid #a0a0a0'>".$row->deposit_amt."</td>
				<td style='border:1px solid #a0a0a0'>".$row->deposit_date."</td>
				<td style='border:1px solid #a0a0a0'>".$row->w_by."</td>
				<td style='border:1px solid #a0a0a0'>".$row->w_dt."</td>
				<td style='border:1px solid #a0a0a0'>".$row->wa_v_by."</td>
				<td style='border:1px solid #a0a0a0'>".$row->wa_exe."</td>
				<td style='border:1px solid #a0a0a0'>".$row->executed_dt."</td>
				<td style='border:1px solid #a0a0a0'>".$row->close_year."</td>
				</tr>";
				$sl++;
			}
			$str_html.="
				<tr><td colspan='13'></td></tr>
			</table>";
		}
		else
		{
			$str_html.="No Result Found !!!";
		}
		echo $str_html."####".$csrf_token;
	}
	function master_case_rt_xl(){
		$result = $this->Wa_rt_model->master_case_rt();
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
        $rowNumber=1;
        $headings2 = array('SL No.',"Loan Account No","Name of Enterprise","Customer ID","Another A/c-1","3 Type of Case","Type of Case","Filing Date","Case Number","Case claim Amount","Previous date","Case Status on the Previous date","Activities Taken On The Previous  Date","Next Date","Case Status on the Next date","Remarks on Case Status on the Previous date","Filling  Plaintiff","Present Plaintiff","Plaintiff PIN No","Plaintiff Mobile No","Case Dealings Officer","Case Dealing Officer/AM Legal PIN","Case Dealing Officer/AM Legal Mobile No.","AM Recovery","Lawyer's Name","Previous Name Of The Court","Present Name Of The Court","District","Unit Office","Recovery Territory","Remarks","Portfolio","Legal Region","50% Deposited money","Deposited Date","Deposited Money Withdrawn","Withdrawn Date","Nature of WA","WA Executed ?","WA Execution Date","Closing Years");

    	$objPHPExcel->getActiveSheet()->getStyle('B')->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_NUMBER);
        $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AO'.$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AO'.$rowNumber)->applyFromArray($styleArray_border);
        //$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':AD'.$rowNumber); 
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setSize(10);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AN'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AO'.$rowNumber)->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
       
        $rowNumber++;
        $tem=0;
        $total=count($result);
       	foreach($result as $key=> $row){
       		$i= $key+1;
            $dataar=array(
            	$i,
            	$row->loan_ac,
							$row->ac_name,
							$row->customer_id,
							$row->more_acc_number,
							$row->case_name,
							$row->type_case,
							$row->filling_date,
							$row->case_number,
							$row->case_claim_amount,
							$row->prev_date,
							$row->case_sts_prev_dt,
							$row->act_prev_date,
							$row->next_date,
							$row->case_sts_next_dt,
							$row->remarks_prev_date,
							$row->filling_plaintiff,
							$row->filling_plaintiff,
							$row->filling_plaintiff_pin,
							$row->plaintiff_mobile,
							$row->case_deal_officer,
							$row->case_deal_officer_pin,
							$row->deal_mobile_number,
							$row->recovery_am,
							$row->lawyer_name,
							$row->prev_court_name,
							$row->present_court_name,
							$row->district,
							$row->unit_office,
							$row->territory,
							$row->final_remarks,
							$row->loan_segment,
							$row->legal_region,
							$row->deposit_amt,
							$row->deposit_date,
							$row->w_by,
							$row->w_dt,
							$row->wa_v_by,
							$row->wa_exe,
							$row->executed_dt,
							$row->close_year,
            );
            
			$objPHPExcel->getActiveSheet()->fromArray($dataar,NULL,'A'.$rowNumber);
            $rowNumber++;
            
        }

        //$d=$d+($tem*4);  
        $rowNumber++;
        $rowNumber--;
        $rowNumber--;
        $objPHPExcel->getActiveSheet()->getStyle('A1:AO'.$rowNumber)->applyFromArray($styleArray_border); 


        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Master Case Status Report'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007

        ob_clean();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="master_case_sts_Report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
	}

	function case_scenario_rt(){
		$csrf_token=$this->security->get_csrf_hash();
		$req_type=$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1');
		$disposal_sts=$this->User_model->get_parameter_data('ref_disposal_sts','name','data_status = 1');
		$loan_segment=$this->User_model->get_parameter_data('ref_loan_segment','name','data_status = 1');

		$str_html="";
		$monthName = date("M", mktime(0, 0, 0, $this->input->post('month'), 10));

		$str_html.='<table cellpadding="5" cellspacing="0" style="width:96%;border-collapse: collapse;border-color:#c0c0c0;" border="1"><caption>Total Case Scenario end of '.$monthName.'. '.$this->input->post('year').'</caption><tr><th>Final Status(Filied by HO)</th><th>Portfolio</th>';
		foreach($req_type as $ke =>$req){
			$str_html.='<th>'.$req->name.'</th>';
		}
		$str_html.='<th>Grand Total</th></tr>';
		$rcgt=0;
		foreach($disposal_sts as $k=>$dispo){
			$str_html.='<tr><td rowspan="'.count($loan_segment).'">'.$dispo->name.'</td>';
			$total =array(); $gt=0;
			foreach($loan_segment as $key =>$seg){
				if($key!=0){
					$str_html.= '<tr>';
				}
					$str_html.= '<td>'.$seg->name.'</td>';
					$sum =0; 
					foreach($req_type as $ke =>$req){
						$str_html.='<td>';
						$sql = "SELECT e.`wa_status`,s.`loan_segment`,s.`req_type`
						FROM `file_executed_data` e
						LEFT JOIN suit_filling_info AS s ON s.id=e.`file_id`
						WHERE e.sts<>0 AND e.wa_status=".$dispo->id." AND s.loan_segment='".$seg->code."' AND s.req_type=".$req->id." AND DATE_FORMAT(e.e_dt,'%m-%Y')='".$this->input->post('month')."-".$this->input->post('year')."'";

								$q=$this->db->query($sql);
								$num = $q->num_rows();
								$sum+=$num;
								if(!isset($total[$ke])){
									$total[$ke]=0;
								}
								$total[$ke]+=$num;
						$str_html.= $num.'</td>';
					}
					$str_html.='<td>'.$sum.'</td>';
					$gt+=$sum;
				if($key!=0){
					$str_html.='</tr>';
				}
			}
			$str_html.='</tr><tr><td colspan="2">'.$dispo->name.' Total</td>';
			$gtrow =array();
			foreach($total as $t=> $tot){
				$str_html.= '<td>'.$tot.'</td>';
				if(!isset($gtrow[$t])){
					$gtrow[$t]=0;
				}
				$gtrow[$t]+=$tot;
			}
			$str_html.='<td>'.$gt.'</td></tr>';
			$rcgt+=$gt;
		}
		$str_html.='<tr><td colspan="2">Grand Total</td>';
		foreach($gtrow as $gtr){
				$str_html.= '<td>'.$gtr.'</td>';
			}
		$str_html.='<td>'.$rcgt.'</td></tr></table>';

		echo $str_html."####".$csrf_token;
	}


	function case_scenario_rt_xl(){
		$req_type=$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1');
		$disposal_sts=$this->User_model->get_parameter_data('ref_disposal_sts','name','data_status = 1');
		$loan_segment=$this->User_model->get_parameter_data('ref_loan_segment','name','data_status = 1');

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
      
        $rowNumber=1;
       
        $headings2 = array('Final Status(Filied by HO)',"Portfolio");
        foreach($req_type as $req){
        	array_push($headings2 , $req->name);
        }
        array_push($headings2 , 'Grand Total');
    	
        $cols = count($headings2)-1;
        $monthName = date("M", mktime(0, 0, 0, $this->input->post('month'), 10));
        $objPHPExcel->getActiveSheet()->fromArray(array('Total Case Scenario end of '.$monthName.'. '.$this->input->post('year')),NULL,'A'.$rowNumber);
				$objPHPExcel->getActiveSheet()->mergeCells("A".$rowNumber.":".xl_col($cols).$rowNumber);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($cols).$rowNumber)->getFont()->setSize(16);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($cols).$rowNumber)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($cols).$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$rowNumber++;


        $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($cols).$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($cols).$rowNumber)->applyFromArray($styleArray_border);
        //$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':AD'.$rowNumber); 
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setSize(10);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AN'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($cols).$rowNumber)->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
       
        $rowNumber++;
        $gtotal=array();
        foreach($disposal_sts as $k=>$dispo){
        	$rowspan= $rowNumber+count($loan_segment)-1;
        	$objPHPExcel->getActiveSheet()->fromArray(array($dispo->name),NULL,'A'.$rowNumber);
        	$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        	$objPHPExcel->getActiveSheet()->mergeCells("A".$rowNumber.":A".$rowspan);
        	$total=array();$tsum=0;
					foreach($loan_segment as $key =>$seg){
						$objPHPExcel->getActiveSheet()->fromArray(array($seg->name),NULL,'B'.$rowNumber);
						$i=0;
						$sum=0;
						foreach($req_type as $ke =>$req){
							$dcol=$i+2;
							$sql = "SELECT e.`wa_status`,s.`loan_segment`,s.`req_type`
									FROM `file_executed_data` e
									LEFT JOIN suit_filling_info AS s ON s.id=e.`file_id`
									WHERE e.sts<>0 AND e.wa_status=".$dispo->id." AND s.loan_segment='".$seg->code."' AND s.req_type=".$req->id." AND DATE_FORMAT(e.e_dt,'%m-%Y')='".$this->input->post('month')."-".$this->input->post('year')."'";
							$q=$this->db->query($sql);
							$num = $q->num_rows();
							if(!isset($total[$ke])){
								$total[$ke]=0;
							}
							$total[$ke]+=$num;
							$sum+=$num;
							$objPHPExcel->getActiveSheet()->fromArray(array($num),NULL,xl_col($dcol).$rowNumber);
							$i++;
						}
						if(!isset($total[$i])){
							$total[$i]=0;
						}
						$lcol=$i+2;
						$total[$i]+=$sum;
						$objPHPExcel->getActiveSheet()->fromArray(array($sum),NULL,xl_col($lcol).$rowNumber);
						$rowNumber++;
					}
					foreach($total as $t=>$val){
						if(!isset($gtotal[$t])){
							$gtotal[$t]=0;
						}
						$gtotal[$t]+=$val;
					}
					$objPHPExcel->getActiveSheet()->fromArray(array('Total '.$dispo->name),NULL,'A'.$rowNumber);
        	$objPHPExcel->getActiveSheet()->mergeCells("A".$rowNumber.":B".$rowNumber);
        	$objPHPExcel->getActiveSheet()->fromArray($total,NULL,'C'.$rowNumber);
					$rowNumber++;
				}
				$objPHPExcel->getActiveSheet()->fromArray(array('Grand Total'),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells("A".$rowNumber.":B".$rowNumber);
        $objPHPExcel->getActiveSheet()->fromArray($gtotal,NULL,'C'.$rowNumber);
        
        //$d=$d+($tem*4);  
        $rowNumber++;
        $rowNumber--;
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.xl_col($cols).$rowNumber)->applyFromArray($styleArray_border); 


        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Total Case Scenario Report'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007

        ob_clean();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="total_case_scenario_Report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
	}


	function month_wise_total_case_rt(){
		$csrf_token=$this->security->get_csrf_hash();
		$months = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec');
		//$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');

		$sql = "SELECT DATE_FORMAT(e_dt,'%m') AS m, COUNT(id) AS total FROM `suit_filling_info` WHERE sts<>0 AND suit_sts=75 GROUP BY DATE_FORMAT(e_dt,'%m')";
		$q=$this->db->query($sql);
		$result = $q->result();

		$str_html="";
		$monthName = date("M", mktime(0, 0, 0, $this->input->post('month'), 10));

		$str_html.='<table cellpadding="5" cellspacing="0" style="width:96%;border-collapse: collapse;border-color:#c0c0c0;" border="1"><caption>Month Wise Total Case</caption>';
		
		$str_html.='<tr><td>Month</td><td>Total</td></tr>';
		foreach($months as $key=> $month){
			$str_html.='<tr><td>'.$month.'</td><td>';
			foreach($result as $val){
				if($val->m==$key){
					$str_html.=$val->total;
				}
			}
			$str_html.='</td></tr>';
		}
		

		$str_html.='</table>';

		echo $str_html."####".$csrf_token;
	}

	function month_wise_total_case_rt_xl(){
		$csrf_token=$this->security->get_csrf_hash();
		//$months = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec');
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
		$sql = "SELECT DATE_FORMAT(e_dt,'%m') AS m, COUNT(id) AS total FROM `suit_filling_info` WHERE sts<>0 AND suit_sts=75 GROUP BY DATE_FORMAT(e_dt,'%m')";
		$q=$this->db->query($sql);
		$result = $q->result();

		$monthName = date("M", mktime(0, 0, 0, $this->input->post('month'), 10));
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
    
    $rowNumber=1;
    $headings2 = array('Month',"Total");
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->getActiveSheet()->fromArray(array('Month Wise Total Case'),NULL,'A'.$rowNumber);
		$objPHPExcel->getActiveSheet()->mergeCells("A".$rowNumber.":B".$rowNumber);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$rowNumber++;

    $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleArray_border);
    //$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':AD'.$rowNumber); 
    //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setSize(10);
    //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AN'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->getFont()->setBold(true);
    //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
   
    $rowNumber++;
    $gtotal=array();
    foreach($months as $key=> $month){
    	$total = '';
    	foreach($result as $val){
				if($val->m==$key){
					$total=$val->total;
				}
			}
			$objPHPExcel->getActiveSheet()->fromArray(array($month,$total),NULL,'A'.$rowNumber);
			$rowNumber++;
		}
		//$objPHPExcel->getActiveSheet()->fromArray(array('Grand Total'),NULL,'A'.$rowNumber);
    //$objPHPExcel->getActiveSheet()->mergeCells("A".$rowNumber.":B".$rowNumber);
    //$objPHPExcel->getActiveSheet()->fromArray($gtotal,NULL,'C'.$rowNumber);
     
    $rowNumber++;
    $rowNumber--;
    $objPHPExcel->getActiveSheet()->getStyle('A1:B'.$rowNumber)->applyFromArray($styleArray_border); 


    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->setTitle('Month Wise Total Case'); 
    //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
    require_once './application/Classes/PHPExcel/IOFactory.php';
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007

    ob_clean();

    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-type:   application/x-msexcel; charset=utf-8");
    header('Content-Disposition: attachment;filename="month_wise_total_case_Report.xls"');
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false);
    $objWriter->save('php://output');   
    exit();
	}

	function total_existing_case_rt(){
		$csrf_token=$this->security->get_csrf_hash();
		$months = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec');
		//$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');

		$sql = "SELECT DATE_FORMAT(e_dt,'%m') AS m, COUNT(id) AS total FROM `suit_filling_info` WHERE sts<>0 AND suit_sts=81 AND final_remarks=2 GROUP BY DATE_FORMAT(e_dt,'%m') ";
		$q=$this->db->query($sql);
		$result = $q->result();
		
		$str_html="";
		$monthName = date("M", mktime(0, 0, 0, $this->input->post('month'), 10));

		$str_html.='<table cellpadding="5" cellspacing="0" style="width:96%;border-collapse: collapse;border-color:#c0c0c0;" border="1"><caption>Total Existing Case</caption>';
		
		$str_html.='<tr><td>Month</td><td>Total</td></tr>';
		foreach($months as $key=> $month){
			$str_html.='<tr><td>'.$month.'</td><td>';
			foreach($result as $val){
				if($val->m==$key){
					$str_html.=$val->total;
				}
			}
			$str_html.='</td></tr>';
		}
		

		$str_html.='</table>';

		echo $str_html."####".$csrf_token;
	}

	function total_existing_case_rt_xl(){
		$csrf_token=$this->security->get_csrf_hash();
		//$months = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec');
		$months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
		$sql = "SELECT DATE_FORMAT(e_dt,'%m') AS m, COUNT(id) AS total FROM `suit_filling_info` WHERE sts<>0 AND suit_sts=81 AND final_remarks=2 GROUP BY DATE_FORMAT(e_dt,'%m') ";
		$q=$this->db->query($sql);
		$result = $q->result();

		$monthName = date("M", mktime(0, 0, 0, $this->input->post('month'), 10));
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
    
    $rowNumber=1;
    $headings2 = array('Month',"Total");
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->getActiveSheet()->fromArray(array('Total Existing Case'),NULL,'A'.$rowNumber);
		$objPHPExcel->getActiveSheet()->mergeCells("A".$rowNumber.":B".$rowNumber);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$rowNumber++;

    $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleArray_border);
    //$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':AD'.$rowNumber); 
    //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setSize(10);
    //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AN'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->getFont()->setBold(true);
    //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
   
    $rowNumber++;
    $gtotal=array();
    foreach($months as $key=> $month){
    	$total = '';
    	foreach($result as $val){
				if($val->m==$key){
					$total=$val->total;
				}
			}
			$objPHPExcel->getActiveSheet()->fromArray(array($month,$total),NULL,'A'.$rowNumber);
			$rowNumber++;
		}
		//$objPHPExcel->getActiveSheet()->fromArray(array('Grand Total'),NULL,'A'.$rowNumber);
    //$objPHPExcel->getActiveSheet()->mergeCells("A".$rowNumber.":B".$rowNumber);
    //$objPHPExcel->getActiveSheet()->fromArray($gtotal,NULL,'C'.$rowNumber);
     
    $rowNumber++;
    $rowNumber--;
    $objPHPExcel->getActiveSheet()->getStyle('A1:B'.$rowNumber)->applyFromArray($styleArray_border); 


    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->setTitle('Total Existing Case'); 
    //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
    require_once './application/Classes/PHPExcel/IOFactory.php';
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007

    ob_clean();

    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-type:   application/x-msexcel; charset=utf-8");
    header('Content-Disposition: attachment;filename="total_existing_case.xls"');
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false);
    $objWriter->save('php://output');   
    exit();
	}

}