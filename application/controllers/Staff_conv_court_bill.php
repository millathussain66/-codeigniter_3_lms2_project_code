<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff_conv_court_bill extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Staff_conv_court_bill_model', '', TRUE);
		$this->load->model('User_model', '', TRUE);
	}

	// Start View
	public function view ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		if ($operation==NULL) {
			$operation = 'staff_conv_court_bill';
		}
		$staff = $this->Staff_conv_court_bill_model->get_staff();
		$data = array(
            'legal_region'=>$this->User_model->get_parameter_data('ref_legal_region','name','data_status = 1'),
			'menu_group'=> $menu_group,
			'staff'=> $staff,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'staff_conv_court_bill/pages/grid',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}


	public function court_entertainment_cost ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
	
		$operation = 'court_entertainment_cost';
		$staff = $this->Staff_conv_court_bill_model->get_staff();
		$data = array(
            'legal_region'=>$this->User_model->get_parameter_data('ref_legal_region','name','data_status = 1'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'staff'=> $staff,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'staff_conv_court_bill/pages/court_entertainment_cost',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}
    

    public function type_wise_cost ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
	
		$operation = 'type_wise_cost';
	    $staff = $this->Staff_conv_court_bill_model->get_staff();
		$data = array(
            'legal_region'=>$this->User_model->get_parameter_data('ref_legal_region','name','data_status = 1'),
			'menu_group'=> $menu_group,
			'staff'=> $staff,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'staff_conv_court_bill/pages/type_wise_cost',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}


    public function activities_wise_report ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		$operation = 'activities_wise_report';
	
		$data = array(
            'legal_region'=>$this->User_model->get_parameter_data('ref_legal_region','name','data_status = 1'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'staff_conv_court_bill/pages/activities_wise_report',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}
    
    public function search_convance_others_bill_result()
    {
    	$result = $this->Staff_conv_court_bill_model->get_conveyence_other_cost_result();
	 	
		$csrf_token=$this->security->get_csrf_hash();
		$str='<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0; margin-top:10px" >
                <thead>
                    <tr>
                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">PIN</td>
                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Employee Name</td>
                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Region</td>
                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Bill Purpose</td>
                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Bill Receiveing Date</td>
                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Amount BDT (TK)</td>
                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Bill Month</td>
                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Final Submit To Finance</td>
                    </tr>
                </thead>
                <tbody id="">';
		if(!empty($result))
		{
			$sl=0;
			foreach ($result as $key) 
			{
				$str.='<tr>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->employee_pin.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->employee_name.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->district_name.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->region_name.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->purpose.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->received_date_from_field.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->bill_amount.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->bill_months.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->stf_date.'</td>
                </tr>';
			}
		}
		else
		{
			$str.="<tr><td colspan='9' align='center'>No Data Found!!!</td></tr>";
		}
		$str.='</tbody>
            </table>';
		$var =array(
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	 	
	}

	public function court_entertainment_cost_result()
	{
		$result = $this->Staff_conv_court_bill_model->get_court_entertainment_cost_result();
	    $csrf_token=$this->security->get_csrf_hash();
			$str='<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0; margin-top:10px" >
	                <thead>
	                    <tr>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Account  Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Account Name</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">PIN</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Employee Name</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Region</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Bill  Purpose</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;"> Bill Amount</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Bill Month</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Particular Activities </td>
	                    </tr>
	                </thead>
	                <tbody id="">';
			if(!empty($result))
			{
				$sl=0;
				foreach ($result as $key) 
				{
					$str.='<tr>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_ac.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->ac_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->txrn_dt.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_number.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->employee_pin.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->employee_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->district_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->region_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->purpose.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->bill_amount.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->bill_months.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->activities_name.'</td>

	                </tr>';
				}
			}
			else
			{
				$str.="<tr><td colspan='12' align='center'>No Data Found!!!</td></tr>";
			}
			$str.='</tbody>
	            </table>';
			$var =array(
	    			"str"=>$str,
					"csrf_token"=>$csrf_token
					);
			echo json_encode($var);
	}

	public function type_wise_cost_result()
	{
	    $csrf_token=$this->security->get_csrf_hash();

	    $result = $this->Staff_conv_court_bill_model->get_type_wise_result();
	    $result2 = $this->Staff_conv_court_bill_model->get_type_wise_activities_result();
	    $result3 = $this->Staff_conv_court_bill_model->get_type_wise_activities_region_result();

			$str='<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0; margin-top:10px" >
	                <thead>
	                     <tr>
	                       <th style="background: #526dff47;font-weight: bold;" colspan="5">Region Wise Court Entertainment & Conveyance Bill</th>
	                     </tr>
	                    <tr>
	                        <td style="width:200px;font-weight: bold;text-align:center;word-wrap: break-word;">SL NO</td>
	                        <td style="width:200px;font-weight: bold;text-align:center;word-wrap: break-word;">Region Wise</td>
	                        <td style="width:200px;font-weight: bold;text-align:center;word-wrap: break-word;">Court Entertainment</td>
	                        <td style="width:200px;font-weight: bold;text-align:center;word-wrap: break-word;">Conveyance & Other Bill</td>
	                        <td style="width:200px;font-weight: bold;text-align:center;word-wrap: break-word;">Total</td>
	                    </tr>
	                </thead>
	                <tbody id="">';

			if(!empty($result))
			{
				$sl=1;
				$court_total=0;
				$staff_total=0;
				$grand_total=0;
				foreach ($result as $key) 
				{
					$court_total+=$key->court_total;
					$staff_total+=$key->staff_total;
					$grand_total+=$key->grand_total;
					$str.='<tr>
	                    <td style="text-align:center;word-wrap: break-word;">'.$sl.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->region_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.number_format($key->court_total,2).'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.number_format($key->staff_total,2).'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.number_format($key->grand_total,2).'</td>

	                </tr>';
	                $sl++;
				}
				$str.='<tr style="background: #0fed8542;">
	                    <td style="font-weight: bold;text-align:center;word-wrap: break-word;" colspan="2">Grand Total	</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.number_format($court_total,2).'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.number_format($staff_total,2).'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.number_format($grand_total,2).'</td>

	                </tr>';

			}
			else
			{
				$str.="<tr><td colspan='5' align='center'>No Data Found!!!</td></tr>";
			}

			$str.='</tbody>
	            </table>';



	        $str2='<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0; margin-top:10px" >
	                <thead>
	   
	                    <tr style="background: #526dff47;">
	                        <td style="width:200px;font-weight: bold;text-align:center;word-wrap: break-word;">SL NO</td>
	                        <td style="width:200px;font-weight: bold;text-align:center;word-wrap: break-word;">Particulers </td>
	                        <td style="width:200px;font-weight: bold;text-align:center;word-wrap: break-word;"> Total Amount </td>

	                    </tr>
	                </thead>
	                <tbody id="">';
			if(!empty($result2))
			{
				$sl=1;
				$grand_total=0;
				foreach ($result2 as $key) 
				{
					$grand_total+=$key->grand_total;
					$str2.='<tr>
	                    <td style="text-align:center;word-wrap: break-word;">'.$sl.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->activities_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.number_format($key->grand_total,2).'</td>

	                </tr>';
	                $sl++;
				}
				$str2.="<tfoot style='background: #0fed8542;'>
		            <tr>
		                <td style='font-weight: bold;text-align:center;word-wrap: break-word;' colspan='2'>Grand Total	</td>
		                <td style='text-align:center;word-wrap: break-word;'>".number_format($grand_total,2)."</td>
		            </tr>
		        </tfoot> ";

			}
			else
			{
				$str2.="<tr><td colspan='3' align='center'>No Data Found!!!</td></tr>";
			}

	        
			$str2.='</tbody>
	            </table>';
	               
	         $str2.='<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0; margin-top:10px" >
	                <thead>
	   
	                    <tr style="background: #526dff47;">
	                        <td style="width:200px;font-weight: bold;text-align:center;word-wrap: break-word;">Region</td>
	                        <td style="width:200px;font-weight: bold;text-align:center;word-wrap: break-word;">Particulers </td>
	                        <td style="width:200px;font-weight: bold;text-align:center;word-wrap: break-word;">Activities Wise Amount</td>
	                        <td style="width:200px;font-weight: bold;text-align:center;word-wrap: break-word;">Total Amount</td>

	                    </tr>
	                </thead>
	                <tbody id="">';
			if(!empty($result3))
			{
				$sl=1;
				$grand_total=0;
				$central_merge=0;
				$central_total=0;
				$north_merge=0;
				$north_total=0;
				$south_merge=0;
				$south_total=0;
				$east_merge=0;
				$east_total=0;
				$blank_merge=0;
				$blank_total=0;
				foreach ($result3 as $key) 
				{
					if($key->region_id=='1')
					{
						$central_merge++;
						$central_total+=$key->grand_total;
					}
					else if($key->region_id=='2')
					{
						$east_merge++;
						$east_total+=$key->grand_total;
					}
					else if($key->region_id=='3')
					{
						$south_merge++;
						$south_total+=$key->grand_total;
					}
					else if($key->region_id=='4')
					{
						$north_merge++;
						$north_total+=$key->grand_total;
					}
					else if($key->region_id=='')
					{
						$blank_merge++;
						$blank_total+=$key->grand_total;
					}
			    }
				$central_check_sts=0;
				$east_check_sts=0;
				$south_check_sts=0;
				$north_check_sts=0;
				$blank_check_sts=0;
				foreach ($result3 as $key) 
				{
					$grand_total+=$key->grand_total;
					if($key->region_id=='1')
					{
						$central_check_sts++;
					}
					else if($key->region_id=='2')
					{
						$east_check_sts++;
					}
					else if($key->region_id=='3')
					{
						$south_check_sts++;
					}
					else if($key->region_id=='4')
					{
						$north_check_sts++;
					}
					else if($key->region_id=='')
					{
						$blank_check_sts++;
					}

					if($central_check_sts=='1')
					{
						$central_check_sts++;
						$str2.='<tr>
		                    <td style="text-align:center;word-wrap: break-word;" rowspan="'.$central_merge.'">'.$key->region_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->activities_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.number_format($key->grand_total,2).'</td>
		                    <td style="text-align:center;word-wrap: break-word;" rowspan="'.$central_merge.'">'.number_format($central_total,2).'</td>

		                </tr>';
					}
					else if($east_check_sts=='1')
					{
						$east_check_sts++;
						$str2.='<tr>
		                    <td style="text-align:center;word-wrap: break-word;" rowspan="'.$east_merge.'">'.$key->region_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->activities_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.number_format($key->grand_total,2).'</td>
		                    <td style="text-align:center;word-wrap: break-word;" rowspan="'.$east_merge.'">'.number_format($east_total,2).'</td>

		                </tr>';
					}
					else if($south_check_sts=='1')
					{
						$south_check_sts++;
						$str2.='<tr>
		                    <td style="text-align:center;word-wrap: break-word;" rowspan="'.$south_merge.'">'.$key->region_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->activities_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.number_format($key->grand_total,2).'</td>
		                    <td style="text-align:center;word-wrap: break-word;" rowspan="'.$south_merge.'">'.number_format($south_total,2).'</td>

		                </tr>';
					}
					else if($north_check_sts=='1')
					{
						$north_check_sts++;
						$str2.='<tr>
		                    <td style="text-align:center;word-wrap: break-word;" rowspan="'.$north_merge.'">'.$key->region_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->activities_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.number_format($key->grand_total,2).'</td>
		                    <td style="text-align:center;word-wrap: break-word;" rowspan="'.$north_merge.'">'.number_format($north_total,2).'</td>

		                </tr>';
					}
					else if($blank_check_sts=='1')
					{
						$blank_check_sts++;
						$str2.='<tr>
		                    <td style="text-align:center;word-wrap: break-word;" rowspan="'.$blank_merge.'">'.$key->region_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->activities_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.number_format($key->grand_total,2).'</td>
		                    <td style="text-align:center;word-wrap: break-word;" rowspan="'.$blank_merge.'">'.number_format($blank_total,2).'</td>

		                </tr>';
					}
					else
					{
						$str2.='<tr>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->activities_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.number_format($key->grand_total,2).'</td>
		                </tr>';
					}
					
	                $sl++;
				}
				$str2.="<tfoot style='background: #0fed8542;'>
		            <tr>
		                <td style='font-weight: bold;text-align:center;word-wrap: break-word;' colspan='2'>Grand Total	</td>
		                <td style='text-align:center;word-wrap: break-word;'>".number_format($grand_total,2)."</td>
		                <td style='text-align:center;word-wrap: break-word;'>".number_format($grand_total,2)."</td>
		            </tr>
		        </tfoot> ";

			}
			else
			{
				$str2.="<tr><td colspan='4' align='center'>No Data Found!!!</td></tr>";
			}

	        
			$str2.='</tbody>
	            </table>';


			$var =array(
	    			"str2"=>$str2,
	    			"str"=>$str,
					"csrf_token"=>$csrf_token
					);
			echo json_encode($var);
	}

	public function activities_wise_report_result()
	{
		
			$csrf_token=$this->security->get_csrf_hash();
			$str='<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0; margin-top:10px" >
	            <thead>
	                <tr style="background:#00ffc352">
	                    <td style="width: 250px;font-weight: bold;text-align:center;word-wrap: break-word;">Region</td>
	                    <td style="width: 250px;font-weight: bold;text-align:center;word-wrap: break-word;">Particulars</td>
	                    <td style="width: 250px;font-weight: bold;text-align:center;word-wrap: break-word;">Activities Wise Amount</td>
	                    <td style="width: 250px;font-weight: bold;text-align:center;word-wrap: break-word;">Total Amount</td>

	                </tr>
	            </thead>
	            <tbody id="">';
		// if(!empty($result))
		// {
		// 	$sl=0;
		// 	foreach ($result as $key) 
		// 	{
				$str.='
				
					<tr>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;" rowspan="3">Central</td>
						<td>Court Persuasion Cost</td>
						<td></td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;"  rowspan="3"></td>
		
					</tr>
					<tr>
						<td>Misc Cost</td>
						<td></td>
					</tr>
					<tr>
						<td>Summon & Warrant Jari</td>
						<td></td>
					</tr>


					
					
					
					
					
					
					
		
					<tr>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;" rowspan="6">East</td>
						<td>Certified Copy Withdrawal</td>
						<td></td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;" rowspan="6"></td>
					</tr>
					</tr>
					<tr>
						<td>Appeal & Bail Money withdraw</td>
						<td></td>
					</tr>
					</tr>
					<tr>
						<td>Court Persuasion Cost</td>
						<td></td>
					</tr>
					</tr>
					<tr>
						<td>Misc Cost</td>
						<td></td>
					</tr>
		
					</tr>
					<tr>
						<td>Summon & Warrant Jari</td>
						<td></td>
					</tr>
					</tr>
					<tr>
						<td>Witness Complete</td>
						<td></td>
					</tr>
		
		
					<tr>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;" rowspan="6">North</td>
						<td>Certified Copy Withdrawal</td>
						<td></td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;" rowspan="6"></td>
					</tr>
					</tr>
					<tr>
						<td>Appeal & Bail Money withdraw</td>
						<td></td>
					</tr>
					</tr>
					<tr>
						<td>Court Persuasion Cost</td>
						<td></td>
					</tr>
					</tr>
					<tr>
						<td>Misc Cost</td>
						<td></td>
					</tr>
		
					</tr>
					<tr>
						<td>Summon & Warrant Jari</td>
						<td></td>
					</tr>
					</tr>
					<tr>
						<td>Witness Complete</td>
						<td></td>
					</tr>
		
					<tr>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;" rowspan="6">South</td>
						<td>Certified Copy Withdrawal</td>
						<td></td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;" rowspan="6"></td>
					</tr>
					</tr>
					<tr>
						<td>Appeal & Bail Money withdraw</td>
						<td></td>
					</tr>
					</tr>
					<tr>
						<td>Court Persuasion Cost</td>
						<td></td>
					</tr>
					</tr>
					<tr>
						<td>Misc Cost</td>
						<td></td>
					</tr>
		
					</tr>
					<tr>
						<td>Summon & Warrant Jari</td>
						<td></td>
					</tr>
					</tr>
					<tr>
						<td>Witness Complete</td>
						<td></td>
					</tr>
		
			


	            ';
			// }
		//}
		// else
		// {
		// 	$str.="<tr><td colspan='12' align='center'>No Data Found!!!</td></tr>";
		// }




		$str.='</tbody>';


		$str.='	<tfoot>
				<tr>
				<td style="font-weight: bold;text-align:center;word-wrap: break-word;" colspan="2">Grand Total </td>
				<td style="font-weight: bold;text-align:center;word-wrap: break-word;"></td>
				<td style="font-weight: bold;text-align:center;word-wrap: break-word;"></td>
					</tr>
		</tfoot>';


		$str.='</table>';



		$var =array(
				"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	 	
	}

	public function convance_other_bill_xl()
	{
		
		$result = $this->Staff_conv_court_bill_model->get_conveyence_other_cost_result();

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
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
        $styleThinBlackBorderOutline = array(
		'borders' => array(														
				'top'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				),
				'right'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				),
				'left'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)	,
				'bottom'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)													
			),
			'alignment' => array(
	            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
	        )
		);
        $color_style = array(
                'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb'=>'92cddc'),
                )
                
        );
        $rowNumber = 8;
		$headings1 = array('SL','PIN','Employee Name','District','Region','Bill  Purpose','Bill Receiveing Date',' Amount BDT (TK)','Bill Month','Final Submit To Finance','Approve OK','Remarks');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($color_style);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(60);
		$rowNumber++;
		$counter=1;
		foreach($result as $key)
		{
			$headings1 = array(
				$counter,
				$key->employee_pin,
				$key->employee_name,
				$key->district_name,
				$key->region_name,
				$key->purpose,
				$key->received_date_from_field,
				$key->bill_amount,
				$key->bill_months,
				$key->stf_date,
				'',
				''
			);
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
			$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
	        $rowNumber++;
			$counter++;
		}
		$rowNumber++;
		$objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Bill Report'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="bill_report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
	}
	public function court_entertainment_cost_xl()
	{
		
		$result = $this->Staff_conv_court_bill_model->get_court_entertainment_cost_result();

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
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);
        $styleThinBlackBorderOutline = array(
		'borders' => array(														
				'top'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				),
				'right'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				),
				'left'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)	,
				'bottom'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)													
			),
			'alignment' => array(
	            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
	        )
		);
        $color_style = array(
                'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb'=>'92cddc'),
                )
                
        );
        $rowNumber = 8;
		$headings1 = array(
			'SL',
			'Account  Number',
			'Account Name',
			'Date',
			'Case Number',
			'PIN',
			'Employee Name',
			'District',
			'Region',
			'Bill  Purpose',
			'Bill Amount',
			'Bill Month',
			'Particular Activities'
		);
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':N'.$rowNumber)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':N'.$rowNumber)->applyFromArray($color_style);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(60);
		$rowNumber++;
		$counter=1;
		foreach($result as $key)
		{
			$headings1 = array(
				$counter,
				$key->loan_ac,
				$key->ac_name,
				$key->txrn_dt,
				$key->case_number,
				$key->employee_pin,
				$key->employee_name,
				$key->district_name,
				$key->region_name,
				$key->purpose,
				$key->bill_amount,
				$key->bill_months,
				$key->activities_name
			);
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
			$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
	        $objPHPExcel->getActiveSheet()->setCellValueExplicit(('C'.$rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
	        $rowNumber++;
			$counter++;
		}
		$rowNumber++;
		$objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Bill Report'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="bill_report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
	}

	public function type_wise_cost_lx()
	{
		
		$result = $this->Staff_conv_court_bill_model->get_type_wise_result();
	    $result2 = $this->Staff_conv_court_bill_model->get_type_wise_activities_result();
		$result3 = $this->Staff_conv_court_bill_model->get_type_wise_activities_region_result();
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);
        $styleThinBlackBorderOutline = array(
		'borders' => array(														
				'top'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				),
				'right'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				),
				'left'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)	,
				'bottom'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)													
			),
			'alignment' => array(
	            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
	        )
		);
        $color_style = array(
                'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb'=>'b8cce4'),
                )
                
        );
        $color_style2 = array(
                'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb'=>'d8e4bc'),
                )
                
        );
        $rowNumber = 2;
        $headings1 = array('A. Region Wise Court Entertainment & Conveyance Bill');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':F'.$rowNumber); 
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($color_style);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		//$objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(40);
		$rowNumber++;
		$headings1 = array(
			'SL',
			'Region Wise',
			'Court Entertainment',
			'Conveyance & Other\'s Bill',
			'Total'
		);
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($color_style2);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$rowNumber++;
		$counter=1;
		$court_total=0;
		$staff_total=0;
		$grand_total=0;
		if(!empty($result))
		{
			foreach($result as $key)
			{
				$court_total+=$key->court_total;
				$staff_total+=$key->staff_total;
				$grand_total+=$key->grand_total;
				$headings1 = array(
					$counter,
					$key->region_name,
					number_format($key->court_total,2),
					number_format($key->staff_total,2),
					number_format($key->grand_total,2)
				);
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$rowNumber++;
				$counter++;
			}
			$headings1 = array(
				'Grand Total',
				'',
				number_format($court_total,2),
				number_format($staff_total,2),
				number_format($grand_total,2)
			);
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$rowNumber++;
		}
		$rowNumber++;
		$rowNumber++;
		$rowNumber++;

		$headings1 = array(
			'SL',
			'Particulers',
			'Total Amount'
		);
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->applyFromArray($color_style);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$rowNumber++;
		if(!empty($result2))
		{
			$grand_total=0;
			foreach($result2 as $key)
			{
				$grand_total+=$key->grand_total;
				$headings1 = array(
					$counter,
					$key->activities_name,
					number_format($key->grand_total,2)
				);
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$rowNumber++;
				$counter++;
			}
			$headings1 = array(
				'Grand Total',
				'',
				number_format($grand_total,2)
			);
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$rowNumber++;
		}
		$rowNumber++;
		if(!empty($result3))
		{
			$sl=1;
			$grand_total=0;
			$central_merge=0;
			$central_total=0;
			$north_merge=0;
			$north_total=0;
			$south_merge=0;
			$south_total=0;
			$east_merge=0;
			$east_total=0;
			$blank_merge=0;
			$blank_total=0;
			$headings1 = array(
				'Region',
				'Particulers',
				'Activities Wise Amount',
				'Total Amount'
			);
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':E'.$rowNumber)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':E'.$rowNumber)->applyFromArray($color_style);
			$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$rowNumber++;
			foreach ($result3 as $key) 
			{
				if($key->region_id=='1')
				{
					$central_merge++;
					$central_total+=$key->grand_total;
				}
				else if($key->region_id=='2')
				{
					$east_merge++;
					$east_total+=$key->grand_total;
				}
				else if($key->region_id=='3')
				{
					$south_merge++;
					$south_total+=$key->grand_total;
				}
				else if($key->region_id=='4')
				{
					$north_merge++;
					$north_total+=$key->grand_total;
				}
				else if($key->region_id=='')
				{
					$blank_merge++;
					$blank_total+=$key->grand_total;
				}
		    }
			$central_check_sts=0;
			$east_check_sts=0;
			$south_check_sts=0;
			$north_check_sts=0;
			$blank_check_sts=0;
			foreach ($result3 as $key) 
			{
				$grand_total+=$key->grand_total;
				if($key->region_id=='1')
				{
					$central_check_sts++;
				}
				else if($key->region_id=='2')
				{
					$east_check_sts++;
				}
				else if($key->region_id=='3')
				{
					$south_check_sts++;
				}
				else if($key->region_id=='4')
				{
					$north_check_sts++;
				}
				else if($key->region_id=='')
				{
					$blank_check_sts++;
				}
				if($central_check_sts=='1')
				{
					$headings1 = array(
						$key->region_name,
						$key->activities_name,
						number_format($key->grand_total,2),
						number_format($central_total,2)
					);
			        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
			        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+($central_merge-1)));
					$objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':E'.($rowNumber+($central_merge-1)));
					$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$rowNumber++;
					$central_check_sts++;
				}
				else if($east_check_sts=='1')
				{
					$headings1 = array(
						$key->region_name,
						$key->activities_name,
						number_format($key->grand_total,2),
						number_format($east_total,2)
					);
			        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
			        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+($east_merge-1)));
					$objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':E'.($rowNumber+($east_merge-1)));
					$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$rowNumber++;
					$east_check_sts++;
				}
				else if($south_check_sts=='1')
				{
					$headings1 = array(
						$key->region_name,
						$key->activities_name,
						number_format($key->grand_total,2),
						number_format($south_total,2)
					);
			        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
			        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+($south_merge-1)));
					$objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':E'.($rowNumber+($south_merge-1)));
					$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$rowNumber++;
					$south_check_sts++;
				}
				else if($north_check_sts=='1')
				{
					$headings1 = array(
						$key->region_name,
						$key->activities_name,
						number_format($key->grand_total,2),
						number_format($north_total,2)
					);
			        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
			        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+($north_merge-1)));
					$objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':E'.($rowNumber+($north_merge-1)));
					$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$rowNumber++;
					$north_check_sts++;
				}
				else if($blank_check_sts=='1')
				{
					$headings1 = array(
						$key->region_name,
						$key->activities_name,
						number_format($key->grand_total,2),
						number_format($blank_total,2)
					);
			        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
			        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+($blank_merge-1)));
					$objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':E'.($rowNumber+($blank_merge-1)));
					$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$rowNumber++;
					$blank_check_sts++;
				}
				else
				{
					$headings1 = array(
						'',
						$key->activities_name,
						number_format($key->grand_total,2),
						''
					);
			        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
			        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
					$rowNumber++;
				}
				
                $sl++;
			}
			$headings1 = array(
				'Grand Total',
				'',
				number_format($grand_total,2),
				number_format($grand_total,2)
			);
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$rowNumber++;

		}
		$objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Bill Report'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="bill_report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
	}


}