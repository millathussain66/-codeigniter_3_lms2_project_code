<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_bill extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Bill_ho_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('User_info_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat)
	{
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'pages'=> 'view_bill/pages/view_bill',
					'staff' => $this->Bill_ho_model->get_staff_data(),
					'lawyer' => $this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1'),
				    'vendor' => $this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1'),
			   		'bill_type' => $this->User_model->get_parameter_data('ref_expense_type','name','data_status = 1'),
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function get_expense_data()
	{
		$vendor_type = $this->input->post('bill_type');
		$vendor_id = $this->input->post('vendor');
		$vendor_name = $this->input->post('vendor_name');
		$bill_month = $this->input->post('bill_month');
		$csrf_token=$this->security->get_csrf_hash();
		$str='';
		$total=0;
		//For Lawyer
		if ($vendor_type==1) { 
			$str = '';
			$all_proxy_sts = 0;
			$result = $this->Bill_ho_model->get_cost_details_lawyer_all($vendor_id,$bill_month);
			if($vendor_id!=NULL && $vendor_id!=0 && $vendor_id!='')
	        {
	        	$all_proxy_sts = 1;
	            $proxy_result = $this->Bill_ho_model->get_cost_details_proxy_lawyer($vendor_id,$bill_month);
				if(!empty($proxy_result))
				{
				$str.='<div style="margin-top:10px;overflow-x:hidden;height:100px" id="grid_table_div" class="grid_table_div">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:10px;">Proxy Info</span>
					<table class="result_table" id="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
					<thead style="">
						<th width="3%" style="font-weight: bold;text-align:center">SL</th>
						<th width="15%" style="font-weight: bold;text-align:center">Vendor Name</th>
						<th width="10%" style="font-weight: bold;text-align:center">Account No.</th>
						<th width="15%" style="font-weight: bold;text-align:center">Account Name</th>
						<th width="15%" style="font-weight: bold;text-align:center">Case No.</th>
						<th width="10%" style="font-weight: bold;text-align:center">Date of legal steps</th>
						<th width="15%" style="font-weight: bold;text-align:center">Purpose/Activities</th>
						<th width="15%" style="font-weight: bold;text-align:center">Amount</th>
					</thead>
					<tbody id="table_tbody">';
					if (!empty($proxy_result)) 
					{
						$sl = 1;
						foreach ($proxy_result as $key) 
						{
							$str.='<tr>
										<td style="text-align:center">'.$sl.'</td>
										<td style="text-align:center">'.$key->vendor_name.'</td>
										<td style="text-align:center">'.$key->loan_ac.'</td>
										<td style="text-align:center">'.$key->ac_name.'</td>
										<td style="text-align:center">'.$key->case_number.'</td>
										<td style="text-align:center">'.$key->txrn_dt.'</td>
										<td style="text-align:center">'.$key->activities_name.'</td>
										<td style="text-align:center">'.number_format($key->amount,2).'</td>
								</tr>';
							$sl++;
						}
					}
					$str.='</tbody></table></div>';
				}

	        }
	        if($all_proxy_sts==0)
			{
				$height = '350px';
			}
			else
			{
				$height = '250px';
			}
			$str.='<div style="margin-top:10px;overflow-x:hidden;height:'.$height.'" id="grid_table_div" class="grid_table_div">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:10px;">Lawyer Info</span>
					<table class="result_table" id="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
					<thead style="">
						<th width="3%" style="font-weight: bold;text-align:center">SL</th>
						<th width="15%" style="font-weight: bold;text-align:center">Vendor Name</th>
						<th width="10%" style="font-weight: bold;text-align:center">Account No.</th>
						<th width="15%" style="font-weight: bold;text-align:center">Account Name</th>
						<th width="15%" style="font-weight: bold;text-align:center">Case No.</th>
						<th width="10%" style="font-weight: bold;text-align:center">Date of legal steps</th>
						<th width="15%" style="font-weight: bold;text-align:center">Purpose/Activities</th>
						<th width="15%" style="font-weight: bold;text-align:center">Amount</th>
					</thead>
					<tbody id="table_tbody">';
			if (!empty($result)) 
			{
				$sl = 1;
				foreach ($result as $key) 
				{
					if($all_proxy_sts==0)
					{
						if($key->proxy_sts==1)
						{
							$proxy_style='color:red';
							$text = '(Proxy)';
						}
						else
						{
							$proxy_style='"';
							$text = '';
						}
					}
					else
					{
						$proxy_style='"';
						$text = '';
					}
					$total+=$key->amount;
					$str.='<tr>
								<td style="text-align:center">'.$sl.'</td>
								<td style="text-align:center;'.$proxy_style.'">'.$key->vendor_name.' '.$text.'</td>
								<td style="text-align:center">'.$key->loan_ac.'</td>
								<td style="text-align:center">'.$key->ac_name.'</td>
								<td style="text-align:center">'.$key->case_number.'</td>
								<td style="text-align:center">'.$key->txrn_dt.'</td>
								<td style="text-align:center">'.$key->activities_name.'</td>
								<td style="text-align:center">'.number_format($key->amount,2).'</td>
						</tr>';
					$sl++;
				}
				$str.='<tr>
							<td style="text-align:right" colspan="7">Total = </td>
							<td style="text-align:center">'.$total.'</td>
					</tr>';
			}
			else
			{
				$str.='<tr>
							<td style="text-align:center" colspan="8">Sorry No Data!!</td>
					</tr>';
				$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
			}
		}
		//For paper vendor
		else if ($vendor_type==2) { 
			$result = $this->Bill_ho_model->get_cost_details_paper_bill_all($vendor_id,$bill_month);
			$str = '';
			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" id="grid_table_div" class="grid_table_div">
					<table class="result_table" id="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
					<thead style="">
						<th width="3%" style="font-weight: bold;text-align:center">SL</th>
						<th width="15%" style="font-weight: bold;text-align:center">Paper Name</th>
						<th width="10%" style="font-weight: bold;text-align:center">Account No.</th>
						<th width="15%" style="font-weight: bold;text-align:center">Account Name</th>
						<th width="15%" style="font-weight: bold;text-align:center">Case No.</th>
						<th width="10%" style="font-weight: bold;text-align:center">Paper Publication Date</th>
						<th width="15%" style="font-weight: bold;text-align:center">Publication Copy</th>
						<th width="15%" style="font-weight: bold;text-align:center">Amount</th>
					</thead>
					<tbody id="table_tbody">';
			if (!empty($result)) 
			{
				$sl = 1;
				foreach ($result as $key) 
				{
					if ($key->paper_scan_copy!='' && $key->paper_scan_copy!=NULL) {
		                $paper_scan_copy='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/paper_scan_copy/'.$key->paper_scan_copy.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
		            }else{$paper_scan_copy="";}
					$total+=$key->amount;
					$str.='<tr>
								<td style="text-align:center">'.$sl.'</td>
								<td style="text-align:center">'.$key->paper_name.'</td>
								<td style="text-align:center">'.$key->loan_ac.'</td>
								<td style="text-align:center">'.$key->ac_name.'</td>
								<td style="text-align:center">'.$key->case_number.'</td>
								<td style="text-align:center">'.$key->txrn_dt.'</td>
								<td style="text-align:center">'.$paper_scan_copy.'</td>
								<td style="text-align:center">'.number_format($key->amount,2).'</td>
						</tr>';
					$sl++;
				}
				$str.='<tr>
							<td style="text-align:right" colspan="7">Total = </td>
							<td style="text-align:center">'.$total.'</td>
					</tr>';
			}
			else
			{
				$str.='<tr>
							<td style="text-align:center" colspan="8">Sorry No Data!!</td>
					</tr>';
				$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
			}
		}
		//For staff Conveyence
		else if ($vendor_type==3) { 
			$result = $this->Bill_ho_model->get_cost_details_staff_all($vendor_id,$bill_month);
			$str = '';
			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" id="grid_table_div" class="grid_table_div">
					<table class="result_table" id="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
					<thead style="">
						<th width="5%" style="font-weight: bold;text-align:center">SL</th>
						<th width="30%" style="font-weight: bold;text-align:center">Vendor Name</th>
						<th width="25%" style="font-weight: bold;text-align:center">Date of legal steps</th>
						<th width="25%" style="font-weight: bold;text-align:center">Purpose/Activities</th>
						<th width="25%" style="font-weight: bold;text-align:center">Amount</th>
					</thead>
					<tbody id="table_tbody">';
			if (!empty($result)) 
			{
				$sl = 1;
				foreach ($result as $key) 
				{
					$total+=$key->amount;
					$str.='<tr>
								<td style="text-align:center">'.$sl.'</td>
								<td style="text-align:center">'.$key->vendor_name.'</td>
								<td style="text-align:center">'.$key->txrn_dt.'</td>
								<td style="text-align:center">'.$key->activities_name.'</td>
								<td style="text-align:center">'.number_format($key->amount,2).'</td>
						</tr>';
					$sl++;
				}
				$str.='<tr>
							<td style="text-align:right" colspan="4">Total = </td>
							<td style="text-align:center">'.$total.'</td>
					</tr>';
			}
			else
			{
				$str.='<tr>
							<td style="text-align:center" colspan="5">Sorry No Data!!</td>
					</tr>';
				$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
			}
		}
		//For Court Fee
		else if ($vendor_type==4) { 
			$result = $this->Bill_ho_model->get_cost_details_court_fee_all($vendor_id,$bill_month);
			$str = '';
			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" id="grid_table_div" class="grid_table_div">
					<table class="result_table" id="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
					<thead style="">
						<th width="3%" style="font-weight: bold;text-align:center">SL</th>
						<th width="15%" style="font-weight: bold;text-align:center">Vendor Name</th>
						<th width="10%" style="font-weight: bold;text-align:center">Account No.</th>
						<th width="15%" style="font-weight: bold;text-align:center">Account Name</th>
						<th width="15%" style="font-weight: bold;text-align:center">Case No.</th>
						<th width="10%" style="font-weight: bold;text-align:center">Date of legal steps</th>
						<th width="15%" style="font-weight: bold;text-align:center">Purpose/Activities</th>
						<th width="15%" style="font-weight: bold;text-align:center">Amount</th>
					</thead>
					<tbody id="table_tbody">';
			if (!empty($result)) 
			{
				$sl = 1;
				foreach ($result as $key) 
				{
					$total+=$key->amount;
					$str.='<tr>
								<td style="text-align:center">'.$sl.'</td>
								<td style="text-align:center">'.$key->vendor_name.'</td>
								<td style="text-align:center">'.$key->loan_ac.'</td>
								<td style="text-align:center">'.$key->ac_name.'</td>
								<td style="text-align:center">'.$key->case_number.'</td>
								<td style="text-align:center">'.$key->txrn_dt.'</td>
								<td style="text-align:center">'.$key->activities_name.'</td>
								<td style="text-align:center">'.number_format($key->amount,2).'</td>
						</tr>';
					$sl++;
				}
				$str.='<tr>
							<td style="text-align:right" colspan="7">Total = </td>
							<td style="text-align:center">'.$total.'</td>
					</tr>';
			}
			else
			{
				$str.='<tr>
							<td style="text-align:center" colspan="8">Sorry No Data!!</td>
					</tr>';
				$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
			}
		}
		//For Court Entertainment
		else if ($vendor_type==5) { 
			$result = $this->Bill_ho_model->get_cost_details_court_all($vendor_id,$bill_month);
			$str = '';
			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" id="grid_table_div" class="grid_table_div">
					<table class="result_table" id="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
					<thead style="">
						<th width="3%" style="font-weight: bold;text-align:center">SL</th>
						<th width="15%" style="font-weight: bold;text-align:center">Vendor Name</th>
						<th width="10%" style="font-weight: bold;text-align:center">Account No.</th>
						<th width="15%" style="font-weight: bold;text-align:center">Account Name</th>
						<th width="15%" style="font-weight: bold;text-align:center">Case No.</th>
						<th width="10%" style="font-weight: bold;text-align:center">Date of legal steps</th>
						<th width="15%" style="font-weight: bold;text-align:center">Purpose/Activities</th>
						<th width="15%" style="font-weight: bold;text-align:center">Amount</th>
					</thead>
					<tbody id="table_tbody">';
			if (!empty($result)) 
			{
				$sl = 1;
				foreach ($result as $key) 
				{
					$total+=$key->amount;
					$str.='<tr>
								<td style="text-align:center">'.$sl.'</td>
								<td style="text-align:center">'.$key->vendor_name.'</td>
								<td style="text-align:center">'.$key->loan_ac.'</td>
								<td style="text-align:center">'.$key->ac_name.'</td>
								<td style="text-align:center">'.$key->case_number.'</td>
								<td style="text-align:center">'.$key->txrn_dt.'</td>
								<td style="text-align:center">'.$key->activities_name.'</td>
								<td style="text-align:center">'.number_format($key->amount,2).'</td>
						</tr>';
					$sl++;
				}
				$str.='<tr>
							<td style="text-align:right" colspan="7">Total = </td>
							<td style="text-align:center">'.$total.'</td>
					</tr>';
			}
			else
			{
				$str.='<tr>
							<td style="text-align:center" colspan="8">Sorry No Data!!</td>
					</tr>';
				$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
			}
		}
		//For Others
		else if ($vendor_type==6) { 
			$result = $this->Bill_ho_model->get_cost_details_other_bill_all($vendor_name,$bill_month);
			$str = '';
			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" id="grid_table_div" class="grid_table_div">
					<table class="result_table" id="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
					<thead style="">
						<th width="5%" style="font-weight: bold;text-align:center">SL</th>
						<th width="30%" style="font-weight: bold;text-align:center">Vendor Name</th>
						<th width="25%" style="font-weight: bold;text-align:center">Date of legal steps</th>
						<th width="25%" style="font-weight: bold;text-align:center">Purpose/Activities</th>
						<th width="25%" style="font-weight: bold;text-align:center">Amount</th>
					</thead>
					<tbody id="table_tbody">';
			if (!empty($result)) 
			{
				$sl = 1;
				foreach ($result as $key) 
				{
					$total+=$key->amount;
					$str.='<tr>
								<td style="text-align:center">'.$sl.'</td>
								<td style="text-align:center">'.$key->vendor_name.'</td>
								<td style="text-align:center">'.$key->txrn_dt.'</td>
								<td style="text-align:center">'.$key->activities_name.'</td>
								<td style="text-align:center">'.number_format($key->amount,2).'</td>
						</tr>';
					$sl++;
				}
				$str.='<tr>
							<td style="text-align:right" colspan="4">Total = </td>
							<td style="text-align:center">'.$total.'</td>
					</tr>';
			}
			else
			{
				$str.='<tr>
							<td style="text-align:center" colspan="5">Sorry No Data!!</td>
					</tr>';
				$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
			}
		}
		
		$str.='</tbody></table></div>';
		$var =array(
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function download_xl()
	{
		$vendor_type = $this->input->post('bill_type');
		$vendor_id = $this->input->post('vendor');
		$vendor_name = $this->input->post('vendor_name');
		$bill_month = $this->input->post('bill_month');
		$csrf_token=$this->security->get_csrf_hash();
		$str='';
		$total=0;
		//For Lawyer
		if ($vendor_type==1) { 
			$result = $this->Bill_ho_model->get_cost_details_lawyer_all($vendor_id,$bill_month);
		}
		//For paper vendor
		else if ($vendor_type==2) { 
			$result = $this->Bill_ho_model->get_cost_details_paper_bill_all($vendor_id,$bill_month);
		}
		//For staff Conveyence
		else if ($vendor_type==3) { 
			$result = $this->Bill_ho_model->get_cost_details_staff_all($vendor_id,$bill_month);
		}
		//For Court Fee
		else if ($vendor_type==4) { 
			$result = $this->Bill_ho_model->get_cost_details_court_fee_all($vendor_id,$bill_month);
		}
		//For Court Entertainment
		else if ($vendor_type==5) { 
			$result = $this->Bill_ho_model->get_cost_details_court_all($vendor_id,$bill_month);
		}
		//For Others
		else if ($vendor_type==6) { 
			$result = $this->Bill_ho_model->get_cost_details_other_bill_all($vendor_name,$bill_month);
		}

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
	        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);

			$rowNumber = 1;
			$headings1 = array('Pending Bills Report');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':H'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setSize(16);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	       	$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
	        $rowNumber++;

	        $rowNumber++;  
	        $headings4 = array('Sl No','Vendor Name','Account No.',
	    		'Account Name',
	        	'Case No.','Date of legal steps','Purpose/Activities','Amount');//,strtotime($dealdate)));
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true);	
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'F28A8C')));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;   
	        $sl = 0;
	        if(!empty($result))
	        {
	        	foreach($result as $key)
				{
					$total+=$key->amount;
					$sl++;
					$objPHPExcel->getActiveSheet()->fromArray(array(
						$sl,
						$key->vendor_name,
						$key->loan_ac,
						$key->ac_name,
						$key->case_number,
						$key->txrn_dt,
						$key->activities_name,
						number_format($key->amount,2)
						),NULL,'A'.$rowNumber);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setWrapText(true);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
					$rowNumber++;
				}
				$headings1 = array('Total =  ','','','','','','',$total);
			    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
			    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':G'.$rowNumber); 
			    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':G'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':G'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			    $objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			    $objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(14);
			    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
			    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
			    $rowNumber++;
	        }
			

		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle('Pending Bills'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="pending_bills.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
	}
}
?>
